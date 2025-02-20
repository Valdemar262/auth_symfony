## test-symfony.

### Introduction:

### Test-symfony provides simple containerized infrastructure of `Symfony, Nginx, PostgreSQL and Xdebug`.

### Getting started:

### local deployment:

### 1) create `.env` file in `app` directory (copy or rename `.env-example`).
### 2) Start containers through:
#### `docker compose --env-file app/.env up -d`
### 3) Into app container run next command:
#### `composer install`.
### 4) Key generate for JWT authenticate:
#### `openssl genpkey -algorithm RSA -out config/jwt/private.pem -pkeyopt rsa_keygen_bits:2048`
#### `openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem`

# API для авторизации и управления пользователями

Этот API предоставляет возможности для регистрации, логина, обновления и удаления пользователей с использованием **JWT** (JSON Web Tokens) для аутентификации.

## Авторизация

### 1. Регистрация пользователя
- **Маршрут**: `http://localhost:8080/api/register`
- **Метод**: `POST`
- **Тело запроса**: Параметры передаются как `x-www-form-urlencoded`:
  ```json
  {
    "email": "example@gmail.com",
    "password": "Password123",
    "name": "Name"
  }
  ```
- **Ответ**:
```json
  {
      "data": {
        "id": 1,
        "name": "Password123",
        "email": "example@gmail.com",
        "age": null
      }
  }
```
### 2. Логин пользователя
- **Маршрут**: `http://localhost:8080/api/login_check`
- **Метод**: `POST`
- **Тело запроса**: Параметры передаются как `x-www-form-urlencoded`:
  ```json
  {
    "email": "example@gmail.com",
    "password": "Password123"
  }
  ```
- **Ответ**:
```json
  {
    "data": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE3NDAwNjY0MzksImV4cCI6MTc0MDA3MDAzOSwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoic2FzcnRiaGRyc2VicnRAY3Nkdi5zZHZlZHdlZiJ9.Y74eWakD6fN3FVrrL-igs2qtMn8kIm_YrISNgpas1375yRM96dLTahnKlvzBqFbNJ6_EBOE8nq0nzaf-6OSUtVXOXOrSFXRobtI-C5rbvv2zE_D0b_s0QknLQd-JJWLoE4QpR_iYzTEFFxb_DaLfc53ZB2FHydR6l5ifddsfgVOTv82r-5hlKKqQV--GTEt8gUxyLifE-jzLSMjpiqRWu3OpvFl7Sd8fEsmDMnSWieXtBSg4wDhlaCYjhx9TrEzhgUPecL3MdPzNBb-p0d3XasBpnVudZFFh39O0lwGR-E8814gjo-KdNKMOlHYhGL08Fu4fEzWbTbi2pryutGDstA"
  }
```
### 3. Выход из системы
- **Маршрут**: `http://localhost:8080/api/logout`
- **Метод**: `GET`
- **Требуется аутентификация**: (JWT токен в заголовке `Authorization` `Bearer Token`).
- **Ответ**:
```json
  {
    "data": "Вы успешно вышли"
  }
```
### 4. Получить всех пользователей
- **Маршрут**: `http://localhost:8080/api/allUsers`
- **Метод**: `GET`
- **Требуется аутентификация**: (JWT токен в заголовке `Authorization` `Bearer Token`).
- **Ответ**:
```json
  [
    {
      "id": 1,
      "email": "example@gmail.com",
      "name": "Vladimir",
      "age": null
    },
    {
      "id": 2,
      "email": "bubnovv661@gmail.com",
      "name": "Example",
      "age": null
    }
  ]
```
### 5. Получить текущего пользовател
- **Маршрут**: `http://localhost:8080/api/getCurrentUser`
- **Метод**: `GET`
- **Требуется аутентификация**: (JWT токен в заголовке `Authorization` `Bearer Token`).
- **Ответ**:
```json
  {
    "id": 1,
    "name": "Vladimir",
    "email": "example@gmail.com",
    "age": null
  }
```
### 6. Обновить данные пользователя
- **Маршрут**: `http://localhost:8080/api/update`
- **Метод**: `PUT`
- **Требуется аутентификация**: (JWT токен в заголовке `Authorization` `Bearer Token`).
- **Тело запроса**: Параметры передаются как `x-www-form-urlencoded`:
  ```json
  {
    "name": "Vladimir1",
    "email": "example@gmail.com",
    "age": 23
  }
  ```
- **Ответ**:
```json
  {
    "id": 1,
    "name": "Vladimir1",
    "email": "example@gmail.com",
    "age": 23
  }
```
### 7. Удалить пользователя
- **Маршрут**: `http://localhost:8080/api/delete/1`
- **Метод**: `DELETE`
- **Требуется аутентификация**: (JWT токен в заголовке `Authorization` `Bearer Token`).
- **Ответ**:
```json
  {
    "User deleted successfully."
  }
```
