# Sistem Informasi Cuti Karyawan

## Installation

- Run `composer install && npm install && npm run prod`
- Copy `.env.example` to `.env`
- Configure database connection in `.env`
- Run `php artisan migrate  --force && php artisan db:seed --force`