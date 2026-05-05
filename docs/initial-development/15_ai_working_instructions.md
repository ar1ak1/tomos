# AI開発指示書

## 最優先ルール

1. 仕様にない機能を勝手に追加しない。
2. MVP対象外機能を実装しない。
3. 認証・認可・決済・個人情報まわりは簡略化しない。
4. Laravel Wayを優先する。
5. 過剰なDDD、Repository層、CQRS、Event Sourcingを導入しない。
6. Controllerを太らせず、Action/FormRequest/Policyに分ける。
7. 重要な業務ルールにはFeature TestまたはUnit Testを書く。
8. PostgreSQL制約で守るべき仕様はDB制約も利用する。

## 実装前に読む順序

1. `docs/15_ai_working_instructions.md`
2. `docs/00_project_overview.md`
3. `docs/01_requirements.md`
4. `docs/02_domain_model.md`
5. `docs/06_data_model.md`
6. `docs/07_architecture.md`
7. `docs/09_security.md`
8. `docs/12_testing_strategy.md`
9. `docs/14_decision_log.md`

## 禁止事項

- 返金機能を作る
- プラットフォーム手数料を導入する
- 有料枠キャンセル待ちを作る
- ブラックリストを作る
- 検索/タグ/OpenSearchを作る
- E2E/VRTをMVPに混ぜる
- システム管理画面を作る
- Stripe Webhook署名検証を省略する
- クレジットカード番号を保存する
- 個人情報・アンケート本文をログに出す

## 作業報告形式

```md
## Summary
## Changed Files
## Tests
## Remaining Issues
## Notes
```


## Privacy実装ルール

個人情報の自動エクスポート・自動完全削除はMVPでは実装しない。

個人情報請求は問い合わせベースの運用対応とする。

個人情報の所在を増やす場合は `docs/17_privacy_and_data_requests.md` を更新する。

## Sprint実装ルール

Sprint 1ではGoogle/GitHubログインを実装しない。

Social loginはSprint 2で実装する。

## Email実装ルール

メール文面は `docs/19_email_guidelines.md` に従う。

件名形式は `[サービス名] {通知内容} - {イベント名}` とする。

## 用語実装ルール

ユーザー向けUIでは原則として「管理者」ではなく「コミュニティ運営者」を使う。

## 有料枠実装ルール

MVPでは有料枠の抽選制を実装しない。

有料枠は先着順のみ。

有料枠の支払い期限は30分。

## CSV / Seed実装ルール

CSVとseedデータは `docs/20_csv_and_seed.md` に従う。


## Branding実装ルール

サービス名は `Tomos` とする。

ドメインは `tomos.dev` とする。

ブランドカラーは以下を採用する。

- Primary: `amber-600`
- Accent: `orange-500`
- Background: `stone-50`

詳細は `docs/21_branding.md` を参照する。


## Definition of Done実装ルール

実装タスクは `docs/23_definition_of_done.md` を満たすこと。

作業完了時は以下を報告する。

- Summary
- Changed Files
- Tests
- Docs Updated
- Remaining Issues

## 開発進行ルール

GitHub Issues前提ではなく、対話式で進める。

Issue Templateは作成しない。

最初のPRはLaravelプロジェクト作成のみとする。

詳細は `docs/24_development_plan.md` を参照する。
