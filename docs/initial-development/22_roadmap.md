
# Roadmap

## 方針

Tomosは、まずMVPを小さく完成させ、その後に検索・分析・運営支援機能を段階的に追加する。

MVP開発中は、Post-MVP機能を先取りして実装しない。

## Phase 0: 開発基盤

目的:

- Laravelアプリケーションとして安全に開発を始められる状態を作る

含むもの:

- Laravel初期化
- Docker Compose
- PostgreSQL
- Mailpit
- Laravel Breeze
- Basic Auth
- Pest / Pint
- GitHub Actions CI
- docs整備

## Phase 1: MVP

目的:

- ITエンジニア向け勉強会申し込みプラットフォームとして、最低限実運用できる状態を作る

含むもの:

- ユーザー登録・ログイン
- Google/GitHubログイン
- ユーザープロフィール
- コミュニティ作成
- コミュニティ運営者追加
- コミュニティ公開ページ
- イベント作成
- イベント公開・中止
- イベント一覧
- 参加枠
- 無料申し込み
- 無料抽選
- 無料キャンセル待ち
- 有料先着申し込み
- Stripe Connect
- Stripe Checkout
- 事前アンケート
- チェックイン
- QRチェックイン
- メール通知
- 監査ログ
- CSVダウンロード
- staging / production deploy

## Phase 2: Post-MVP

目的:

- MVPの運用で見えた課題を解消し、利便性を高める

候補:

- 検索機能
- タグ機能
- OpenSearch連携
- 事後アンケート
- 参加状況分析
- 通知設定
- 返金連携
- データ削除・匿名化ジョブ
- Webhook payloadマスキング
- コミュニティ運営支援機能
- OGP画像自動生成
- ダークモード
- E2E / VRT

## Phase 3: Growth

目的:

- コミュニティ活動の循環を広げる

候補:

- 外部API
- Webhook
- 参加者向けレコメンド
- コミュニティ横断検索
- イベントレポート
- 運営ノウハウ共有
- スポンサー/協賛管理
- 外部カレンダー連携

## MVPでやらないこと

- 問い合わせ管理
- ブラックリスト
- システム管理画面
- 有料枠キャンセル待ち
- 有料枠抽選
- 返金機能
- 領収書・請求書・インボイス発行
- 検索・タグ
- OpenSearch
- E2E/VRT
- 自動データ削除
- ダークモード
