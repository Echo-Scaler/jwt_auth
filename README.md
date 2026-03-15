# JWT Auth Laravel API

A Laravel 12 API project that uses `tymon/jwt-auth` for stateless authentication with role-based access (`admin` vs `user`).

## Project Process (High Level)
1. A user submits credentials to `POST /api/login`.
2. If valid, the API returns a JWT access token.
3. The client sends the token in `Authorization: Bearer <token>` for protected routes.
4. The `jwt` middleware authenticates the token for `/api/me` and `/api/logout`.
5. The `admin` and `user` middleware enforce role-based access for `/api/admin` and `/api/user`.

## Setup
1. Install dependencies.
   `composer install`
2. Create `.env` and app key.
   `cp .env.example .env`
   `php artisan key:generate`
3. Configure DB in `.env` and run migrations.
   `php artisan migrate`
4. Generate JWT secret.
   `php artisan jwt:secret`
5. Run the app.
   `php artisan serve`

## Dropdown Functions (Endpoints)

<details>
<summary><strong>POST /api/login</strong></summary>

Purpose:
- Authenticates the user and issues a JWT token.

Middleware:
- `throttle:5,1` (rate limit: 5 requests per minute).

Request:
- `email`
- `password`

Response:
- `access_token`
- `token_type` (note: currently returns `barer` in code)
- `expires_in`
</details>

<details>
<summary><strong>POST /api/me</strong></summary>

Purpose:
- Returns the currently authenticated user.

Middleware:
- `jwt`

Header:
- `Authorization: Bearer <token>`
</details>

<details>
<summary><strong>POST /api/logout</strong></summary>

Purpose:
- Invalidates the current JWT token.

Middleware:
- `jwt`

Header:
- `Authorization: Bearer <token>`
</details>

<details>
<summary><strong>GET /api/admin</strong></summary>

Purpose:
- Example admin-only resource.

Middleware:
- `admin`

Notes:
- Requires the authenticated user to have `role = admin`.
</details>

<details>
<summary><strong>GET /api/user</strong></summary>

Purpose:
- Example user-only resource.

Middleware:
- `user`

Notes:
- Requires the authenticated user to have `role = user`.
</details>

## Middleware Map
- `jwt`: `app/Http/Middleware/JWTMiddleware.php`
- `admin`: `app/Http/Middleware/AdminMiddleware.php`
- `user`: `app/Http/Middleware/UserMiddleware.php`

## Assumptions
- The `users` table (and User model) includes a `role` column with values such as `admin` or `user`.
