# アーキテクチャ設計

## 技術スタック

- Backend: PHP / Laravel
- Auth: Laravel Breeze
- Social Login: Laravel Socialite
- Frontend: Blade + Alpine.js
- CSS: Tailwind CSS
- DB: PostgreSQL / Amazon RDS for PostgreSQL
- Payment: Stripe Connect Accounts v2 API
- Test: Pest
- Formatter: Laravel Pint
- Infra: AWS
- Runtime: ECS Fargate
- Storage: S3 + CloudFront
- Mail: SES
- IaC: OpenTofu
- CI/CD: GitHub Actions
- Queue: Laravel database queue
- Scheduler: EventBridge Scheduler

## Laravel Way

MVPではLaravel標準機能に寄せる。

採用: Eloquent, Form Request, Policy/Gate, Job/Queue, Notification/Mail, Migration/Factory/Seeder。

採用しない: 過剰なDDD、常設Repository層、CQRS、Event Sourcing、GraphQL、初期フロント分離。

## AWS構成

- ECS Fargate web service
- ECR
- ALB
- RDS PostgreSQL Single-AZ initially
- S3
- CloudFront
- SES
- EventBridge Scheduler
- CloudWatch Logs / Alarms
- Secrets Manager or SSM Parameter Store

## Queue / Scheduler

MVPでは常駐Queue Workerを起動しない。

30分ごとにEventBridge SchedulerからECS RunTaskを実行。

```bash
php artisan schedule:run
php artisan queue:work database --stop-when-empty --tries=3 --timeout=90
```

最大30分程度の遅延を許容。

## Stripe

- Accounts v2 API
- Account Links v2
- コミュニティ単位
- application feeなし
- 返金機能なし

## 画像

- S3に保存
- CloudFrontで配信
- DBにはpathのみ保存
- 対象: user avatar, community OGP, event OGP

## Markdown

対象: ユーザーbio、コミュニティ紹介、キャンセルポリシー、イベント概要。表示時はサニタイズする。



## UI / Design

MVPでは、Laravel Breeze + Blade + Tailwind CSSをベースにする。

カラーパレットは Tomos のブランドに合わせてアンバー基調 + オレンジ差し色。

- Primary: `amber-600` / `#D97706`
- Accent: `orange-500` / `#F97316`
- Background: `stone-50` / `#FAFAF9`
- Text: `slate-900` / `#0F172A`

ダークモードはMVP対象外とし、ライトモード固定で実装する。

ただし、将来的な追加を妨げないよう、色指定は共通Blade Componentに寄せる。

詳細は `16_ui_guidelines.md` を参照する。
