# Docker/Kubernetes 実践コンテナ開発入門

Dockerの基礎の解説から、本番環境での利用の有用性について説いている。

## 近年

Microservicesアーキテクチャが登場し、Dockerを利用した開発との親和性も高い。
アプリ開発でも例えばCI高速化にDockerを利用するなどで利用される。
サーバーサイドエンジニアとインフラエンジニアの垣根がなくなってきている。（感じていた時代がない…垣根がなくなった後なのかも）

## 各クラウドプラットフォームにおけるコンテナ運用環境

- GCP
  - Google Kubernetes Engine(GKE)
- AWS
  - Amazon Elastic Container Service(ACS)
- Azure
  - Azure Container Service

データストアなどDockerで運用する難易度が高いものもある。

## Docker基礎

- Dockerイメージ
  - Dockerコンテナを構成するファイルシステムや、実行するアプリケーションの設定をまとめたもので、コンテナを作成するために利用されるテンプレートとなるもの
- Dockerコンテナ
  - Dockerイメージを元に作成され、具現化されたファイルシステムとアプリケーションが実行されている状態

感覚としては、イメージはClass定義、コンテナはインスタンス、という風に読み取れた。

ポートフォワーディング機能があり、Docker内部とDocker実行環境のポートをフォワーディングしてコンテナを実行できる。
