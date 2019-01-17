# Domain setting

Google Domainで取得したドメインをGAEアプリケーションに設定

マネージドSSLがあるのでhttpsも簡単。

## GoogleDomainsで使いたいドメインを取得

移管とか方法は色々あるとは思う。
ここは割愛。

## AppEngine側の設定

GCPメニューで、AppEngine → 設定 → カスタムドメイン → カスタムドメインを追加

から設定する。

ドメインを選び、設定するサブドメインを入力したら、この後追加すべきDNSレコード情報が出てくるので、これをメモ（またはタブを開いたままにしておく）

## GoogleDomains側の設定

GoogleDomains → ドメイン選択 → DNS → カスタムリソースレコード

から先ほどのDNSレコード情報を登録。
