# 画面・URL設計

## URL方針

- `/community/...` は使わず `/communities/...` に統一する。
- イベント詳細は `/events/{event_id}` と `/communities/{community_slug}/events/{event_id}` の両方で表示する。
- canonical URLは `/events/{event_id}`。
- community context URLでslug不一致なら404。

## 公開画面

| 画面 | URL |
|---|---|
| トップ | `/` |
| イベント一覧 | `/events` |
| イベント詳細 | `/events/{event_id}` |
| イベント詳細 community context | `/communities/{community_slug}/events/{event_id}` |
| コミュニティ詳細 | `/communities/{community_slug}` |
| ユーザープロフィール | `/users/{user_slug}` |

## 認証

| 画面 | URL |
|---|---|
| 登録 | `/register` |
| メール確認案内 | `/email/verify` |
| メール確認実行 | `/email/verify/{id}/{hash}` |
| ログイン | `/login` |
| ログアウト | `/logout` |
| パスワードリセット申請 | `/forgot-password` |
| パスワードリセット | `/reset-password/{token}` |
| Google login | `/auth/google/redirect`, `/auth/google/callback` |
| GitHub login | `/auth/github/redirect`, `/auth/github/callback` |

## 参加者画面

| 画面 | URL |
|---|---|
| マイページ | `/dashboard` |
| プロフィール編集 | `/settings/profile` |
| アカウント設定 | `/settings/account` |
| 参加予定 | `/me/events/upcoming` |
| 参加履歴 | `/me/events/history` |
| チケット | `/events/{event_id}/ticket` |
| 申し込み詳細 | `/me/applications/{application_id}` |
| 退会確認 | `/settings/delete-account` |

## 申し込み

| 画面 | URL |
|---|---|
| 枠選択 | `/events/{event_id}/apply` |
| 招待コード入力 | `/events/{event_id}/apply/invite` |
| 事前アンケート回答 | `/events/{event_id}/apply/questionnaire` |
| 申し込み確認 | `/events/{event_id}/apply/confirm` |
| 申し込み完了 | `/applications/{application_id}/completed` |
| Checkout開始 | `/applications/{application_id}/checkout` |
| 決済成功 | `/applications/{application_id}/payment/success` |
| 決済キャンセル | `/applications/{application_id}/payment/cancel` |
| キャンセル確認 | `/applications/{application_id}/cancel` |

## 管理画面

| 画面 | URL |
|---|---|
| 管理コミュニティ一覧 | `/admin/communities` |
| コミュニティ作成 | `/admin/communities/create` |
| コミュニティ管理トップ | `/admin/communities/{community_id}` |
| コミュニティ編集 | `/admin/communities/{community_id}/edit` |
| CoC・ポリシー | `/admin/communities/{community_id}/policies` |
| 外部リンク | `/admin/communities/{community_id}/external-links` |
| 管理者一覧 | `/admin/communities/{community_id}/admins` |
| Stripe | `/admin/communities/{community_id}/stripe` |
| イベント一覧 | `/admin/communities/{community_id}/events` |
| イベント作成 | `/admin/communities/{community_id}/events/create` |
| イベント管理トップ | `/admin/events/{event_id}` |
| イベント編集 | `/admin/events/{event_id}/edit` |
| 公開設定 | `/admin/events/{event_id}/publishing` |
| 中止 | `/admin/events/{event_id}/cancel` |
| draft戻し | `/admin/events/{event_id}/back-to-draft` |
| archive | `/admin/events/{event_id}/archive` |
| 会場・視聴URL | `/admin/events/{event_id}/venue` |
| イベント個別管理者 | `/admin/events/{event_id}/admins` |
| 参加枠一覧 | `/admin/events/{event_id}/slots` |
| アンケート一覧 | `/admin/events/{event_id}/questionnaires` |
| 参加者一覧 | `/admin/events/{event_id}/applications` |
| チェックイン | `/admin/events/{event_id}/checkins` |
| QR読み取り案内 | `/admin/events/{event_id}/checkins/qr` |

## チェックイン

| 画面 | URL |
|---|---|
| QRチェックイン | `/checkins/{event_id}?application={application_id}&user={user_id}&hmac={hmac}` |
| 結果 | `/checkins/{event_id}/result` |

## Webhook / Health

| 用途 | URL |
|---|---|
| Stripe Webhook | `/webhooks/stripe` |
| Health Check | `/health` |
