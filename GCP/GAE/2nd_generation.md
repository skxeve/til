# GAE 2nd generation

Pythonの記事だが、2nd generationになると使えなくなる機能がいくつかある模様

[参考記事](https://qiita.com/wasnot/items/97cc0e058cecfcc0889d)

- UsersAPIがなくなる
- MailAPIがなくなる
- Memcachedがなくなる？
- dev_appserver.pyでローカルできなくなる


UsersAPIが廃止になるのが影響大きくて、あれがないと楽にGoogleアカウントで認証させられなくなりそう。  
ちゃんとアプリ登録して認証やれってことなんでしょうかね…  
FirebaseAuthはどうもモバイル専用というかFirebase（CloudFunctions）どっぷりじゃないと使えなさそうだし…あっち料金高いし…
