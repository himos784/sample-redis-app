## Tech Stack
- Laravel (API)
- Redits
- Mysql
- Docker(Redis)

## Purpose - This project is my way of implementing Redis

- how to retrieve data from Redis 
- flushing data if there is a creation, update and delete that happens
- this also uses Laravel Eloquent Event Observer
- will be using Design Patterns like Service, Repository and Action

## Installation

- clone repository
- Docker needs to be installed
  - After installation, run these commands:
    ```sh
    docker pull redis:alpine
    docker run --name laravel_redis -d -p 6379:6379 redis:alpine
    ```
- update Laravel env parameters
  ```env
  CACHE_STORE=redis
