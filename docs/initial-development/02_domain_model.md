# ドメインモデル

## 主要概念

| 用語 | 意味 |
|---|---|
| User | 参加者アカウント |
| Community | ITコミュニティ。主催・売上受取の責任主体 |
| CommunityAdmin | コミュニティ管理者。権限は1種類 |
| Event | 勉強会・イベント |
| EventAdmin | イベント個別管理者 |
| EventSlot | 参加枠 |
| EventApplication | 参加申し込み |
| Payment | Stripe Checkoutによる決済ログ・売上ログ |
| Questionnaire | 事前アンケート |
| AuditLog | 管理者重要操作ログ |

## Event status

| status | 意味 | 表示 |
|---|---|---|
| draft | 下書き | 管理者のみ |
| published | 公開 | 全員 |
| cancelled | 中止 | 全員。中止表示あり |
| archived | 下書きの削除扱い | 通常非表示 |

## EventApplication status

| status | 意味 | is_active | 定員消費 | 参加権利 |
|---|---|---:|---:|---:|
| pending_payment | 支払い待ち | true | yes | no |
| pending_lottery | 抽選待ち | true | no | no |
| waiting | キャンセル待ち | true | no | no |
| confirmed | 参加確定 | true | yes | yes |
| rejected | 落選 | false | no | no |
| cancelled | キャンセル済み | false | no | no |

## attendance_status

| value | 意味 |
|---|---|
| not_applicable | 実参加判定対象外 |
| not_checked_in | 参加確定済みだが未チェックイン |
| attended | チェックイン済み・実参加 |
| no_show | 無断不参加 |

## payment_status

| value | 意味 |
|---|---|
| not_required | 無料枠のため決済不要 |
| not_charged | 有料枠だがまだ請求していない |
| paid | 決済済み |

MVPでは返金状態を本システムで管理しない。

## 主要ライフサイクル

### Event

```text
draft -> published
draft -> archived
published -> draft      # active application 0件のみ
published -> cancelled
```

### 有料先着申し込み

```text
pending_payment -> confirmed
pending_payment -> cancelled  # payment expired
confirmed -> cancelled
confirmed + not_checked_in -> confirmed + attended
confirmed + not_checked_in -> confirmed + no_show
```

### 抽選申し込み

```text
pending_lottery -> confirmed        # 無料当選
pending_lottery -> pending_payment  # 有料当選
pending_lottery -> rejected
pending_payment -> confirmed
pending_payment -> cancelled
```

### 無料キャンセル待ち

```text
waiting -> confirmed
waiting -> cancelled
```

## 権限

### コミュニティ管理可能

対象コミュニティの `community_admins` に存在するユーザー。

### イベント管理可能

以下のどちらか。

- 対象イベントのコミュニティ管理者
- 対象イベントのイベント個別管理者
