
# 開発進行計画

## 方針

Tomosの開発は、GitHub Issues前提ではなく、対話式で進める。

Issue TemplateはMVPでは作成しない。

作業単位は小さく分割し、都度内容を確認しながら進める。

## Sprint 1

Sprint 1 の範囲は「Laravel初期化 + Basic Auth」まで。

ここでいうBasic Authは、メールアドレス + パスワードログインを指す。

Google/GitHubログインはSprint 2で扱う。

## PR分割方針

最初のPRはLaravelプロジェクト作成のみとする。

Breeze、DB接続、Docker Compose、CIなどは次以降のPRで扱う。

## PR-001: Laravel Project Bootstrap

### Scope

- Laravelプロジェクト作成
- Laravelをリポジトリルートに配置
- PHP 8.4前提
- Laravel最新安定版
- `.gitignore`
- `.env.example`
- `README.md` 初期化
- `docs/` 配置
- `composer install` が通ること
- `php artisan --version` が通ること

### Out of Scope

- Laravel Breeze
- DB接続設定
- Docker Compose
- CI
- User拡張
- メール確認
- Social login
- コミュニティ作成
- イベント作成

## PR-002: Local Development Environment

### Scope

- Docker Compose
- PostgreSQL
- Mailpit
- PHP app container
- local起動手順

### Out of Scope

- Breeze
- 認証画面
- CI
- Social login

## PR-003: Breeze & Basic Auth Foundation

### Scope

- Laravel Breeze導入
- Tailwind CSS
- 認証画面
- メールアドレス + パスワード登録
- ログイン
- ログアウト
- パスワードリセット

### Out of Scope

- Google/GitHubログイン
- user slug
- display_name拡張
- メール未確認ログイン拒否の独自調整

## PR-004: User Registration Requirements

### Scope

- user slug
- display_name
- slug validation
- reserved slugs
- blocked slug words
- メール確認必須
- メール未確認ログイン拒否
- ログイン後リダイレクト

### Out of Scope

- Google/GitHubログイン
- コミュニティ
- イベント

## PR-005: CI Foundation

### Scope

- GitHub Actions
- Laravel Pint
- Pest
- npm build
- Docker build確認

### Out of Scope

- staging deploy
- production deploy
- OpenTofu apply

## PR-006: Social Login

### Scope

- Laravel Socialite
- social_accounts
- Googleログイン
- GitHubログイン
- 同一メールアドレスの既存ユーザー紐付け

### Out of Scope

- コミュニティ
- イベント
- Stripe

## 以降の大まかな順序

1. Community Foundation
2. Event Foundation
3. Event Slots
4. Free Application
5. Questionnaire
6. Paid Application / Stripe
7. Check-in
8. Notifications
9. Audit Logs
10. CSV
11. Staging Deploy
12. Production Deploy
