# 実践Scala入門

Scalaの入門から実践への橋渡しとなるために書かれた本。
必要に応じて章をつまみ読みや斜め読みで、実践的なScalaプログラミングの入り口の立つのが容易であることを意図した本。

Javaについても必要な部分をきちんと解説フォローしてくれてるのは嬉しいポイント。

執筆時点でのScalaバージョンは2.12だが、2.13や3.0でも互換性がある部分が多いとのこと。
読んだ時点でのScalaは2.13.4

## What is Scala?

1. A Scalable language
  - スケーラブルな言語
  - Scala言語名の由来
2. Object-Oriented
  - オブジェクト指向
3. Functional
  - 関数型
4. Seamless Java Interop
  - シームレスなJavaとの相互運用性
  - ScalaはJVM上で動作する言語であり、既存のJavaライブラリを利用できる。
5. Functions are Objects
  - 関数はオブジェクトである
6. Future-Proof
  - Futureへの対応
7. Fun
  - 楽しい

## Scalaについて

- sbtが標準のビルドツール（2017年）
  - Lightbend社のエンジニアがフルタイムワークで精力的に開発している、最もScalaのビルドに最適化されたツール
  - 注意点
    - カレントディレクトリに`*.scala`があるとそれをコンパイルする
    - targetというディレクトリが起動したディレクトリに自動的に作成される
- 注目を集めるScala製
  - ミドルウェア
    - Apache Kafka
    - Apache Spark
  - サービス
    - Twitter
      - Twitter社の出した本
        - Scala School
        - Effective Scala
- Scalaは関数型プログラミング言語であり、かつオブジェクト指向言語である
- IDEは静的型プログラミング言語で強い
  - IntelliJ IDEA
  - Eclipse

## JVMについて

- JVM: Java Virtual Machine
- JRE: Java Runtime Environment
  - JVMを内包する
  - コンパイル済のプログラムを実行するだけならJREで事足りる
- JDK: Java Development Kit
  - JREを内包する
  - コンパイルする必要があるならJDKが必要
  - Oracle社のWebサイトからインストール可能
    - OpenJDKの公式Webサイトから無償版

## Scalaの書き方

- camelCaseが好まれる
  - 定数はCamelCase
- Scalaの条件分岐はif/else式とmatch式
  - 三項演算子は存在しない
  - どちらも式であり文ではない
    - 式は評価することで値になるもの
    - 文は評価しても値にならないもの
- for式やwhile式も値を返す
  - Unit、JavaでいうVoidに相当するもの
- Scalaの型階層は一貫性がある
  - Any: スーパータイプ
    - AnyVal: 値型のスーパータイプ
      - Byte,Short,Char,Int,Long,Float,Double,Boolean,Unit
    - AnyRef: 参照型のスーパータイプ
      - String,List,ユーザ定義クラス
        - Null: 全ての参照型のサブクラス
  - Nothing: 全ての型のサブタイプ
- タプルという複数の型（上限22個）をまとめて表現できる型がある
- 無名クラスという概念がある
  - あるクラスを継承したクラスのインスタンスをその場で作れる
- 暗黙の型変換を定義できる`implicit`
  - enrich my libraryパターン
    - 暗黙クラス（implicit class）が定義できる
- 暗黙のパラメータ
  - `implicit val`
- Optionくらいからわからなくなってきた
  - わからないのはmapとflatMapの話かもしれない
- Eitherという抽象クラス 2つのうち片方
  - エラー処理の文脈で成功値か失敗値を示すのに適している
    - 慣習的にLeftを失敗時、Rightを成功時とすることが多い
  - .foreachでRightのみ実行する関数を指定できる
    - .left.foreachでLeftのみ実行も可能
- Try抽象クラス 非同期処理での結果取得に
  - SuccessとFailureの具象クラスを持つ FailureはThrowableで固定のため型パラメータは一つだけ
- コレクション
  - データ型
    - Seq
      - 要素が一列に並んだコレクション 添字により任意の要素にアクセス可能
      - ListはSeqの実装のひとつ、他にVector,Stream,ArrayBuffer,ListBufferが挙げられる
    - Set
      - 集合を表すコレクション、重複した要素を含まない
    - Map
      - キーと値のコレクション
  - Seq,Set,Mapはそれぞれトレイトであり、それぞれ複数の具象クラスを持つ
  - 一般には不変なコレクションが好まれる
  - scala.collection.JavaConvertersでJavaコレクションクラスと変換可能
- forはflatMap,map,withFilter,foreachに勝手にコンパイル時に変換される
  - <-はforでジェネレータを示すための演算子
  - x <- 式
    - xは好きな名前のループ変数
  - ;(セミコロン)区切りでfor1つに複数のジェネレータを記述し、多重ループを行うことも可能
    -  セミコロンでなく改行でもいいのかも
  - forの中でyieldを使うことがある
    - yieldが何なのか本書内で説明がない…想像はつくけど…
      - 何らかの言語のプログラミング経験者想定っていうけど、ジェネレータの概念を学んでいない人は言語によってはいるんじゃないか？
- 並行プログラミング
  - とは
    - 逐次（sequential）でなく並行（concurrent）
    - 複数の処理を並行して実行するプログラミング手法
    - 一般的にスループットと即応性を向上させるが、その一方で排他制御の複雑さも持ち込んでしまうことがある
  - scala.concurrent.Future

