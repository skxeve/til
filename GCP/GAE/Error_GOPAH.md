# GOPATHエラー

GAEデプロイ時にGOPAHのエラーが出ることがあった。

'''
Your app is not on your GOPATH, this build may fail.
'''

しかしgoソースコードは一行も編集していない、というか配下の画像ファイルを増やして設定ファイルを少しいじっただけ。
試しに画像を消してみたらデプロイ通った。GOPATH関係ない。

時に不正確なエラーメッセージが出るので注意すること。