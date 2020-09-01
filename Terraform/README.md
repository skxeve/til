# Terraform

IaC（Infrastracture as Code）を実現する構成管理ツール。

GCPやAWSをまたいで管理することが可能。

## 用語

### Provider

ざっくりサービスプロバイダーのこと。

- IaaS（AWS,GCP,Azure,OpenStack)
- PaaS（Heroku）
- SaaS（TerraformCloud,DNSimple,Cloudflare）

### Module

よくわからない…名前と雰囲気では複数のTerraform設定から呼び出せるようにした共通設定のような印象を受ける。

> 関連するリソースを管理する、Terraform設定の自己完結型コレクション。
> 
> 他のTerraform設定からモジュールを呼び出すことが可能。
> 呼び出し元は入力変数を設定することができ、出力値を受け取る。


## 実施

Learn Terraformを中心に資料を読みながら実際の構築に重要そうな部分を抜粋。

### Build Infrastructure

Terraformは`.tf`または`.tf.json`で終わるファイルを実行時に読み取る。

ファイルに必要な最小限のブロックはおそらく3個

- terraform
  - required_providersを定義する。ここで指定したプロバイダを次のproviderで使用する。
- provider
  - プロバイダへのアクセス情報などを定義する。
- resources
  - 構築リソース情報を、リソースタイプとリソース名を併記しつつブロックを介しする。
  - リソースタイプと名前を連結してリソースIDとなる。
  - リソースごとの構成は各リソースプロバイダーに依存する。

実行にあたっては、専用のアプリケーションアカウント（サービスアカウント）を作成しておくことが推奨される。
GCPの場合、ロールはプロジェクト編集者。

### Initialization

```
$ terraform init
```

Gitからcloneした直後を含めて、Terraform設定の初期化時に実行する最初のコマンド。  
プロバイダのプラグインが同ディレクトリにダウンロード、インストールされる。


### Creating Resources

```
$ terraform apply
```

設定を適用する。
プランが正常に作成できた場合は実行プランが表示され、`yes`の入力を求められる。

実施するとTerraformは`terraform.tfstate`ファイルにデータを書き込む。
このstateファイルは、Terraformによって作成されたリソースを追跡・理解するのに極めて重要である。
stateファイルをバージョン管理に含めてはならない。

以下コマンドで現在のstateを調べることが可能。

```
$ terraform show
```

事前に以下コマンドでプランのみ表示することも可能
```
$ terraform plan
```

#### Adding or Changing Resources

設定を変更して、`terraform apply`を実行する。

### Destroy Resources

```
$ terraform destroy
```

Terraform設定に記述された全てのリソースを削除する。
確認に`yes`の入力は求められる。

### Implicit and Explicit Dependencies

リソースの記述の階層構造や代入関係から、Terraformは暗黙的な依存関係を推測し、自動的にリソースの作成順序を決定する。
`depends_on`引数にリソースIDリストを指定することで、明示的な依存関係を指定することもできる。

可能な限り暗黙的な依存関係を利用することが望ましい。

### Provision Infrastracture

GCEを代表例として、作成されたインフラはプロビジョニングされる必要がある。

Terraformではファイルのアップロード、シェルスクリプトの実行、構成管理ソフトウェアをインストールしてトリガー実行したりできる。

#### Provisioner

`resource`ブロック内に複数の`provisioner`ブロックを定義可能。
`provisioner`ブロックにはプロビジョナーを併記する。

プロビジョナーはリソースが作成された時のみ実行される。
`terraform taint`でリソースに汚染マークをつけ、再作成することができる。
次回の`terraform apply`時に汚染マークをつけられたリソースは破棄と作成が行われる。

```
$ terraform taint リソースID
$ terraform apply
```

リソースの作成には成功したがプロビジョニングに失敗したリソースは自動的に汚染マークされるが、即座に破壊はされない。

リソース破棄時にのみ実施されるProvisionerも定義することは可能。

### Input Variables

変数を定義するtfファイルを作成

`variable`ブロックに、変数名を併記して宣言し、`default`値を指定できる。
デフォルト値がない場合、実行時に入力が必須になる。

```
variable "project" { }
variable "region" {
  default = "us-central1"
}
```

構成ファイルの中で、変数はPrefix`var.`を使用し`var.name`のような形で指定する。

`type`を指定することで、型を明示的に指定しておくことが可能。

- string
- number
- list
- map

#### Assign Variables

変数を指定する方法はいくつかある。

- `-var`フラグを実行時に指定する方法
- ディレクトリの`terraform.tfvars`または`*.auto.tfvars`ファイルを自動的に読み込んで変数を設定する方法
  - `-var-file`フラグでロードするファイルを指定することもできる。
- `TF_VAR_name`環境変数が定義されていれば、これを自動的に発見し`name`変数を設定する。
- `terraform apply`実行時に求められる変数をインタラクティブに入力する

### Output Variables

`terraform apply`の結果、生成した全てではなく、いくつかの重要な値にのみ関心があるケースがある。
`output`ブロックはどのデータが重要であるかをTerraformに伝え`apply`時に出力され`terraform output`コマンドで参照できる。

`terraform refresh`でクラウド上のリソースを参照しながらoutputを生成することができる。


