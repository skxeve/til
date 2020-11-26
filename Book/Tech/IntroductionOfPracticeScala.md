# 実践Scala入門

Scalaの入門から実践への橋渡しとなるために書かれた本。
必要に応じて章をつまみ読みや斜め読みで、実践的なScalaプログラミングの入り口の立つのが容易であることを意図した本。

Javaについても必要な部分をきちんと解説フォローしてくれてるのは嬉しいポイント。

執筆時点でのScalaバージョンは2.12だが、2.13や3.0でも互換性がある部分が多い。

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

