# アトミックデザイン

色々いう人がいて混乱してきたので一度整理する

## 概要

アトミックデザインは化学式から閃いた設計らしい。
あくまでデザイン手法であり、実装を前提にしたものではない。これはテンプレート層とページ層のあり方を見れば何となくわかる。

## レイヤーの分け方

アトミックデザインは以下5段階で構成される。

1. 原子 Atoms
2. 分子 Molecules
3. 生物 Organisms
4. テンプレート Templates
5. ページ Pages


### 原子 Atoms

- 基本的な構成要素として機能する
- 機能を停止せずにこれ以上分解できない基本的なHTML要素が含まれる
- e.g. フォームラベル、入力、ボタン

### 分子 Molecules

- ユニットとして一緒に機能するUI要素の比較的単純なグループ
- 水(H2O)と過酸化水素(H2O2)が同じ原子で構成されていても特性や動作が全く違うことを思い浮かべて欲しい
- e.g. 検索フォーム

### 有機体 Organisms

- 分子、原子、有機体のグループで構成される比較的複雑なUIコンポーネント
- Organismsは日本語訳すると生物、生命体、有機体、有機的組織体、といった意味になる（5層の英単語の中でOrganismsが特に耳慣れない）

### テンプレート Templates

- コンポーネントをレイアウトに配置し、デザインの基礎となる*コンテンツ構造*を明確にするページレベルのオブジェクト
- ページの最終的なコンテンツではなく、ページの基礎となるコンテンツ構造に焦点を当てている
- 分子や生物を使って構築
- ページの骨格

### ページ Pages

- 実際の代表的なコンテンツが配置されたUIがどのように見えるかを示すテンプレートの特定のインスタンス
- 骨格に肉をつける
