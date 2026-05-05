# API / ルーティング設計

MVPではLaravel Blade中心のWebアプリケーションとし、JSON API分離は必須としない。

## 方針

- ControllerはHTTP入出力の調整に留める。
- FormRequestでvalidationを行う。
- Policy/Gateでauthorizationを行う。
- Actionでbusiness logicを実装する。

## 重要ルート

### Stripe Webhook

```http
POST /webhooks/stripe
```

- Webhook署名検証必須。
- `stripe_webhook_events.stripe_event_id` で冪等性を担保。

### Health Check

```http
GET /health
```

### Stripe onboarding開始

```http
POST /admin/communities/{community_id}/stripe/connect
```

### QR Check-in

```http
GET /checkins/{event_id}?application={application_id}&user={user_id}&hmac={hmac}
```

### CSV

```http
GET /admin/events/{event_id}/applications.csv
GET /admin/events/{event_id}/questionnaires/{questionnaire_id}/answers.csv
```

CSVダウンロードは監査ログ対象。
