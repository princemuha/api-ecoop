# api-ecoop

api-ecoop is a Laravel-based RESTful API that powers the ecoop application. This repository contains the backend endpoints for managing products, users, orders, and related resources.

Owned by: batasi.d

## Features
- RESTful endpoints for resources (products, users, orders, categories).
- Authentication (API tokens / Laravel Sanctum — configured in project).
- Eloquent models and database migrations.
- Seeders for initial data.
- JSON responses and simple error handling.

## Requirements
- PHP 8.x
- Composer
- MySQL (or other supported DB)
- Flutter (for frontend/build tasks if used)

## Quick setup
1. Clone the repository:
   git clone <repo-url> api-ecoop
2. Install dependencies:
   composer install
3. Copy .env and set environment variables (DB, APP_KEY, etc.):
   cp .env.example .env
   php artisan key:generate
4. For migrations and seeders:
   sorry this is company secret
5. Serve the application:
   php artisan serve

(Refer to the code and route definitions for the full list of endpoints and required permissions.)

## Contributing
- Fork the repository, create a feature branch, and open a pull request.
- Follow existing code style and include tests where appropriate.

<!-- End of README -->

## Security Vulnerabilities
If you discover a security vulnerability within this project, please send an e-mail to me via [ibnumuha12@gmail.com](mailto:ibnumuha12@gmail.com). All security vulnerabilities will be promptly addressed.

