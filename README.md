# git-hook

参考記事  
- [GitHubのwebhookを受け取って、自動でgit pullするスクリプト](https://qiita.com/oyas/items/1cbdc3e0ac35d4316885)
- [GItHubからエックスサーバーへ自動デプロイ](https://selecao10.info/github%E3%81%8B%E3%82%89%E3%82%A8%E3%83%83%E3%82%AF%E3%82%B9%E3%82%B5%E3%83%BC%E3%83%90%E3%83%BC%E3%81%B8%E8%87%AA%E5%8B%95%E3%83%87%E3%83%97%E3%83%AD%E3%82%A4/)

下記の記事を参考にしたと思う。  
- [GitHubにpushしたらブランチ毎に自動デプロイする仕組みをエックスサーバー上に作ってみた](https://yosiakatsuki.net/blog/github-auto-deploy/)

WPのバージョンアップに伴い `ttone-child` を削除するので一旦 `git-hook.php` をはずします。
```
public_html/git-hook.php
```
