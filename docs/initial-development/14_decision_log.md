# ADR一覧

## ADR-001: PHP / Laravel 採用
Laravel Wayを優先し、Breeze、Blade、Alpine.js、Tailwind CSS、Pest、Pintを採用する。

## ADR-002: PostgreSQL / RDS 採用
DBはPostgreSQL。ホスティングはRDS PostgreSQL。MVPではSingle-AZ。Auroraは採用しない。

## ADR-003: Stripe Connect Accounts v2 API
決済はStripe Connect Accounts v2 API。連携はコミュニティ単位。Account Links v2でオンボーディング。

## ADR-004: プラットフォーム手数料0円
MVPおよび将来方針としてプラットフォーム手数料を徴収しない。

## ADR-005: 返金機能なし
MVPでは返金機能を作らない。返金はStripe側で管理者が対応。本システム上の売上と実売上のズレを許容する。

## ADR-006: 領収書等を発行しない
サービス側では領収書、請求書、インボイスを発行しない。

## ADR-007: 有料枠キャンセル待ちなし
有料枠キャンセル待ちはMVP対象外。無料枠のみ対応。

## ADR-008: 申し込み状態と実参加状態を分離
`status` と `attendance_status` を分ける。

## ADR-009: 重複申し込みは部分ユニークインデックス
`event_slot_id, user_id where is_active=true` で制約。

## ADR-010: イベント状態
`draft / published / cancelled / archived`。物理削除なし。

## ADR-011: URL設計
`communities` に統一。イベント詳細canonicalは `/events/{event_id}`。

## ADR-012: QRチェックイン
QR URLはHMAC付き。印刷利用を想定。有効期限なし。

## ADR-013: コミュニティ権限
admin 1種類のみ。ownerなし。承認不要で即追加。

## ADR-014: イベント個別管理者
対象イベントに対して全権限。

## ADR-015: 通知
MVPはメールのみ。参加者重要通知は必ず送信。管理者通知はイベント状態変更のみ。

## ADR-016: ECS Fargate
アプリ実行基盤はECS Fargate。App Runner/Lightsailは採用しない。

## ADR-017: OpenTofu
IaCはOpenTofu。applyは手動workflow。

## ADR-018: GitHub Actions
staging/mainマージで自動デプロイ。production承認フローなし。

## ADR-019: Queue/Scheduler
常駐Workerなし。30分ごとのRunTaskでdatabase queueをdrain。

## ADR-020: テスト
Pest Feature Test中心。E2E/VRTはPost-MVP。

## ADR-021: データ保持
365日保持方針。自動削除/匿名化はPost-MVP。

---

## ADR-023: UIトーン・カラーパレット

### Status

Accepted

### Decision

MVPでは、ティール基調 + アンバー差し色を採用する。

Primary:

- Tailwind: `teal-700`
- Hex: `#0F766E`

Accent:

- Tailwind: `amber-500`
- Hex: `#F59E0B`

Base:

- Tailwind: `slate-50`
- Hex: `#F8FAFC`

Text:

- Tailwind: `slate-900`
- Hex: `#0F172A`

ダークモードはMVP対象外とし、ライトモード固定で実装する。

### Reason

- 決済・個人情報を扱うサービスとして信頼感を出したい
- ITコミュニティの安全な場づくりと相性が良い
- 青より柔らかく、緑より自然・医療っぽくなりすぎない
- アンバーを差し色にすることで、イベント告知や人が集まる温度感を出せる
- ダークモードをMVPに含めると確認コスト・実装コストが増えるため

### Future Consideration

将来的にダークモードを追加する場合は、共通Blade Componentから段階的に対応する。

### MVP対象外

- ダークモード
- 本格的なデザインシステム
- 複雑なテーマ切り替え
- VRT

---

## ADR-024: 認証細部

### Status

Accepted

### Decision

user slug は登録時必須とする。

display_name は必須、重複OKとする。

email変更時は再確認必須とする。

Google/GitHubログインはSprint 2で実装する。

Social loginでは、同一メールアドレスなら既存ユーザーに紐付ける。

ただし、provider側メールアドレスが未確認の場合は自動紐付けしない。

---

## ADR-025: Slug制限

### Status

Accepted

### Decision

user slug / community slug には予約語を設定する。

さらに、主要な直接的に卑猥・攻撃的な語をブロックする。

MVPでは完全なNGワード辞書や管理者審査機能は作らない。

予約語には以下を含める。

- www
- mail
- ftp
- smtp
- api
- cdn
- static
- root
- webmaster
- info

---

## ADR-026: Markdown / HTML

### Status

Accepted

### Decision

Markdown入力を許可する。

生HTMLは原則禁止する。

ただし、以下の安全なHTMLタグのみ許可する。

- br
- details
- summary
- kbd
- mark
- sup
- sub

Markdown本文への画像アップロードはMVPでは行わない。

外部URLによる画像埋め込みと外部リンクは許可する。

変換後HTMLは必ずサニタイズする。

---

## ADR-027: メール文体

### Status

Accepted

### Decision

メール文体は「です・ます」とする。

件名形式は `[サービス名] イベント名 - 通知内容` とする。

参加者向けメールにはコミュニティ問い合わせ先 `contact_email` を載せる。

有料イベントメールにはキャンセルポリシーと特定商取引法など必要表示URLを載せる。

---

## ADR-028: 個人情報請求対応

### Status

Accepted

### Decision

MVPでは、個人情報の開示・訂正・削除・利用停止請求は問い合わせベースで対応する。

ユーザー向けの自動エクスポート機能・自動削除機能・自動匿名化機能はMVP対象外とする。

個人情報の所在一覧と運用手順を設計書に明記する。

---

## ADR-029: UI用語

### Status

Accepted

### Decision

ユーザー向けUIでは、主要用語を以下に寄せる。

- イベント
- コミュニティ
- 参加枠
- 申し込み
- チケット
- コミュニティ運営者

「管理者」は内部設計・権限名としては使ってよいが、ユーザー向けUIでは原則「コミュニティ運営者」を使う。

---

## ADR-030: 有料枠の抽選

### Status

Accepted

### Decision

MVPでは有料枠は原則先着順のみとする。

有料枠では抽選制を扱わない。

有料枠の支払い期限は30分とする。

### Reason

当選後決済、支払い期限切れ、次点繰り上げなどの運用が複雑になるため。

---

## ADR-031: メール文面

### Status

Accepted

### Decision

メール文体は「です・ます」とする。

件名形式は以下とする。

`[サービス名] {通知内容} - {イベント名}`

参加者向けメールにはコミュニティ問い合わせ先 `contact_email` を載せる。

有料イベントメールにはキャンセルポリシーと特定商取引法など必要表示URLを載せる。

---

## ADR-032: ログイン後導線

### Status

Accepted

### Decision

通常ログイン後は `/dashboard` へ遷移する。

イベント申し込み途中でログインした場合は元の申し込み画面へ戻す。

管理画面からログイン要求された場合は元の管理画面へ戻す。


---

## ADR-033: Service Name and Branding

### Status

Accepted

### Decision

サービス名は `Tomos` とする。

ドメインは `tomos.dev` とする。

Tomos は「灯す」を由来とし、コミュニティの場や知識の循環に火を灯す、という思想を表す。

### Brand Color

ブランドカラーは Tomos に合わせて以下を採用する。

- Primary: `amber-600` / `#D97706`
- Accent: `orange-500` / `#F97316`
- Background: `stone-50` / `#FAFAF9`
- Text: `slate-900` / `#0F172A`

### Reason

- 「灯す」という名前と暖色系の世界観が自然に接続する
- 冷たすぎず、安心感とあたたかさを両立できる
- コミュニティの場づくりという思想と相性が良い


---

## ADR-034: Development Workflow

### Status

Accepted

### Decision

Tomosの開発は、GitHub Issues前提ではなく対話式で進める。

Issue TemplateはMVPでは作成しない。

Sprint 1の範囲はLaravel初期化 + Basic Authまでとする。

Basic Authはメールアドレス + パスワードログインを指す。

Google/GitHubログインはSprint 2で扱う。

最初のPRはLaravelプロジェクト作成のみとし、Breeze、DB接続、Docker Compose、CIは次以降のPRに分ける。

### Reason

初期構築で詰まった際の切り分けをしやすくするため。

対話式で柔軟に進めつつ、PR単位は小さく保つため。
