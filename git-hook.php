<?php
$LOG_FILE = dirname(__FILE__).'/git-hook.log';

if (isset($_GET['key'])
  && $_GET['key'] === $SECRET_KEY
  && isset($_POST['payload'])) {
    $payload = json_decode($_POST['payload'], true);
    if ($payload['ref'] === 'refs/heads/master') {
        `cd netplan.co.jp/public_html/wp-content/themes && git pull origin master`;
        file_put_contents(
            $LOG_FILE,
            date("[Y-m-d H:i:s]")." ".$_SERVER['REMOTE_ADDR']." git pulled: ".$payload['head_commit']['message']."\n",
            FILE_APPEND|LOCK_EX
        );
    }
} else {
  /* test */
    file_put_contents(
        $LOG_FILE,
        date("[Y-m-d H:i:s]")." invalid access: ".$_SERVER['REMOTE_ADDR']."\n",
        FILE_APPEND|LOCK_EX
    );
}
