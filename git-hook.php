<?php
require_once dirname(__FILE__) . '/wp-config.php';

$header = getallheaders();
$contents = file_get_contents("php://input");
$hmac = hash_hmac('sha1', $contents, GIT_HOOK_SECRET_KEY);

if (!isset($header['X-Hub-Signature'])
  || $header['X-Hub-Signature'] !== 'sha1=' . $hmac
  ) {
    logging("X-Hub-Signature error.");
    return;
}

if (!isset($_POST['payload'])) {
    logging("Payload is not set.");
    return;
}

$payload = stripslashes($_POST['payload']);
$payload = json_decode($payload, true);

if ($payload['ref'] !== 'refs/heads/main') {
    $msg = "invalid access: "
    . $payload['ref'];
    logging($msg);
    return;
}

chdir(dirname(__FILE__) . '/wp-content/themes/ttone-child');
exec('git pull -u origin main');
$msg = "git pulled: "
  . $payload['head_commit']['message'];
logging($msg);

function logging($msg)
{
    if (!WP_DEBUG) {
        return;
    }
    
    $logfile = dirname(__FILE__) . '/git-hook.log';
    $msg = date("[Y-m-d H:i:s]")
        . $_SERVER['REMOTE_ADDR']
        . " "
        . $msg
        . "\n";
    file_put_contents(
        $logfile,
        $msg,
        FILE_APPEND|LOCK_EX
    );
}
