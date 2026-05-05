# 運用設計

## 環境

- local
- staging
- production

## local

Docker Compose、PostgreSQL、Mailpit。必要に応じてMinIO/LocalStack。

## staging

ECS Fargate、RDS、S3、SES、Stripe test mode。

## production

ECS Fargate、RDS、S3、CloudFront、SES production、Stripe live mode。

## CI/CD

GitHub Actions。

- `staging` にマージ → staging自動デプロイ
- `main` にマージ → production自動デプロイ
- MVPではproduction承認フローなし

## OpenTofu

- アプリデプロイとは分離。
- `infra/**` PR時に fmt / validate / plan。
- `tofu apply` は専用workflowから手動実行。

## Queue / Scheduler

30分ごとにECS RunTask。

```bash
php artisan schedule:run
php artisan queue:work database --stop-when-empty --tries=3 --timeout=90
```

## メール

Amazon SES + Laravel Mail/Notification。

## 通知

参加者: 参加確定、前日リマインド、中止。

管理者: 公開、自動公開、中止。

## Runbooks

### Stripe Webhook失敗

1. `stripe_webhook_events` を確認
2. Stripe Dashboard確認
3. 署名検証エラーか処理エラーか切り分け
4. 必要なら再処理

### イベント中止

1. `status=cancelled`
2. cancellation_reason設定
3. 有効申し込みユーザーへ中止メール
4. 有料参加者がいる場合、Stripe側での返金対応を案内
5. 本システムでは返金状態を追跡しない

## ログイン後導線

- 通常ログイン後は `/dashboard` へ遷移する
- イベント申し込み途中でログインした場合は元の申し込み画面へ戻す
- 管理画面からログイン要求された場合は元の管理画面へ戻す

## メール文面

メール文面は `19_email_guidelines.md` を参照する。

件名形式は以下とする。

`[Tomos] {通知内容} - {イベント名}`
