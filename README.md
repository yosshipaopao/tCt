
# tclb Classroom todo
~~ネーミングセンスとは？~~
 [https://github.com/apple-pi-yhhhh/newTCLB-ProjectsFrame](https://github.com/apple-pi-yhhhh/newTCLB-ProjectsFrame)
上記のプロジェクトの一部のtclb Classroom todo( tCt ) です。

## 仕様説明(できるほど理解していない)
とりあえず使ってるもの一覧
### Classroom api
Google Apis からの出張です。
もともと[GASで作ったの](https://yosshipaopao.com/classroom-notifaction.php)を移行したんだけどほぼ一新してる
### firebase cloud messaging
これまじむずい
## 初期設定
### 足りないものなんだ
 - Modules
#### モジュール
##### node
##### php(composer)
 - GoogleのGCPの`credentials.json`
#### tokenの場所
``node/serviceAccountKey.json ``
``node/credentials.json``
``settings/credentials.json``
 - phpでGoogleログイン用のなんかトークン？
 - Mysqlの設定
 #### Mysql
 - crontab
#### crontab
``*/1  6-15 * * MON-FRI node index.js ``
``0  0-5,16-23/1 * * MON-FRI node index.js``
``0 */1 * * SUN,SAT node index.js``
