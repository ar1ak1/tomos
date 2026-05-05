# 要件定義

## 認証・ユーザー

- メールアドレス確認が完了するまで会員登録は完了しない。
- メール未確認ユーザーはログインできない。
- ログイン方式はメール+パスワード、Google、GitHub。
- XログインはPost-MVP。
- ユーザー退会はSoft Delete。
- 退会済みユーザーは公開画面・参加履歴画面で「退会済ユーザ」と表示する。
- 退会済みユーザーslugは再利用不可。
- 自分だけが管理者であるコミュニティが存在する場合、ユーザー退会をブロックする。

## コミュニティ

- コミュニティ管理権限は `admin` 1種類のみ。ownerは設けない。
- コミュニティ作成者はadminになる。
- adminは既存ユーザーを承認不要で即時adminに追加できる。
- 管理者一覧は公開表示する。
- CoC URLと問い合わせ先メールアドレスは常に必須。
- 有料枠を作る場合、キャンセルポリシー本文と特商法等必要表示URLが必須。
- 特商法等の本文はサービス側で保持せずURLのみ保持する。
- ブラックリストはMVP対象外で、テーブルも作らない。
- コミュニティ削除はSoft Delete。削除済みコミュニティslugは再利用不可。
- 終了前イベントがある場合、コミュニティ削除をブロックする。

## イベント

- イベント概要はMarkdown。
- 状態は `draft / published / cancelled / archived`。
- draftは管理者のみ閲覧可能。
- published/cancelledは全員閲覧可能。
- cancelledはページ最上部に中止表示と中止理由を表示する。
- archivedは管理者が削除扱いにした下書きで、通常画面では非表示。
- イベント物理削除はMVPでは行わない。
- 公開後でも有効申し込みが0件ならdraftに戻せる。
- draftのみarchivedにできる。
- 有効申し込みが1件でもある場合はdraftに戻せず、archivedにもできない。
- 自動公開 `publish_at` を持つ。最大30分程度の遅延を許容。
- すべて公開イベント。限定公開はMVP対象外。
- 検索・タグはPost-MVP。

## 開催形式

- `offline / online / hybrid`。
- online/hybridの場合、参加者にのみ視聴URLを表示する。
- offline/hybridの場合、全員に会場名・住所・参考URLを表示し、参加者にのみ入館方法などを表示する。

## イベント個別管理者

- イベントごとにコミュニティ外ユーザーを個別管理者として追加できる。
- 対象イベントに対して全管理権限を持つ。
- コミュニティ設定、コミュニティ管理者、Stripe連携、他イベントは管理できない。

## 参加枠・申し込み

- イベントには複数枠を作れる。
- 枠ごとに定員、金額、先着/抽選、招待専用、招待コード、募集期間上書き、キャンセル期限、事前アンケートを設定できる。
- 枠ごとにキャンセル待ち可否・自動繰り上げ可否を持つ。
- 有料枠のキャンセル待ちはMVP対象外。`price_jpy > 0` なら `waitlist_enabled=false`。
- 有料枠は決済成功まで参加確定しない。
- 有料枠で支払い期限切れならcancelled。
- 有料抽選で当選者が支払わなくても、MVPでは次点者自動繰り上げはしない。
- 参加者本人キャンセルは許可。枠ごとのキャンセル期限まで。
- 自動返金はしない。
- 返金機能も作らない。

## 決済

- Stripe Connect Accounts v2 APIを採用。
- Stripe連携はコミュニティ単位。
- Account Links v2でStripeホスト型オンボーディング。
- 無料枠だけならStripe未連携で作成可能。
- 有料枠作成にはStripe連携必須。
- 通貨はJPYのみ。
- プラットフォーム手数料は将来含め0円。
- サービス側では領収書・請求書・インボイスを発行しない。
- 売上ログは残すが、Stripe上の実売上・返金後実績との差異は許容する。

## 事前アンケート

- イベントに複数アンケートを作れる。
- 枠には最大1つのアンケートを紐付けられる。
- 設問タイプ: short_text, long_text, single_choice, multiple_choice, checkbox_consent。
- 必須/任意を設定できる。
- MVPでは必須チェック以外のvalidationはしない。
- CSVダウンロードできれば十分。ダッシュボードはPost-MVP。
- 行動規範・ポリシー同意はアンケートとは別。申し込み作成=同意済みとみなし、同意テーブル/カラムは持たない。

## チェックイン

- 手動チェックインとQRチェックインの両方をMVPで実装。
- チェックインはイベント管理権限者のみ。
- QRはイベント参加画面 `/events/{event_id}/ticket` に表示し、印刷利用も想定する。
- QR URL: `/checkins/{event_id}?application={application_id}&user={user_id}&hmac={hmac}`。
- HMAC対象: `event_id:application_id:user_id`。
- QR自体に有効期限は設けない。
- 二重チェックインはエラーにせず「すでにチェックイン済み」と表示する。

## 通知

- MVPはメールのみ。
- ユーザーごとの通知設定はPost-MVP。
- 参加者向け: 参加確定、参加前日リマインド、中止。
- イベント中止時は有効申し込みユーザーに必ず送る。
- 管理者向け: イベント公開、自動公開、中止。関係する全管理者に送る。
- 決済失敗やシステム異常はコミュニティ管理者には通知しない。

## データ保持

- 主要業務データは365日保持方針。
- 自動削除・匿名化はMVPでは実装しない。

## 認証・ユーザー登録の詳細

### user slug

- 登録時必須
- 半角英小文字、数字、ハイフン、アンダースコア
- 3〜32文字
- 先頭・末尾のハイフン/アンダースコア不可
- 連続するハイフン/アンダースコア不可
- 予約語不可
- 主要な不適切語不可
- 変更可能
- 旧URLリダイレクトなし

### display_name

- 登録時必須
- 重複OK

### email

- 登録時必須
- 変更時は再確認必須
- メール未確認状態ではログイン不可

### Social login

Google/GitHubログインはSprint 2で実装する。

同一メールアドレスなら既存ユーザーに紐付ける。

ただし、provider側メールアドレスが未確認の場合は、自動紐付けしない。

## Slug予約語・制限

### reserved slugs

以下は user slug / community slug に使用できない。

- admin
- admins
- login
- logout
- register
- signup
- signin
- settings
- account
- accounts
- events
- event
- communities
- community
- users
- user
- api
- dashboard
- me
- new
- edit
- create
- delete
- help
- support
- terms
- privacy
- policies
- policy
- contact
- about
- health
- webhooks
- stripe
- auth
- oauth
- callback
- assets
- storage
- www
- mail
- ftp
- smtp
- cdn
- static
- root
- webmaster
- info

### 不適切slug制限

MVPでは、user slug / community slug に直接的に卑猥・攻撃的な主要語を使用できないようにする。

方針:

- 主要な英語・日本語ローマ字の卑猥語のみブロックする
- 完全なNGワード辞書はMVPでは作らない
- 誤検知を避けるため、過度に広い部分一致は避ける
- 基本は完全一致、または明確な単語境界での一致を対象にする
- 管理者による審査機能はMVP対象外

## Markdown / HTML

Markdown入力を許可する。

対象:

- ユーザー自己紹介
- コミュニティ紹介文
- キャンセルポリシー
- イベント概要

許可するMarkdown記法:

- 見出し
- 段落
- 改行
- 太字
- 斜体
- 取り消し線
- 箇条書き
- 番号付きリスト
- 引用
- コード
- コードブロック
- リンク
- テーブル
- 水平線
- 外部画像URLによる画像表示

生HTMLは原則禁止。

ただし、以下の安全なHTMLタグのみ許可する。

- br
- details
- summary
- kbd
- mark
- sup
- sub

禁止するHTMLタグ:

- script
- style
- iframe
- object
- embed
- form
- input
- button
- textarea
- select
- video
- audio
- canvas
- svg

外部リンクは許可する。

外部リンクには `target="_blank"` と `rel="noopener noreferrer"` を付与する。

MVPではMarkdown本文への画像アップロードは行わない。

外部URLによる画像埋め込みのみ許可する。

## メール文体

- 文体は「です・ます」
- 件名形式は `[Tomos] {通知内容} - {イベント名}`
- 参加者向けメールにはコミュニティ問い合わせ先 `contact_email` を載せる
- 有料イベントメールにはキャンセルポリシーと特定商取引法など必要表示URLを載せる

## UI用語

MVPでは、UI上の主要用語を以下に寄せる。

- イベント
- コミュニティ
- 参加枠
- 申し込み
- チケット
- コミュニティ運営者

「管理者」は内部設計・権限名としては使ってよいが、ユーザー向けUIでは原則「コミュニティ運営者」を使う。

## 有料枠の抽選

MVPでは、有料枠は原則として先着順のみとする。

有料枠では抽選制を扱わない。

理由:

- 当選後決済、支払い期限切れ、次点繰り上げなどの運用が複雑になるため
- MVPでは有料枠の申し込み体験を単純化するため

有料枠の支払い期限は30分とする。

## ログイン後導線

- 通常ログイン後: `/dashboard`
- イベント申し込み途中でログインした場合: 元の申し込み画面に戻す
- 管理画面からログイン要求された場合: 元の管理画面に戻す


## サービス名・ドメイン

- サービス名: `Tomos`
- ドメイン: `tomos.dev`

Tomos は「灯す」を由来とするサービス名である。
