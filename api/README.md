# API - Scalable Orders

This service is responsible for handling order creation and dispatching jobs for asynchronous processing.

---

## Responsibilities

- Receive and validate requests
- Persist orders in database
- Dispatch jobs to queue

---

## Structure

- Controllers → Request handling
- Models → Database interaction
- Jobs → Async processing logic

---

## Order Flow

1. Client sends request
2. Order is saved with `pending` status
3. Job is dispatched to queue
4. Worker processes job
5. Status updated to `completed` or `failed`

---

## Environment

Make sure `.env` is configured:

```bash
DB_HOST=postgres_db
REDIS_HOST=redis_cache
QUEUE_CONNECTION=redis
CACHE_STORE=redis
```
---

## Run Locally (without Docker)

```bash
composer install
php artisan migrate
php artisan serve
php artisan queue:work
```
## Observability

- Check logs:
```json
storage/logs/laravel.log
```
## Design Decisions

- Redis chosen for queue performance

- PostgreSQL for reliability

- Docker for reproducibility

- Async jobs for scalability

### Notes

- Ensure Redis extension is installed in PHP

- Worker must be running to process jobs
---