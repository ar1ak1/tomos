# ITエンジニア向け勉強会申し込みプラットフォーム ドキュメント

AI/CodexとWebシステム開発を進めるための初期ドキュメント一式です。

## 収録内容

- `00_project_overview.md`
- `01_requirements.md`
- `02_domain_model.md`
- `03_user_stories.md`
- `04_screen_and_flow.md`
- `05_api_design.md`
- `06_data_model.md`
- `07_architecture.md`
- `08_non_functional_requirements.md`
- `09_security.md`
- `10_operations.md`
- `11_development_rules.md`
- `12_testing_strategy.md`
- `13_release_plan.md`
- `14_decision_log.md`
- `15_ai_working_instructions.md`
- `16_ui_guidelines.md`
- `17_privacy_and_data_requests.md`
- `18_sprint_plan.md`
- `19_email_guidelines.md`
- `20_csv_and_seed.md`
- `21_branding.md`
- `22_roadmap.md`
- `23_definition_of_done.md`
- `24_development_plan.md`

## 確定スタック

PHP/Laravel, Breeze, Socialite, Blade, Alpine.js, Tailwind CSS, PostgreSQL, RDS, Stripe Connect Accounts v2 API, Pest, Pint, ECS Fargate, S3, CloudFront, SES, EventBridge Scheduler, OpenTofu, GitHub Actions。

## 重要なMVP方針

- プラットフォーム手数料なし
- 返金機能なし
- 有料枠キャンセル待ちなし
- 領収書・請求書・インボイス発行なし
- 検索・タグはPost-MVP
- E2E/VRTはPost-MVP
- 自動削除・匿名化はPost-MVP

## 追加MVP方針

- サービス名は `Tomos`
- ドメインは `tomos.dev`
- UI表記は「コミュニティ運営者」を優先
- 有料枠は先着順のみ
- 有料枠の支払い期限は30分
- メール件名は `[Tomos] {通知内容} - {イベント名}`
- ブランドカラーはアンバー基調 + オレンジ差し色

## 開発進行

- 開発進行は対話式
- GitHub Issues前提ではない
- Issue TemplateはMVPでは作成しない
- 最初のPRはLaravelプロジェクト作成のみ
- Breeze/DB/CIは次PR以降
