# 非機能要件

## 優先順位

1. コスト
2. 拡張性
3. 速度
4. セキュリティ
5. 安定性

## コスト方針

個人運営を想定し、固定費を抑える。初期構成はECS Fargate web 1 task、RDS PostgreSQL Single-AZ、S3 + CloudFront、SES、EventBridge Scheduler 30分ごと。Aurora / Aurora Serverless v2 はMVPでは採用しない。

## 可用性

MVPではMulti-AZ必須にしない。本格運用前にRDS Multi-AZや常駐Worker、SQSを再検討する。

## 性能

検索はMVP対象外。イベント一覧はDB indexで対応。OpenSearchはPost-MVP。

## データ保持

主要データ保持期間は365日。自動削除・匿名化はPost-MVP。

## 監視

サービス運営者向けに以下を監視する。

- Stripe Webhook失敗
- メール送信失敗
- Job/Queue失敗
- 5xx
- DB接続エラー
- S3アップロード失敗

コミュニティ管理者へはシステム異常通知を送らない。
