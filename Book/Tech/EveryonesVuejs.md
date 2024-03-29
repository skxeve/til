# みんなのVue.js

Vue.jsの考え方について書かれていてわかりやすい。
拾い読みだが、参考になる情報が多かった。これまで色々なサイトや資料で見てきた内容がコンパクトにわかりやすくまとまっている感じ。

## 2章 状態管理について

### 基本的なこと

- 状態の量を必要最小限に保つこと
  - 認知管理コストや、それに起因するバグの発生リスクを抑えられる
  - 状態ではない、参照するためのデータは算出プロパティに持つ
- 暗黙的な状態の変更を避ける
  - propsで受け取ったオブジェクトを子で書き換えない
    - v-modelやv-onでのテンプレートでの書き換えも同様
      - computedのsetterを使うなどしてイベント通知するようにする

### 状態とサイクル

- UIの状態
- DBから取得したデータ
- 通信処理の状態
- ナビゲーションの状態

フロントエンドは以下のサイクルで構成される

1. ビュー
2. アクション
3. 状態

Vue.jsはこれを行う。

### Option API

data関数はプレーンなオブジェクトを返却するファクトリ関数。

> data関数が返却するプレーンなオブジェクトが、コンポーネントのインスタンス化時にVue.jsのりアクティブシステムへと登録され、コンポーネントにおける状態データとして機能するようになります。

### Composition API

> setup関数の戻り地として返却したオブジェクトがそのままコンポーネントのインスタンスプロパティもしくはインスタンスメソッドとして扱われるため、状態データは返却するオブジェクトのプロパティとして定義する。

OptionAPIと違い、データのリアクティブ化は開発者が実施する必要がある。

#### リアクティブ化とは

Vue.jsがビューを描画したり算出プロパティを計算するため、Vue.jsが状態データの変更を検知できるようにすること。

### 状態のスコープ

Vue.jsのコンポーネントは、UIが持つ状態・ビュー・アクションをカプセル化したもの。
カプセル化されているということは、外部から隠蔽されていることを意味する。

#### props

親→子のコンポーネント間通信。
外部から明示的にデータを受け取る唯一のインターフェースであり、関数の引数に該当する概念。

#### event

子→親のコンポーネント間通信。
任意の名前のイベントをemitを使って`this.$emit("onChangeMessage", message)`のように発火させることで、親へデータを送信できる。
親側で受け取るにはハンドラー関数を`<Child @onChangeMessage="setMessage" /`のように設定する。

#### 親子コンポーネントの依存関係

親は子コンポーネントのpropsやeventの定義を知っている必要があり、これは親が子の実装に依存していることを意味する。

#### 兄弟コンポーネント間のデータ共有

Vue.jsの機能には存在しない。
共通の親コンポーネントにデータを持たせるか、ストアを利用した状態管理パターンを取り入れる必要がある。
前者のパターンだと親コンポーネントの責務が肥大化していくことに注意が必要。

#### SFC（Single File Component）による利点

SFCを使うことで、コンポーネントが持つ状態・ビュー・アクションすべてを1つの.vueファイルに完結させられる。
Vuexなどのストア層が加わると、その見通しの良さが減少・失われることがある。Vuexを使わないことはSFCの恩恵を最大化することに繋がる。

#### propsとeventによる過剰なバケツリレーを解決するストア

SFCのみで状態管理をしようとすると、アプリケーションの規模に比例してバケツリレーが発生しやすくなり、その困難さを増す。
これを解決したいと思うとき、コンポーネント層から状態管理を分離して独立したレイヤー（ストア）で管理し、複数コンポーネントで共有したいと考え始める。

ストアを利用する目的は、状態とアクションをコンポーネント層から切り離すことにある。
これにVuexが活躍することがある。
Vuexが目的に対して高機能すぎる、学習コストや導入コストが高い場合、シンプルなStoreパターンであれば自前で実装することもできる。
これはVuexがグローバルスコープになるのに対して、限定したスコープで導入できるメリットもある。一方、状態が複数ストアに分散し全体の状態把握が難しくなるリスクもある。


## 3章 UIコンポーネントの開発

「関心の分離」により分割して開発するコンポーネント駆動開発

### コンポーネントの責務

2種類ある

1. 状態管理や機能提供
2. 見た目だけ

#### UIコンポーネント

見た目だけに責務を持つようにして、他のコンポーネントの状態には感知しないようにしておく必要がある。
状態は「props down, event up」の考え方を用いてやりとりを行う。

##### props

validatorプロパティを使おう

##### slot要素

親要素で設定したコンテンツ（タグの開閉の間に記述した内容）が\<slot\>要素に置き換わる。

疑問点としては、\<slot\>要素のコンテンツはどこに行くのか？がわかっていない。（Vue.jsのマニュアルを見よう！）

### コンポーネント駆動開発のFIRST原則

- Focused 焦点を絞る
- Independent 独立
- Reusable 再利用可能
- Small 小さく
- Testable テスト可能

### Vue3の新要素

#### Fragments

ReactのFragmentsに影響された機能。
ルートノードを複数持つことができるようになった。

#### Teleport

コンポーネントをDOMツリーの別の場所にレンダリングすることができる。
まさに「コンポーネントがテレポートする」ような機能。portal-vueを公式採用したもの。

#### SFC State-driven CSS Variables

コンポーネントの状態に応じてスタイルを動的に更新する機能。CSSネイティブの変数を利用。

### Tips

#### Atomic Design

コンポーネント分割の指針として、おそらく最も有名な方法

#### UIコンポーネントライブラリ

学びが多い教材。もちろんそのまま導入しても良い。

#### 共通コンポーネント

プログラミング的には一般的な話でもあるが

- 共通化すると影響範囲を気にする必要が出てきてスピードが落ちやすくなる
- 多少冗長でも無理に共通化させないほうがプロダクトの開発スピードを落とさない場合もある

#### コンポーネント登録

- 通常はimportして使う
- require.contextを使った特定フォルダ内のコンポーネント自動登録も可能だが、利用コンポーネントが暗黙的になってしまうデメリットがある。

