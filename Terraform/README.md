# Terraform

IaC（Infrastracture as Code）を実現する構成管理ツール。

GCPやAWSをまたいで管理することが可能。

## Provider

ざっくりサービスプロバイダーのこと。

- IaaS（AWS,GCP,Azure,OpenStack)
- PaaS（Heroku）
- SaaS（TerraformCloud,DNSimple,Cloudflare）

## Module

よくわからない…名前と雰囲気では複数のTerraform設定から呼び出せるようにした共通設定のような印象を受ける。

> 関連するリソースを管理する、Terraform設定の自己完結型コレクション。
> 
> 他のTerraform設定からモジュールを呼び出すことが可能。
> 呼び出し元は入力変数を設定することができ、出力値を受け取る。
