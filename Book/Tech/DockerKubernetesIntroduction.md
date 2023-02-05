# Docker/Kubernetes 実践コンテナ開発入門

# Dockerとは

> Dockerはコンテナ型仮想化技術を実現するために実行される常駐型アプリケーションと、それを操作するためのコマンドプロンプトインターフェイスから成るプロダクト。

Dockerは優れたポータビリティを持ち、ローカル環境、開発環境、本番環境の全てで利用し、デプロイすることができる。
アプリケーションと実行環境をセットで扱えるようになったことが大きな特徴であり、各種IaaSの充実、IaC、マイクロサービスアーキテクチャなどとの親和性も高く、本番環境で使うことを前提に導入すべき技術となってきている。

Dockerイメージとコンテナはクラスとインスタンスのような関係。
コンテナは１つの独立したマシンのように扱うため、コンテナポートに外部からアクセスするにはポートフォワーディングでホストのポートとコンテナポートを紐付ける必要がある。

```
# ホスト9000とコンテナ8080を紐付け
$ docker container run -d -p 9000:8080
```

Dockerコンテナは以下３種類のいずれかの状態に分類される。これをライフサイクルと呼ぶ。

1. 実行中
2. 停止
3. 破棄

起動された直後は実行中であり、実行が完了すると停止の状態に移行する。
停止したコンテナは終了時の状態を保持しており、再実行が可能。
破棄することで完全に削除することになる。

以下はコマンド実行時の頻出オプション

- -it: 標準出力を繋ぎっぱなしにし、疑似端末を有効にする
- -rm: コンテナ終了時にコンテナを破棄する
- -v: ディレクトリやファイルを共有する


## Docker Compose

Docker Composeによって複数のコンテナ実行を一括管理できる。

コンテナ構築に関するDockerの公式見解

> Each container should have only one concern
> コンテナは１つの関心事だけに集中すべきだ

Data VolumeはDockerコンテナ内のディレクトリをディスクに永続化するための仕組み（-vオプション！）

Data Volumeコンテナという手法があり、その名の通りデータだけを保つためのコンテナ。Data VolumeコンテナがホストのDocker管理ディレクトリと共有し、Data Volumeコンテナと他のコンテナがディレクトリを共有することで、ディレクトリ共有の柔軟性を高めることができる。
ただしDocker Volumeコンテナはあくまで同一Dockerホスト内でのみ有効な手法。これを複数ホスト間で実現するにはプラグインを活用する。

## Docker Swarm

Docker Swarmは複数のDockerホストを束ねてクラスタ化するためのツールであり、コンテナオーケストレーションシステムの１つ。

- Compose: 複数のコンテナを使うDockerアプリケーションの管理（主にシングルホスト）
- Swarm: クラスタの構築や管理を担う（主にマルチホスト）
- Service: Swarm前提、クラスタ内のService（1イメージから作られた1つ以上のコンテナの集まり）を管理する
- Stack: Swarm前提、複数のServiceをまとめたアプリケーション全体の構成を定義し、管理する
- overlayネットワーク：Stackが属する仮想ネットワーク技術で、Dockerホストを超えたコンテナ間通信を可能にする。複数のStackが同じoverlayネットワークを共有することもできる。

dindのチュートリアルとしてregistry1,manager1,worker3の例を説明している。

### Swarm Tips

- DockerにはDocker in Docker(dind)という仕組みがあり、Dockerをコンテナで入れ子にできる。ローカルで手軽にDocker Swarmクラスタを試すにはこれを活用する。
- コンテナ群がSwarmクラスタ上のノードにどのように配置されているかを可視化するvisualizerというアプリケーションがDockerHub上に `dockersamples/visualizer` というイメージで公開されている。
- ホストからServiceにアクセスするには、Serviceクラスタ外からのトラフィックを目的のServiceに転送するためのプロキシサーバーを置く必要がある。
  - 例としてHAProxy `dockercloud/haproxy` を利用してSwarmクラスタ外からServiceにアクセスする方法を紹介している。

なんでHAProxyがnginxを発見するのにnginx側に環境変数が必要なんだ…？

# Kubernetes(k8s)

Kubernetes(k8s)はGoogle社主導で開発され2014年にOSSとして公開された、コンテナの運用を自動化するためのコンテナオーケストレーションシステム。
以下の仕組みを備えている。

- Dockerホストの管理
- サーバリソースの空き具合を考慮したコンテナ配置
- スケーリング
- ロードバランサー
- 死活監視

GKEはGCPにおけるk8sのマネージドサービスであり、k8sはGKEに依存しないOSSプロダクトである。
類似のサービスにAzureのAKSやAWSのEKSなどがある。

k8sはCompose/Stack/Swarmの機能を統合しつつ、より高度に管理できるもの、と考えて差し支えない。
サンプルイメージの一部はM1 Macでは動作しない。残念。

## k8sのリソース

k8sの構成要素

| リソース名 | 用途 | 備考 |
|:-----------|:-----|:-----|
| Cluster | 最低1個のMasterとなるNodeとその他のNode群によって構成される | 非マネージド環境ではマルチMasterで3台配置するのが一般的。k8sクラスタ、のように呼ぶk8sにおいて最も大きな単位。 |
| Node | k8sクラスタで実行するコンテナを配置するためのサーバ | GKEではGCEのこと。Masterノードには管理用Podだけがデプロイされる。 |
| Namespace | k8sクラスタ内で作る仮想的なクラスタ | 一般的なnamespaceと考え方は一緒 |
| Pod | コンテナ集合体の単位で、コンテナを実行する方法を定義する | 少なくとも１つのコンテナを持つ、一括りでデプロイするコンテナ集合の単位。1Pod内のコンテナは1Node内に配置される。Pod毎に仮想IPアドレスが割り振られ、Pod内ではlocalhostで通信が可能。 |
| ReplicaSet | 同じ仕様のPodを複数生成・管理する | ランダムなsuffixを付与されたPodレプリカ群を生成する。 |
| Deployment | ReplicaSetの世代管理をする | 設定はReplicaSetとほぼ変わらない。replicasの変更だけではリビジョンは更新されない。 |
| Service | Podの集合(主にReplicaSet)にアクセスするための経路やサービスディスカバリを定義する | Pod(ReplicaSet?)にラベルをつけ、そのラベルを目印にルーティングする。k8sクラスタ内ではService名.Namespace名.svc.localで名前解決できる。svc.localは省略可能で、同一Namespace内ならNamespace名も省略可能。 |
| ClusterIP Service | Serviceの一種。k8sクラスタ上の内部IPアドレスにServiceを公開する。 | デフォルトはこれ。外からはアクセス不能。 |
| NodePort Service | Serviceの一種。ClusterIPに加え、各Node上からServiceポートへ接続するためのグローバルなポートを開ける。 | 外からアクセス可能。L4層（トランスポート層）レベルで公開可能なため、TCP/UDPを扱える。 |
| LoadBalancer Service | Serviceの一種。ローカルk8sでは利用できない。各種プラットフォームのロードバランサーと連携するためのもの。 | GCPならCloud Load Balancing、AWSならElastic Load Balancing |
| ExternalName Service | Serviceの一種。selectorもportも持たない特殊なService。k8sクラスタ内から外部のホストを解決するためのエイリアスを提供する。 | DNS的な感じ？便利そう。 |
| Ingress | Serviceをk8sクラスタの外に公開する。L7層レベルの制御を可能とし、VirtualHostやパスベースでの高度なHTTPルーティングを実現する。 | 素のローカルk8s環境ではnginx-ingress-controllerで代替。GCPならCloud Load Balancingを、AWSならApplication Load Balancerを利用可能。 |
| ConfigMap | 設定情報を定義し、Podに供給する | コンテナ内のファイルを上書きできる？ |
| PersistentVolume | Podが利用するストレージのサイズや種類を定義する | GCPではGCEPersistentDisk |
| PersistentVolumeClaim | PersistentVolumeを動的に確保する | |
| StorageClass | PersistentVolumeが確保するストレージの種類を定義する | |
| StatefulSet | 同じ仕様で一意性のあるPodを複数生成・管理する。PersistentVolumeClaimをPod毎に自動生成する設定を定義可能。 | ReplicaSetと違い、末尾に連番の識別子でPodを作成する。podが安定した識別子を持つことで再作成時に同じデータを復元可能。 |
| Job | 常駐目的ではない複数のPodを作成し、正常終了することを保証する。Podは終了後も保持されるため、ログや結果を分析可能。reatartPolicyはNeverかOnFailureのみ。 | |
| CronJob | cron記法でスケジューリングして実行されるJob | |
| Secret | 認証情報などの機密データを定義する | base64エンコードした文字列って可逆では？ |
| Role | Namespace内で操作可能なk8sリソースのルールを定義する | |
| RoleBinding | Roleとk8sリソースを利用するユーザーを紐付ける | |
| ClusterRole | Cluster全体で操作可能なk8sリソースのルールを定義する | |
| ClusterRoleBinding | ClusterRoleとk8sリソースを利用するユーザーを紐付ける | |
| ServiceAccount | Podからk8sリソースを操作させる（k8s APIを利用する）際に利用するユーザー | |

## k8sに関連する概念

| 名前 | 用途 | 備考 |
|:-----------|:-----|:-----|
| マニフェストファイル | k8sの各種リソースを定義するyamlファイル |  |
| サービスディスカバリ | APIの接続先が動的に変わる場合に、API側でそれを意識せずアクセスできるようにする仕組み |  |
| Kubernetes API | k8sのリソースの作成・更新・削除はk8sクラスタにデプロイされているAPIによって行われる。マニフェストファイルでバージョンを指定している。 | `kubectl api-versions`で確認可能 |
| 認証ユーザー | クラスタ外からk8sを操作するためのユーザー。様々な方法で認証される。 |  |
| グループ | 認証ユーザーをグルーピングする概念 |  |
| RBAC(Role-Based Access Control) | 権限を定義したロールと、認証ユーザー/グループ/ServiceAccountの紐付けの2要素で成立する。 | 考え方はIAMと同じっぽい。 |
| Helm | k8s chartsを管理するための仕組み。 | k8sクラスタを複数環境に適用する際、環境差異を定義・管理してデプロイできる仕組み |
| k8s charts | 設定済みのk8sリソースのパッケージ | chartをベースにマニフェストファイルを構築する|
| lifecycle.preStep | コンテナが終了する前のフック処理を定義可能 | 安全なPod終了のため |
| Pod AntiAffinity | Pod間の親和性を考慮したPodの配置ルールを定義する。 複数Podが同じNodeに配置されてNodeが単一障害点にならないようにする、CPUを多く利用するPodを隔離する、など。 | deployment.spec.affinity.podAntiAffinity |
| HPA(Horizonal Pod Autoscaler) | Podのシステムリソース使用率に応じてPodをオートスケールさせるk8sリソース。 | 基本的にはCluster Autoscalerと併用する。 |
| Cluster Autoscaler | ノードをオートスケールさせるツール。 | GKEではマネージド機能の一部。 |

# ロギング

Dockerではコンテナの標準出力をログとして出力される機能が備えられている。
logging driverはDockerコンテナが出力するログの扱いの挙動を制御する役割を担っている。
Dockerコンテナのロギングの挙動を制御するための `-log-opt` オプションがある。
簡易にログ閲覧するツールとしては、ラベル指定でログをtailできるsternがある。

- json-file: json形式でログに出力される
- syslog: syslogで管理する
- journald: systemdのjournaldで管理する
- awslogs: AWS CloudWatch Logsにログを送信する
- gcplogs: GCP Cloud Loggingにログを送信する
- fluentd: fluentdでログを管理する

## GKEでのロギング

GKEのk8sクラスタノードにはfluentd-gcpのDaemonSetリソースが配置されている。
これにより、jsonログを標準出力するだけでStackdriverでログを閲覧できる。

