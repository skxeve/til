# アジャイルサムライ

アジャイルの本質は可視化と透明化であり、メンバーには意欲と能動性が、そしてPOには有能さが求められる、と言えそう。  
アジャイルは決して簡単なものではないし、万能でもない。
無理なものは奇跡が起きない限り無理なままだが、ただその事実が早期にわかるようになる。

## 用語

- アジャイル
  - ソフトウェアの開発の進め方のひとつ
- マスターストーリーリスト
  - プロダクトバックログのこと。
  - プロジェクトのTODOリスト、ユーザーストーリーリスト、概要がわかれば十分。
- イテレーション
  - スプリントのこと。期間。
- ベロシティ
  - 1回のイテレーションで完了させられるストーリーの量。
- 完了
  - コードをリリース可能にするために必要なあらゆる作業が終わっていること
- 顧客
  - プロダクトオーナー(PO)
    - POは要求の真実の源であり、ソフトウェアはPOのために作られる。
    - 期限や予算に応じて「何を作らないか」を決めるのもPOの仕事
- (ユーザー)ストーリー
  - だいたいTODOのこと。
- エピック
  - 大きなストーリー。小さなストーリーに分割して実装を行う。
- ポイント
  - 見積もりの単位。相対見積もりするための仕組み。
- リリース
  - まとめて本番環境にデプロイする価値がある単位。
  - MMF（Minimal Marketable Feature Set）
- バーンダウンチャート
  - 縦軸は残っている作業の総量、横軸は時間（イテレーション）、残作業総量をイテレーションごとにプロットしたもの。
- バーンアップチャート
  - バーンダウンと基本は同じだが、完了した総作業量をプロットして、作業量総計を別途グラフとして表示する。

## アジャイル開発の基礎

1. 大きな機能は小さくする
2. 選択と集中
3. フィードバックを求める
4. 必要に応じて進路を変える
5. 成果責任を果たす
6. 期待値をマネジメントする

### アジャイルのエッセンス

- アジャイルはPOと開発チームのみで構成される。
- 明確な役割分担はない、なんでもやる
- チームに積極的に関わらないPOというのは犯罪的
- アジャイルとは関係なく有能なマネージャなら誰もが普段からやっていること
  - 継続的に計画を建てる
  - 建てた計画を見直す
  - プロジェクトの方向性を調整する
  - チームへの期待値の調整
- 自己組織化を引き起こす本当の魔法、それは成果責任と権限委譲
- やりたがる者がいなければ、やりたがる者をチームに加えろ
- 文書を作ることは意思疎通の手段で、目的ではない

### 究極の手法なんて存在しない

- スクラム
- エクストリーム・プログラミング
- リーン
- カンバン
  - 運用のような仕事に携わっている場合には向いているかも
- Crystal
- そこのオリジナル

## インセプションデッキ

だめになるプロジェクトの主な2つの理由

- 答えるべき問いに答えられない
- 手ごわい質問をする勇気を持てない

10の質問
前半は「なぜ」後半は「どうやって」

1. 我々はなぜここにいるのか？
1. エレベーターピッチを作る
1. パッケージデザインを作る
1. やらないことリストを作る
1. 「お隣さん」を探せ
1. 解決案を書く
1. 夜も眠れなくなるような問題はなんだろう？
1. 期間を見極める
1. 何を諦めるのかはっきりさせる
1. 何がどれだけ必要なのか

### 荒ぶる四天王

- 時間
  - アジャイルでは固定する
- 予算
  - アジャイルでは固定する
- 品質
  - アジャイルでは高い水準で固定されたものとして扱う。
- スコープ
  - アジャイルではこれだけ動かすことができる。

## プロジェクトの運営

いちばん大事なことは、皆が安心できる雰囲気を作ること

## エンジニアリングプラクティス

近年ではごく一般的に「良い」とされるプラクティスが並ぶ。
TDDを全メンバーに求めるのはちょっとレベル高い気もするが…

- ユニットテスト
- リファクタリング
- TDD テスト駆動開発
- CI 継続的インテグレーション
