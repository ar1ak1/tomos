# データモデル

## 方針

- DB: PostgreSQL
- 主キー: bigserial
- JPY限定
- SoftDeletes: users, communities
- eventsはSoftDeleteせず `status=archived` を使う
- 重複申し込みはPostgreSQL部分ユニークインデックスで担保

## テーブル一覧

users, social_accounts, user_external_links, communities, community_external_links, community_admins, community_stripe_accounts, events, event_admins, event_slots, event_applications, payments, stripe_webhook_events, questionnaires, questionnaire_questions, questionnaire_options, questionnaire_answers, lottery_overrides, lottery_runs, audit_logs, jobs, failed_jobs。

## users

- id bigserial PK
- slug varchar unique not null
- display_name varchar not null
- email varchar unique not null
- email_verified_at timestamp nullable
- password varchar nullable
- avatar_image_path varchar nullable
- bio_markdown text nullable
- deleted_at timestamp nullable
- timestamps

## communities

- id bigserial PK
- slug varchar unique not null
- display_name varchar not null
- ogp_image_path varchar nullable
- coc_url text not null
- policy_url text nullable
- contact_email varchar not null
- cancellation_policy_markdown text nullable
- commerce_disclosure_url text nullable
- description_markdown text nullable
- deleted_at timestamp nullable
- timestamps

## community_admins

- id bigserial PK
- community_id FK not null
- user_id FK not null
- added_by_user_id FK nullable
- timestamps
- unique `(community_id, user_id)`

## community_stripe_accounts

- id bigserial PK
- community_id FK unique not null
- stripe_account_id varchar unique not null
- onboarding_status varchar not null: not_started / onboarding_started / enabled / restricted
- charges_enabled boolean not null default false
- payouts_enabled boolean not null default false
- requirements_currently_due jsonb nullable
- requirements_eventually_due jsonb nullable
- last_synced_at timestamp nullable
- timestamps

## events

- id bigserial PK
- community_id FK not null
- title varchar not null
- description_markdown text not null
- status varchar not null: draft / published / cancelled / archived
- publish_at timestamp nullable
- starts_at timestamp not null
- ends_at timestamp not null
- application_starts_at timestamp nullable
- application_ends_at timestamp nullable
- prefecture_code smallint nullable
- venue_type varchar not null: offline / online / hybrid
- venue_name varchar nullable
- venue_address text nullable
- venue_reference_url text nullable
- participant_venue_information text nullable
- online_url text nullable
- ogp_image_path varchar nullable
- cancellation_reason text nullable
- cancelled_at timestamp nullable
- cancelled_by_user_id FK nullable
- timestamps

## event_admins

- id bigserial PK
- event_id FK not null
- user_id FK not null
- added_by_user_id FK nullable
- timestamps
- unique `(event_id, user_id)`

## event_slots

- id bigserial PK
- event_id FK not null
- questionnaire_id FK nullable
- name varchar not null
- description text nullable
- capacity integer not null
- price_jpy integer not null default 0
- selection_method varchar not null: first_come / lottery
- waitlist_enabled boolean not null default false
- auto_promote_waitlist boolean not null default false
- invite_only boolean not null default false
- invite_code_hash varchar nullable
- application_starts_at timestamp nullable
- application_ends_at timestamp nullable
- cancellation_deadline_at timestamp nullable
- sort_order integer not null default 0
- timestamps

Constraints:

```sql
CHECK (price_jpy >= 0);
CHECK (capacity > 0);
CHECK (price_jpy = 0 OR waitlist_enabled = false);
CHECK (waitlist_enabled = true OR auto_promote_waitlist = false);
CHECK (price_jpy = 0 OR auto_promote_waitlist = false);
-- Application側またはDB制約で、price_jpy > 0 の場合 selection_method = 'first_come' を保証する。
```

## event_applications

- id bigserial PK
- event_id FK not null
- event_slot_id FK not null
- user_id FK not null
- status varchar not null: pending_payment / pending_lottery / waiting / confirmed / rejected / cancelled
- is_active boolean not null
- attendance_status varchar not null: not_applicable / not_checked_in / attended / no_show
- payment_status varchar not null: not_required / not_charged / paid
- amount_jpy integer not null
- waiting_order integer nullable
- lottery_order integer nullable
- payment_started_at timestamp nullable
- payment_due_at timestamp nullable
- applied_at timestamp not null
- confirmed_at timestamp nullable
- cancelled_at timestamp nullable
- cancelled_by_user_id FK nullable
- cancellation_actor_type varchar nullable: participant / admin / system
- cancellation_reason varchar nullable: participant_request / admin_cancelled / payment_expired / event_cancelled / policy_violation / duplicate_application / other
- cancellation_public_message text nullable
- cancellation_admin_remark text nullable
- checked_in_at timestamp nullable
- checked_in_by_user_id FK nullable
- no_show_marked_at timestamp nullable
- no_show_marked_by_user_id FK nullable
- no_show_remark text nullable
- timestamps

Partial unique index:

```sql
CREATE UNIQUE INDEX event_applications_unique_active_user_slot
ON event_applications (event_slot_id, user_id)
WHERE is_active = true;
```

## payments

MVPでは返金機能を作らない。paymentsは売上ログを兼ねる。

- id bigserial PK
- event_application_id FK not null
- community_id FK not null
- event_id FK not null
- event_slot_id FK not null
- user_id FK not null
- provider varchar not null default stripe
- provider_checkout_session_id varchar nullable
- provider_payment_intent_id varchar nullable
- amount_jpy integer not null
- status varchar not null: checkout_created / paid / expired
- checkout_url text nullable
- checkout_expires_at timestamp nullable
- paid_at timestamp nullable
- expired_at timestamp nullable
- timestamps

## stripe_webhook_events

- id bigserial PK
- stripe_event_id varchar unique not null
- event_type varchar not null
- payload jsonb not null
- processing_status varchar not null: pending / processed / failed / ignored
- processed_at timestamp nullable
- error_message text nullable
- timestamps

## questionnaires / answers

- questionnaires: id, event_id, title, description, timestamps
- questionnaire_questions: id, questionnaire_id, question_text, question_type, is_required, sort_order, timestamps
- questionnaire_options: id, questionnaire_question_id, option_label, sort_order, timestamps
- questionnaire_answers: id, event_application_id, questionnaire_question_id, answer_text, answer_values jsonb, timestamps

## lottery

- lottery_overrides: event_slot_id, user_id, override_type force_win/force_lose, reason, created_by_user_id
- lottery_runs: event_slot_id, executed_by_user_id, executed_at, seed, status completed/failed

## audit_logs

- actor_user_id nullable
- actor_type user/system
- action
- target_type
- target_id
- community_id nullable
- event_id nullable
- metadata jsonb nullable
- ip_address inet nullable
- user_agent text nullable
- created_at
