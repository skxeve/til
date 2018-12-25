# docker httpd

```
$ docker pull httpd
$ docker run -d -p 8080:80 httpd
```

これで [8080ポート](localhost:8080) にアクセスすれば、Apacheのデフォルト起動画面「It works!」が表示される。

## 終了させる

```
$ docker ps
# コンテナ名を確認
$ docker stop ${CONTAINER_NAME}
```

## 画面表示を変えてみる

ファイルを作成して、マウントさせた状態で起動する。

```
$ mkdir /tmp/docker_httpd
$ echo "This is skxeve test page." > /tmp/docker_httpd/index.html
$ docker run -d -p 8080:80 -v "/tmp/docker_httpd/:/usr/local/apache2/htdocs/" httpd
```
