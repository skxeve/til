# Google App Engine

## SE (Standard Environment)

0台から待機させられ（料金がかからない！）アクセスが増えるとスケーリングも勝手にやってくれる便利なPaaS。
個人で使うことを想定するとだいぶ好感度高め。負荷対策を考えなくて良いので業務にも良さそう。

言語を選べば起動も1秒未満の超高速。

### 2nd generation

各種言語のバージョンが一気に最新に近いものに対応した。他にも細かい点が色々アップデートされ、今後に期待できる。

ただ、2ndだとローカル環境で動作させることができない模様（1stではdev_appserver.pyを使ってローカル動作させられた）。
そのため開発に少し苦労しそう。

- PHP7.2
- Python3.7
- Go1.11

[参考:appengine-generation](https://cloud.google.com/appengine/docs/standard/appengine-generation)

### Memo

```
$ gcloud config set ${project-id}
$ gcloud app create
$ gcloud app deploy
$ gcloud app browse
```

サービスを複数用意できるが、defaultサービスは必要。

サービスはモジュールと同義。

## FE (Flexible Environment)

ドキュメントに書いてあるできることを見ている限り、こちらは現状あまり使う用途が想定できない。
言語やバージョンの制限がなくなるのは利点だが、それならGCEとかGKEとかを使いそうな気がする。
料金的にも個人で使うならStandard一択。

