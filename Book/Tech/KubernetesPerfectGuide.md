# Kubernetes完全ガイド

執筆は2018年8月時点でのもの。2020年時点でもほぼ通用する知識と思われる。

途中まで読んでいるが、Kubernetesに触れないと他では使わない知識や概念が多いように感じている。便利そうなのは感じられる。

## 1章：Dockerの復習

Dockerについて簡潔に要点を抑えつつおさらいしてくれる。
一応Dockerについては知っているつもりだが、良い内容だった。

## 2章：Kubernetesとは

### 用語整理

- Kubernetes
  - コンテナ化されたアプリケーションのデプロイ、スケーリングなどの管理を自動化するためのプラットフォーム
    - コンテナオーケストレーションエンジン
- コンテナランタイム
  - Dockerなど
- Kubernetes Node
  - コンテナランタイムが起動するノード
- Kubernetes Master
  - Kubernetes Nodeを管理するノード
- コンテナ
  - 何らかのアプリケーションを実行するようにビルドされたコンテナイメージを元に、起動されたワークロード
- クラスタ
  - 複数のKubernetes Nodeを管理する単位？
- スケジューリング
  - コンテナをどのKubernetes Nodeにデプロイし配置するかを決定するステップ。
  - AffinityとAnti-Affinity機能を使用することで細かい設定が可能。
- セルフヒーリング
  - Kubernetesは標準でコンテナのプロセス監視を行っており、停止を検知すると再度コンテナのスケジューリングを実行し自動的にコンテナを再デプロイする。

### Kubernetesについて

Dockerを始めとするコンテナランタイムは単体では単一のコンテナを動かすだけの機能にとどまり、複数を束ねて大規模なシステムを構築運用するのに必要となる技術。
Kubernetesはyamlやjsonで記述した宣言的コードによってコンテナや周辺リソースを管理でき、IaCを実現可能。

Kubernetesはコンテナクラスタを形成して、複数のKubernetes Nodeを管理する。
同じコンテナイメージを元にした複数のコンテナ（レプリカ）をデプロイすることで、負荷分散や耐障害性の確保が可能。オートスケーリングも可能。

コンテナをスケーリングさせると、アプリケーションへ接続するためのエンドポイントの問題が発生する。
Kubernetesではロードバランシング機能（Service）を有しており、あらかじめ指定した条件に合致するコンテナ群に対して、ルーティングを行う機能を提供する。
障害時にコンテナをServiceから切り離しや、ローリングアップデート時の事前切り離しなども自動的に実行してくれる。
エンドポイントの管理をKubernetesに任せることが可能。

Kubernetesでシステムを構築する場合には、マイクロサービスアーキテクチャを採用することが一般的。
個々のマイクロサービスがお互いのマイクロサービスを参照できるために、サービスディスカバリ機能が役立つ。

Kubernetesはバックエンドのデータストアにetcdを採用している。
etcdはクラスタを組むことで冗長化できるため、コンテナやServiceに関するマニフェストも冗長化されて保存されている。
コンテナが利用する設定ファイルや認証情報などのデータを保存する仕組みも用意されており、コンテナで共通の設定やアプリケーションから利用されるDBパスワードなどの情報を、安全かつ冗長化された状態でKubernetes上で集中管理できる。

### Kubernetes最短入門

コンテナのデプロイからサービスを外部公開するまでに必要なコマンドは、たった2ステップ。
本当に基本的なことはこれだけで、あとはどのようなコンテナをどのように起動していくかをKubernetesの機能を利用して実現していくだけ。
コマンドを用いなくても、マニフェストファイルを使用することでコード化して管理することもできる。

1. `kubectl run myapp --image=nginx:1.12 --replicas 3 --labels="app=myapp"`
  - 公開するコンテナとしてWebサーバであるnginxのコンテナイメージからコンテナを3つ起動
2. `kubectl create service loadbalancer --tcp 80:80 myapp`
  - 上記コンテナとロードバランサを紐付けサービスを外部公開する
  - LoadBalancerを作成するとサービス公開に必要なIPアドレスが払い出される。
3. `kubectl get service myapp`
  - IPを取得


## 3章：Kubernetes環境

大きく分けると3種類ある

- ローカルKubernetes
  - 手元のマシン1台に構築
- Kubernetes構築ツール
  - ツールを利用して任意の環境にクラスタを構築
- マネージドKubernetesサービス
  - パブリッククラウド上のマネージドサービスとして提供されるクラスタを使用
  - 代表的なものではGKE、AKS、EKS
  - 基本的にはこれ

## 4章：APIリソースとkubectl

Kubernetesリソースは大きく分けて5種類ある

### Workloadsリソース

コンテナの実装に関するリソース、8種類ある

- Pod
- ReplicationController
- ReplicaSet
- Deployment
- DaemonSet
- StatefulSet
- Job
- CronJob


### Discovery & LB リソース

コンテナを外部公開するようなエンドポイントを提供するリソース

内部的なものを除けば2種類ある

- Service
  - ClusterIP
  - ExternalIP
  - NodePort
  - LoadBalancer
  - Headless
  - ExternalName
  - None-Selector
- Ingress

### Config & Storage リソース

設定/機密情報/永続化ボリュームなどに関するリソース

- Secret
- ConfigMap
- PersistentVolumeClaim

### Clusterリソース

セキュリティやクォータなどに関するリソース

- Node
- Namespace
- PersistentVolume
- ResourceQuota
- ServiceAccount
- Role
- ClusterRole
- RoleBinding
- ClusterRoleBinding
- NetworkPolicy

### Metadataリソース

クラスタ内の他のリソースを操作するためのリソース

- LimitRange
- HorizontalPodAutoscaler
- PodDisruptionBudget
- CustomResourceDefinition

### CLIツールkubectl

Kubernetesでは、クラスタの操作は全てKubernetes MasterのAPIを介して行われる。
クライアントライブラリ、またはkubectlを利用して操作できる。

この辺から説明ない用語が出てくるようになってくる。先にリソースの説明やったほうがいいのでは…

色々なリソースの操作について例を交えつつ解説している。

## 5章：Workloadsリソースについて

8種類のリソースがあるが、Podを最小単位として、それらを管理する上位リソースが存在するという親子関係になっている。

- ReplicationController(廃止予定) -> Pod
- Deployment -> ReplicaSet -> Pod
- DaemonSet -> Pod
- StatefulSet -> Pod
- CronJob -> Job -> Pod

### Pod

- Podは1つ以上のコンテナから構成されている
  - 基本的には1Podが1コンテナと考えて良い
- 同じPodに含まれるコンテナ同士はネットワーク的に隔離されておらず、IPアドレスを共有している
- Pod内のコンテナはお互いにlocalhost宛で通信することが可能
- 1Pod複数コンテナの構成についてデザインパターンが提唱されている
  - サイドカーパターン
    - メインコンテナに機能を追加する
  - アンバサダーパターン
    - 外部システムとのやり取りの代理
  - アダプタパターン
    - 外部からのアクセスのインターフェース
