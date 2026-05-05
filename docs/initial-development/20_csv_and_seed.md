
# CSV・Seedデータ方針

## CSV方針

MVPでは、参加者一覧CSVとアンケート回答CSVを提供する。

CSVは管理画面からダウンロードできる。

CSVダウンロードは監査ログ対象とする。

## 参加者CSV

参加者CSVには最低限以下の列を含める。

| Column | Description |
|---|---|
| application_id | 申し込みID |
| user_id | ユーザーID |
| display_name | 表示名 |
| email | メールアドレス |
| slot_name | 参加枠名 |
| application_status | 申し込み状態 |
| payment_status | 決済状態 |
| attendance_status | 実参加状態 |
| applied_at | 申し込み日時 |
| confirmed_at | 参加確定日時 |
| checked_in_at | チェックイン日時 |

## アンケート回答CSV

アンケート回答CSVには最低限以下の列を含める。

| Column | Description |
|---|---|
| application_id | 申し込みID |
| user_id | ユーザーID |
| display_name | 表示名 |
| email | メールアドレス |
| slot_name | 参加枠名 |
| question_1... | 設問ごとの回答 |

設問列は、アンケート設問の表示順に出力する。

MVPでは高度な集計は行わない。

## Seedデータ方針

local環境では開発しやすさのためにseedデータを用意する。

### 初期seed候補

- テストユーザー
- テストコミュニティ
- コミュニティ運営者
- テストイベント
- 無料先着枠
- 無料抽選枠
- 有料先着枠
- 招待専用枠
- アンケート付き枠
- 申し込み済みユーザー
- チェックイン済みユーザー
- no-showユーザー

### 方針

- productionで開発用seedを実行しない
- stagingでは必要に応じて検証用seedを実行する
- seedデータは決済やメール送信を不用意に発生させない
