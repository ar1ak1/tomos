# 開発ルール

## 基本方針

- Laravel Way優先
- 小さく実装
- MVP対象外を勝手に作らない
- 認証/認可/決済/個人情報は簡略化しない
- Controllerを太らせない
- DB制約で守れる仕様はDBでも守る

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
- 個人情報をログに出す

## ブランチ

- feature/*
- staging
- main

原則: `feature/* -> staging -> main`

## PRテンプレート

```md
## Summary
## Changed Files
## Tests
## Impact
## Remaining Issues
```

## Slug実装ルール

Slugの予約語とブロック語は設定ファイルで管理する。

例:

- `config/slugs.php`

`reserved` と `blocked_words` は分離する。

予約語リストはテストする。

不適切語制限はMVPでは主要語のみとし、過度な部分一致による誤検知を避ける。

## Markdown実装ルール

Markdown変換後のHTMLは必ずサニタイズする。

生HTMLは原則禁止。

許可タグは設計書の許可リストに限定する。

Markdown本文への画像アップロードはMVPでは実装しない。

外部画像URLのみ許可する。

## Social Login実装ルール

Social loginはSprint 2で実装する。

同一メールアドレスなら既存ユーザーに紐付ける。

provider側メールアドレスが未確認の場合は、自動紐付けしない。

## Privacy対応ルール

個人情報の自動エクスポート・自動完全削除はMVPでは実装しない。

個人情報の所在を増やす場合は `17_privacy_and_data_requests.md` を更新する。

## 用語実装ルール

ユーザー向けUIでは、原則として「管理者」ではなく「コミュニティ運営者」を使用する。

内部設計・コード上では `admin` を使ってよい。

## メール実装ルール

メール文面は `19_email_guidelines.md` に従う。

件名形式は以下とする。

`[サービス名] {通知内容} - {イベント名}`

## 有料枠実装ルール

MVPでは有料枠の抽選制を実装しない。

`price_jpy > 0` の場合、参加枠は先着順のみとする。

有料枠の支払い期限は30分とする。

## CSV / Seed実装ルール

CSVとseedデータは `20_csv_and_seed.md` に従う。
