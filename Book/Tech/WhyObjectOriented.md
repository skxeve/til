# オブジェクト指向でなぜつくるのか

タイトルの問いに答えることを目指した本、とのこと。
オブジェクト指向について復習と理解を深めるのに非常に役に立った。
開発における基礎的な知識や歴史を網羅しており、GoFの23デザインパターンの紹介もしている。入門書としても悪くないと思われる。

オブジェクト指向とは元々はソフトウェア開発のコンセプトであり、現在はソフトウェア開発の総合技術となった。OOPはその一部としてのプログラミング的な側面に過ぎない。
OOPの仕組みを使うだけで保守性や再利用性が向上するわけではない。大事なのは保守性や再利用性を高めるという心がけと行動であり、OOPはその手段として存在している。

## 本書の構成

まえがき＋12章＋補章で構成される

1章は全体の導入。
2章は前半部の導入。
3〜6章はオブジェクト指向の中核であるプログラミング技術の説明。
7章は後半部の導入。
8〜11章ではプログラミングから派生した応用技術の説明。
12章は全体のまとめ。
補章では関数型言語の紹介。

1. オブジェクト指向はソフトウェア開発を楽にする技術
2. オブジェクト指向と現実世界は似て非なるもの
3. OOPを理解する近道はプログラミング言語の歴史にあり
4. OOPは無駄を省いて整理整頓するプログラミング技術
5. メモリの仕組みの理解はプログラマの嗜み
6. OOPがもたらしたソフトウェアとアイデアの再利用
7. 汎用の整理術に化けたオブジェクト指向
8. UMLは形のないソフトウェアを見る道具
9. 現実世界とソフトウェアのギャップを埋めるモデリング
10. 擬人化して役割分担させるオブジェクト指向設計
11. オブジェクト指向から生まれたアジャイル開発
12. オブジェクト指向を使いこなそう
13. 関数型言語でなぜつくるのか

## オブジェクト指向はなぜ難しいのか

最初に出会ったプログラミング言語がオブジェクト指向だった世代の人達にとっても、この技術は簡単に身に付くものではないらしい。
抽象的でとっつきづらい技術と考える人も少なくない。
難しいと思われてしまう理由は、抽象的なことと、比喩を使った説明による混乱が主であるとされる。

OOPの基本的な仕組みには以下が挙げられるが、多岐にわたるため習得には時間を要する。

1. クラスとインスタンス
2. インスタンス変数
3. メソッド
4. コンストラクタ
5. 可視性
6. 継承
7. スーパークラスとサブクラス
8. ポリモーフィズム
9. パッケージ
10. 例外
11. ガベージコレクション

時代がオブジェクト指向に追い付いてきた。

## オブジェクト指向とは何か

オブジェクト指向はソフトウェア開発の総合技術と表現するべきものになった。

1. OOP
2. 再利用部品群
    - クラスライブラリ
    - フレームワーク
    - コンポーネント
3. デザインパターン
4. UML（統一モデリング言語）
5. モデリング
    - 業務分析
    - 用件定義
    - 設計
6. アジャイル開発手法

厳密には「オブジェクト指向プログラミング言語」をOOPL、OOPLを使ってプログラミングすることをOOPと呼ぶのが正しいが、オブジェクト指向言語の仕組みと、それを用いたプログラミングを厳密に区別しない文脈も多いため、まとめてOOPと表現する。

### OOPの３大要素

1. クラス（カプセル化）とインスタンス
    - クラスは「（サブルーチンと変数を）まとめて、（内部だけで使う変数やサブルーチンを）隠して、（インスタンスを）たくさん作る」仕組み
2. ポリモーフィズム
    - abstractやinterfaceのこと
3. 継承
    - スーパークラスとサブクラス

### オブジェクト指向のコンセプト

考案者アラン・ケイ氏がオブジェクト指向と名付けたのは「独立性の高いオブジェクトが非同期のメッセージを送り合うモデル」というコンセプトだった。
これを重視するならば、オブジェクト指向はあくまでこのコンセプトのことで、それをプログラミングや現実成果のモデル化に当てはめるという考え方になる。

### 保守に強く再利用しやすいソフトウェア設計

1. 重複を排除する
2. 部品の独立性を高める
3. 依存関係を循環させない

### UML

Unified Modeling Language
統一モデリング言語

ソフトウェアの機能や内部構造を図式表現するための統一記法。自然言語とコンピュータ用言語の欠点を補うための言語。

UMLには13のダイアグラムがある。

1. クラス図
2. 複合構造図
3. コンポーネント図
4. 配置図
5. オブジェクト図
6. パッケージ図
7. アクティビティ図
8. シーケンス図
9. コミュニケーション図
10. 相互作用概要図
11. タイミング図
12. ユースケース図
13. ステートマシン図

幅広い用途を想定しているが、代表的な3つの使い方が以下

1. OOPのプログラムの構造や動作を表現する
  - クラス図、シーケンス図、コミュニケーション図がよく使われる
2. 汎用の整理術としての成果物を利用する
3. オブジェクト指向で表現できない情報を表現する
  - ユースケース図、アクティビティ図、ステートマシン図（状態遷移図）が代表的

## ソフトウェア開発手法

### ソフトウェア開発の3ステップ

1. 業務分析
2. 要件定義
3. 設計

### オブジェクト指向から生まれたアジャイル開発 持続的な開発

アジャイル開発は、小さなリリースを繰り返しながら段階的にソフトウェアを作り上げる開発手法で、中間成果物を極力排除し顧客やメンバーとの協力を重視して変化に柔軟に対処することに主眼を起きます。
アジャイルソフトウェア開発宣言により広く知られるようになった。代表的プラクティスとして以下がある

1. テスト駆動開発
2. リファクタリング
3. 継続的インテグレーション

機能拡張や仕様変更を継続的に行うため、コードの品質が劣化しないよう維持し続けるノウハウが詰まっている。

### 変更を抑えるウォーターフォール型 管理者の開発

ソフトウェアより文書を作るコストの方が安い前提。
管理者の視点で考えられている。

### 多くのタブーを破ったXP プログラマの開発

4つの価値

1. コミュニケーション
2. シンプルさ
3. フィードバック
4. 勇気

プログラマの視点で考えられている。

### 枠組みを定めたスクラム チームの開発

役割を3個に定めた

1. プロダクトオーナー
2. 開発チーム
3. スクラムマスター

軽量なプロセスのフレームワークになっているため、XP等のプラクティスと組み合わせが自在。
チームの視点で考えられている。

## 関数型言語

OOPは構造化プログラミングの弱点を補うもの。
比較的新しい言語は3つめのパラダイムとしてFP（Functional Programming）をサポートしており、基礎的な知識は持っておくべき時代となってきた。
関数型言語には特殊な用語が沢山ある。

### 関数型言語の７つの特徴

1. 関数でプログラムを組み上げる
    - 関数型言語では、関数の実行を「引数に関数を適用する」と表現する
    - 純粋に引数を戻り値に変換する仕組みであるため
2. すべての式が値を返す
    - 関数型言語では、プログラムの構成要素を「命令文」ではなく「式」と呼ぶ
    - 命令を実行する（execute）、ではなく、式を評価する（evaluate）
    - 命令型言語は手続き的であり、関数型言語は宣言的と表現することがある
    - 最後に評価した式の値が関数の戻り値であり、return文はない
3. 関数を値として扱える
    - 関数を値として取り回せるプログラミング言語の性質、あるいは関数そのものを第一級関数と呼ぶ
    - 関数を引数や戻り値として扱う関数を高階関数と呼ぶ
    - OOPのポリモーフィズムと似た効果をシンプルに実現できる
4. 関数を引数を柔軟に組み合わせることができる
    - 引数を一部固定した関数を作ることができる部分適用
        -  １つ目の引数を受け取って２つ目以降の引数を取る関数を表現することをカリー化と呼ぶ
    - 同じ引数に複数の関数を続けて適用する関数の合成
5. 副作用を起こさない
    - 変数の内容をあとから変更できない
        - 代入ではなく束縛と表現する
    - 副作用がない関数は、引数が同じなら戻り値は必ず同じになる。これを「参照透過性」と呼ぶ
        - これにより遅延評価方式を採用できる
6. 場合分けと再帰でループ処理を記述する
    - 引数の値によってロジックを場合分けして定義できる
7. コンパイラが型を自動的に推測する
    - 型推論、多相性

## Tips

- 「ネオダマ」とは
    - 1990年代にIT業界で流行した、企業システムの目指す方向を表す言葉
        - ネットワーク
        - オープンシステム
        - ダウンサイジング
        - マルチメディア
- バズワード
    - たいていは半年くらいが寿命、３年もてば長持ち
    - オブジェクト指向自体は1960年代に誕生した古い技術だが、2000年以降にバズワードとして普及した
- 構造化プログラミング
    - GOTOレスプログラミング
- COBOLコンパイラはCOBOLで作られている
- ハリウッドの原則
  - Don't call us, we will call you.
- フレームワークとライブラリ
  - ライブラリは単に再利用部品を示すだけ
    - フレームワークは特定の目的を果たすためのアプリケーションの半完成品
- アスペクト指向プログラミング（AOP）
  - プログラムの様々な部分に分散してしまう横断的な機能をまとめて記述することで、ソフトウェアの柔軟性を向上させる手法

### プログラムの実行方式

- コンパイラ方式
- インタプリタ方式
- 中間コード方式
  - Java VM(Virtual Machine)がこの方式の実行環境に当たる

### プロセスとスレッド

- スレッドはプログラムの実行単位
- プロセスの中に複数のスレッドが存在できる
- マルチスレッド環境はOSの機能

### プログラムのメモリ領域

- 静的領域
  - 実行開始時に確保され、終了まで配置が固定される
- ヒープ領域
  - 実行中に動的に確保するため予め大量に確保しておく有限の領域
- スタック領域
  - スレッド制御に使う、スレッドごとに1つ

### コンポーネント

定義が曖昧な言葉

- OOPのクラスよりも粒度が大きい
- バイナリ形式
- コンポーネントの定義情報を含めて提供される
- 機能の独立性が高く、内部の詳細を知らなくても利用できる

