# セキュリティ要件

## 認証

- Laravel Breeze
- メール確認必須
- メール未確認はログイン不可
- Google/GitHubログイン
- XログインはPost-MVP

## 認可

- コミュニティ管理: `community_admins`
- イベント管理: コミュニティ管理者 or `event_admins`

## 参加者限定情報

以下は `status=confirmed` かつ `is_active=true` の参加者だけに表示。

- online_url
- participant_venue_information
- ticket QR

## QRチェックイン

QR URL: `/checkins/{event_id}?application={application_id}&user={user_id}&hmac={hmac}`

HMAC対象: `event_id:application_id:user_id`

チェック:

- 管理者ログイン
- イベント管理権限
- event_id/application_id/user_id整合性
- HMAC検証
- 申し込みが有効な参加確定状態

## Stripe

- カード番号は保持しない
- Webhook署名検証必須
- stripe_event_idで冪等性担保
- application feeなし
- 返金機能なし

## 個人情報

ログには個人情報本文・アンケート回答本文を原則保存しない。

## Markdown

表示時にサニタイズする。

## 監査ログ

重要操作のみ保存。対象例: 管理者追加/削除、Stripe連携開始、イベント公開/中止、個別管理者追加/削除、有料枠作成/変更、管理者キャンセル、チェックイン、no-show、CSVダウンロード、決済Webhook処理。

## 個人情報請求対応

MVPでは、個人情報の開示・訂正・削除・利用停止請求は問い合わせベースで対応する。

ユーザー向けの自動エクスポート機能・自動削除機能はMVP対象外とする。

詳細は `17_privacy_and_data_requests.md` を参照する。

## Markdown Security

Markdownはサーバー側でHTMLに変換する。

変換後HTMLは必ずサニタイズする。

生HTMLは原則禁止。

許可リストに含まれる安全なHTMLタグのみ残す。

外部リンクには以下を付与する。

- `target="_blank"`
- `rel="noopener noreferrer"`

`iframe`, `script`, `style`, `form`, `input`, `svg` などはMVPでは禁止する。
