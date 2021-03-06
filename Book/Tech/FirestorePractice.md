# 実践Firestore

FireStoreのプラクティス本。  
公式ドキュメントは散文的でリンクも追い難く仕様の把握だけでなかなか苦労する面も多いが、この本は基本的な仕様からはじまり、いくらかの代表的と思われるユースケースにおける振る舞い、それに伴う使い方の観点でプラクティスが書かれている。

## Firestoreとは

- ドキュメント指向NoSQLデータベース
- 学習コストが低いというのは明確に誤り
- データベースでありながら、サーバーサイドAPIのように振舞うこともできる
- サーバーサイドAPIを中心としたアーキテクチャを採用するのであれば、あえてFirestoreを選ぶ必要はない。
- かなりアグレッシブにスキーマの変更に取り組むことになる。
  - 将来の変更を予測してデータの欠損を起こさずにスキーマを変更できるような拡張性の高いデータモデルを考えるスキルは必須になる

## 特徴的な機能

- セキュリティルール
  - クライアントからの直接アクセスを実現する上での大きな役割を担う
- リアルタイム・リスナー
  - サーバー側からクライアントへ変更通知通信が走る
  - 従来だとクライアントからサーバーへポーリングしていたところ
- オフライン対応
  - 不安定なネットワーク下でもアプリケーションをシームレスに稼働させる機能
  - 極めて例外的な状況を除いて、Firestoreの書き込み処理がエラーとなることはない。

## データモデル

- ドキュメント
  - JSONによく似た構造化されたデータ
  - Firestoreは小さなドキュメントを大量に扱うことに最適化されている
    - ドキュメント1件あたり1MiB以下制限
- コレクション
  - ドキュメントだけを保存可能
  - 最初のドキュメントが作成される際に透過的に作成される
- サブコレクション
  - ドキュメントの下位要素であるコレクション
  - ドキュメントのフィールドにマップやリストを持つことは可能だが、ドキュメントにはデータサイズに上限があり、このような問題を解決する
- コレクショングループ
  - 同一のIDを持つコレクションをひとつのコレクションとみなして扱う機能
  - サブコレクションにより階層化されたドキュメントをまとめて取得したい場合に有用
- リファレンス
  - ドキュメントやコレクションが格納されているFirestore内のパスを表現するモデル
  - DocumentReference
  - CollectionReference
- スナップショット
  - ドキュメントやクエリ結果のある瞬間における状態を表現したデータ

## ドキュメントへの操作

- 読み取りは複数まとめて可能だが、書き込みは単一に対してしかできない
- CollectionReference#doc()
  - ランダムなIDを持つDocumentReferenceを作成
  - 引数でIDを指定することも可能
    - ID値を指定してドキュメントを取得するユースケースがないのであれば、ランダムなIDを採用すべき
- DocumentReference#set()
  - createかupdateかで異なるセキュリティルールを適用
- DocumentReference#get()
  - 単一のドキュメントを取得
- DocumentReference#update()
  - 指定フィールドのみ更新、存在しないドキュメントだとエラー
- DocumentReference#delete(9
  - 削除、存在しないドキュメントでも成功扱い

## クエリ

- Firestoreのクエリ結果は全て強い整合性を持つ
- フィルタ
  - 演算子
    - 透過演算子 ==
    - 比較演算子 <, <=, >, >=
    - in句
      - 論理和（or）で10個まで指定可能
    - 配列メンバーシップ array-contains, array-contains-any
      - array-はリスト型に対するフィルタ条件、anyで論理和（or）でのクエリ
  - 複合クエリの制約
    - 等価演算子の利用には特に制限なし
    - 比較演算子はクエリごと最大1個のフィールドに対して指定できる
    - 透過演算子と比較演算子を同時に使う場合には複合インデックスを使用する
      - 複合インデックスは開発者が明示的に作成が必要
      - 必要なインデックスがない状態でクエリを発行するとエラー
    - in, array-contains, array-contains-anyはクエリごとに1回しか使えない
- orderByでソート可能
  - 範囲フィルタとorderByは同じフィールドに対してであれば同時に指定可能
- カーソルとページネーション
  - Query#startAt()
  - Query#startAfter()
  - Query#endAt()
  - Query#endBefore()
  - Firestoreは件数ベースでパフォーマンスが上下し課金もされるため、分割して必要最小限のデータを細かく取得する戦略が優れている。

## アトミックオペレーション

- トランザクション
  - 先にまとめて読み込みオペレーション → まとめて書き込みオペレーション
  - 再試行はトランザクション全体の処理ごと行われる
- 一括書き込み（WriteBatch）
  - 複数の書き込みオペレーションをアトミックに実行、読み込みオペレーションは不可
- FieldValue活用
  - FieldValue#increment()
  - FieldValue#arrayUnion()
  - FieldValue#arrayRemove()

## セキュリティルール

特別な事情がない限り、複数のユースケースをカバーできるようなルールを書くことは避けるべき

## ドキュメント設計の原則

公開範囲の異なる情報を同じドキュメントに格納してはいけない
