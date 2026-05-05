
# Sprint計画

## 開発進行方針

GitHub Issues前提ではなく、都度対話式で進める。

Issue TemplateはMVPでは作成しない。

最初のPRはLaravelプロジェクト作成のみとし、BreezeやDB接続は次以降に分ける。

## 方針

コミュニティ作成やイベント作成に入る前に、ユーザー作成・ログイン・認証基盤を先に固める。

## Sprint 1: Project Bootstrap & Basic Auth

### 目的

Laravelプロジェクトの土台と、メール + パスワード認証を完成させる。

### Scope

- Laravel初期化
- Laravelをリポジトリルートに配置
- PHP 8.4
- Node.js 最新LTS
- PostgreSQL 最新安定メジャー
- Docker Compose
- PostgreSQL接続
- Laravel Breeze導入
- Tailwind CSS
- Pest導入
- Laravel Pint導入
- user slug
- display_name
- メール確認必須
- メール未確認ユーザーのログイン拒否
- GitHub Actions CI
- docs配置

### Out of Scope

- Googleログイン
- GitHubログイン
- コミュニティ作成
- イベント作成
- Stripe
- 申し込み
- チェックイン

## Sprint 2: Social Login

### 目的

Google/GitHubログインを導入し、既存ユーザーとの紐付けを行う。

### Scope

- Laravel Socialite導入
- social_accounts テーブル
- Googleログイン
- GitHubログイン
- 同一メールアドレスの既存ユーザー紐付け
- provider側メール確認状態の扱い
- Social login Feature Test

### 紐付け方針

Google/GitHub login時、provider email が既存 `users.email` と一致する場合、既存ユーザーに `social_accounts` を追加する。

ただし、provider側メールアドレスが未確認の場合は、安全側に倒して自動紐付けしない。

## Sprint 3: Community Foundation

### 目的

コミュニティ作成・公開・管理者管理を実装する。

### Scope

- communities
- community_admins
- community_external_links
- community OGP画像
- CoC URL
- contact_email
- cancellation_policy
- commerce_disclosure_url
- Markdown表示
- コミュニティ管理者追加
- コミュニティ削除ブロック

## Sprint 4: Event Foundation

### 目的

イベント作成・公開・中止・一覧を実装する。

### Scope

- events
- event_admins
- event status
- event OGP画像
- venue_type
- Markdown概要
- 自動公開予約
- URL設計
- イベント一覧

## Sprint 5以降

- 参加枠
- 申し込み
- Stripe
- 事前アンケート
- チェックイン
- 通知
- 監査ログ
