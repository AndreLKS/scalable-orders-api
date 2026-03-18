# Scalable Orders API

A production-ready backend system for asynchronous order processing, built with Laravel, Redis, PostgreSQL, and Docker.

## Overview

This project demonstrates a scalable architecture using:

- Asynchronous job processing with queues
- Redis for high-performance queue handling
- PostgreSQL for persistent storage
- Docker for containerized development and deployment

The system is designed to handle high-throughput order creation and processing with fault tolerance and retry mechanisms.

---

## Architecture

Client → API → Database → Queue (Redis) → Worker → Processing

- API handles incoming requests
- Orders are stored in PostgreSQL
- Jobs are dispatched to Redis queue
- Worker processes jobs asynchronously

---

## Tech Stack

- PHP (Laravel)
- PostgreSQL
- Redis
- Docker & Docker Compose

---

## Features

- Async order processing
- Retry strategy for failed jobs
- Failure handling with status tracking
- Containerized environment
- Scalable architecture ready for cloud deployment

---

## Running the Project

### 1. Clone the repository

```bash
git clone https://github.com/your-username/scalable-orders-api.git
cd scalable-orders-api
```

### 2. Start containers
```bash
docker-compose up -d --build
```
### 3. Install dependencies
```bash
docker exec -it scalable-orders-api-app-1 composer install
```
### 4. Run migrations
```bash
docker exec -it scalable-orders-api-app-1 php artisan migrate
```
### API Usage
---
#### Create Order
 - POST /api/orders

```json Request Body:
{
  "user_id": 1,
  "total_amount": 100
}
```
--- 
### Queue Processing

- The system uses Redis for queue management.

- Worker runs automatically via Docker:
```bash
docker logs -f scalable-orders-api-worker-1
```
---
### Job Lifecycle

#### Order status flow:

- pending

- processing

- completed

- failed
---
### Failure Handling

- Jobs retry up to 3 times

- Failed jobs are stored for inspection
```bash
php artisan queue:failed
```
---
### Testing Load
```bash
for i in {1..10}; do curl -X POST http://localhost:8000/api/orders -H "Content-Type: application/json" -d '{"product":"Test","amount":1}'; done
```
---
### What This Project Demonstrates

- Backend scalability patterns

- Distributed system design basics

- Queue-based architecture

- Fault tolerance strategies
---
### Future Improvements

- API authentication (JWT)

- Rate limiting

- Kubernetes deployment

- CI/CD pipeline
---
### License

- MIT