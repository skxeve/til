# エンジニアとして働く上でのTips

組織で働く前提なので個人開発だと当てはまらないこともあるかも。

## 1. 労働は健康に悪い

回復不能なレベルのダメージを負っていなければ、大体の身体的不調や精神的不調は仕事を辞めれば回復する。

## 2. 運用を想定した開発をしよう

運用を想定せずに作られたシステムは、ほぼ例外なく品質が低く、リリースしてはいけないシステムである。  
うっかりリリースした日には地獄を見る。信じられないけど実際に存在する。

## 3. 自動化できないコーディング規約は飾り

設定するにしても努力目標レベルにした方が良い。いずれ守られなくなる。  
守らせるには多大な人的レビューコストがかかるため、いっそ規約がない方が効率が良いことが少なくない。

## 4. ネーミングの重要性

コードを探すことにかける時間を減らすこと/増やすことに大きく貢献する要因である。意外とこれを重視している人は少ない。  
適切な名前をつけられない状態は、そもそも仕様の設定か理解が甘い可能性が非常に高い。

## 5. コメントにはコードが語れない内容のみを書け

処理の内容はコードを読めば普通はわかるので、書かなくて良い。  
読んでわからないコードはまず実装かネーミングを見直すべき。  
意図やTODOなどコードから読み取れない情報を残すべし。

## 6. テストの重要性

優秀なテスターは何ものにも代えがたい。  
自動テストは実装者が想定した仕様しかカバーできないが、テスターは実装者が想定しなかったバグを見つけてくれる。
（だからといって自動テストを軽視して良いという話ではない）

## 7. 自動化できることは自動化する

なんでも。些細なことでも定期的にやることは自動化して時間を節約しつつ人依存を減らそう。良いことづくめ。

## 8. ロギングは見る時のことを考えよう

ログを見なければならない時はだいたい緊急時だ。  
コードと突き合わせなくてもログの内容だけで何が起きているか理解できるように考えてロギングしよう。

## 9. 自分がいなくなった時のことを普段から考えておこう

他人が読んでもわかるようにコードや資料を普段から用意しておこう。結局は自分のためにもなる。  
「後からまとめて」は大体やらないやつ。  
あえて属人化させたい場合はこの限りではない。

