# UIガイドライン

## 方針

MVPでは、独自デザインシステムを作り込みすぎず、Laravel Breeze + Blade + Tailwind CSS に素直に乗る。

目的は「イベントを探しやすい」「申し込みで迷わない」「管理者が運営しやすい」こと。

## トーン

### キーワード

- シンプル
- 安心感
- 読みやすい
- 運営しやすい
- 少しあたたかい
- エンジニア向けに過剰装飾しない
- コミュニティの安全性を感じられる

## カラーパレット

MVPでは、**アンバー基調 + オレンジ差し色**を採用する。

### Primary: Amber

灯り、ぬくもり、安心感、コミュニティのあたたかさを表す。

| 用途 | Tailwind | Hex |
|---|---|---|
| Primary | `amber-600` | `#D97706` |
| Primary hover | `amber-700` | `#B45309` |
| Primary light | `amber-50` | `#FFFBEB` |
| Primary border | `amber-200` | `#FDE68A` |

### Accent: Orange

炎の熱量、注目、活気、人が集まる高揚感を表す。

| 用途 | Tailwind | Hex |
|---|---|---|
| Accent | `orange-500` | `#F97316` |
| Accent hover | `orange-600` | `#EA580C` |
| Accent light | `orange-50` | `#FFF7ED` |
| Accent border | `orange-200` | `#FED7AA` |

### Base / Text

| 用途 | Tailwind | Hex |
|---|---|---|
| Background | `stone-50` | `#FAFAF9` |
| Card | `white` | `#FFFFFF` |
| Text main | `slate-900` | `#0F172A` |
| Text sub | `slate-600` | `#475569` |
| Text muted | `slate-500` | `#64748B` |
| Border | `stone-200` | `#E7E5E4` |

### Semantic Colors

| 用途 | Tailwind | Hex |
|---|---|---|
| Danger | `red-600` | `#DC2626` |
| Danger light | `red-50` | `#FEF2F2` |
| Success | `green-600` | `#16A34A` |
| Success light | `green-50` | `#F0FDF4` |
| Warning | `amber-600` | `#D97706` |
| Warning light | `amber-50` | `#FFFBEB` |
| Info | `sky-600` | `#0284C7` |
| Info light | `sky-50` | `#F0F9FF` |

## 色の使い分け

### Primary

以下に使用する。

- 主要ボタン
- 主要リンク
- 現在選択中のナビゲーション
- 管理画面の主要アクション
- 参加申し込みボタン

### Accent

以下に使用する。

- 注目ラベル
- 重要なお知らせ
- イベント開催日などのアクセント
- 注目表示や活気を出したい箇所の差し色

ただし、危険操作には使わない。

### Danger

以下に使用する。

- イベント中止
- 参加キャンセル
- コミュニティ削除
- 退会
- 管理者によるキャンセル

### Success

以下に使用する。

- 参加確定
- チェックイン完了
- 決済完了
- 保存完了

### Warning

以下に使用する。

- 支払い期限が近い
- キャンセル期限が近い
- 有料枠作成に必要な設定不足
- イベント中止前の確認

## ダークモード

MVPではダークモードを実装しない。

MVPのUIはライトモード固定とする。

### 理由

- 色設計が2系統必要になり、確認コストが増える
- OGP画像、ステータスバッジ、フォーム、エラー表示、Danger操作の視認性確認が増える
- Tailwindの `dark:` 対応が各コンポーネントに入り、実装量が増える
- MVPではE2E/VRTを実施しないため、見た目の崩れ検知が難しい
- MVPではコスト・開発速度・運用の単純さを優先する

### 将来対応に備える方針

- 色指定は共通Blade Componentに寄せる
- 画面ごとに `text-slate-900` や `bg-white` を散らしすぎない
- Tailwind標準色を優先する
- 将来ダークモード対応する場合は、共通コンポーネントから段階的に対応する

## UIコンポーネント方針

共通UIはBlade Component化する。

MVPで作る候補:

- Button
- SecondaryButton
- DangerButton
- LinkButton
- Card
- Badge
- Alert
- FormInput
- FormTextarea
- FormSelect
- FormCheckbox
- ErrorMessage
- StatusBadge
- EmptyState
- Modal
- Pagination

## 画面トーン

### 公開画面

- 参加者が迷わずイベント内容を読めることを優先する
- イベント名、開催日時、参加枠、申し込み状態を目立たせる
- OGP画像は詳細ページ上部のカバーとして使用する
- 中止イベントでは最上部に赤系の中止表示を出す

### 参加者画面

- 参加予定、チケット、QRコードを見つけやすくする
- チケット画面はスマホ表示と印刷の両方を意識する
- 参加者限定情報は、参加確定済みの場合のみ表示する

### 管理画面

- 実用性を優先する
- 装飾よりも一覧性・状態把握・操作導線を重視する
- 危険操作は必ずDanger色と確認画面を使う
- CSVダウンロード、チェックイン、管理者キャンセルなど重要操作は視認性を高める

## Status Badge

### Event Status

| status | 表示 | Color |
|---|---|---|
| draft | 下書き | `slate` |
| published | 公開中 | `amber` |
| cancelled | 中止 | `red` |
| archived | 非表示 | `slate` |

### Application Status

| status | 表示 | Color |
|---|---|---|
| pending_payment | 支払い待ち | `amber` |
| pending_lottery | 抽選待ち | `sky` |
| waiting | キャンセル待ち | `amber` |
| confirmed | 参加確定 | `green` |
| rejected | 落選 | `slate` |
| cancelled | キャンセル済み | `red` |

### Attendance Status

| status | 表示 | Color |
|---|---|---|
| not_applicable | 対象外 | `slate` |
| not_checked_in | 未チェックイン | `amber` |
| attended | 参加済み | `green` |
| no_show | 無断不参加 | `red` |

### Payment Status

| status | 表示 | Color |
|---|---|---|
| not_required | 決済不要 | `slate` |
| not_charged | 未請求 | `amber` |
| paid | 決済済み | `green` |

## Typography

MVPではシステムフォントを基本とする。

```css
font-family:
  ui-sans-serif,
  system-ui,
  -apple-system,
  BlinkMacSystemFont,
  "Segoe UI",
  sans-serif;
```

日本語環境での読みやすさを優先する。

## Layout

- 背景は `stone-50`
- メインコンテンツは最大幅を制限する
- カードは白背景 + subtle border
- 角丸は控えめに使う
- 管理画面は情報密度を高める
- 公開画面は余白をやや多めにする

## Accessibility

- 色だけで状態を伝えない
- status badgeにはテキストを必ず含める
- フォームエラーは入力欄の近くに表示する
- ボタンはフォーカス状態を持つ
- QRコードには代替テキストまたは説明を添える
- Danger操作には確認画面を挟む

## MVP対象外

- ダークモード
- 複雑なテーマ切り替え
- 本格的なデザインシステム
- Figma完全連携
- OGP画像自動生成
- 高度なアニメーション
- VRT
- UIスナップショットテスト

## Tailwind利用方針

- 基本はTailwind utility classで実装する
- 共通パターンはBlade Component化する
- 独自CSSは最小限にする
- 画面ごとの個別CSSを増やしすぎない
- Tailwind configに色を追加しすぎない
- まずはTailwind標準色を使用する
