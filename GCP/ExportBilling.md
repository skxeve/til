# 課金データをエクスポートする

基本的には個人だし無料枠で運用するつもりだけど、微量とはいえ課金が発生する可能性はあるわけで。

そうした事態に備えてレポート設定をしておく。

[参考記事](https://qiita.com/hnw/items/409d6b7c431ca5f74eb2)

簡単にまとめると

- GCPの課金データはデイリーでレポートを発行してもらうことができる。
- 発行先はBigQueryかGCS

という訳でエクスポート設定をした。

- GCS「Storage -> ブラウザ-> バケットを作成」で無料バケット作成
- GCP「お支払い -> 課金データのエクスポート -> ファイルのエクスポート」から上記バケットにcsvエクスポート設定

BQに入れて可視化もいずれ検討したい。
