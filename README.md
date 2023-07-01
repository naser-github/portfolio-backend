Team-portfolio-backend

This is portfolio-type website. One can add info about their team their achievements, technologies & other tasks

This project is developed using:
Laravel (framework),
Mysql (Database)

-> Project setup
composer install --ignore-platform-reqs
create .env file
php artisan key:generate

-> Compiles for development

php artisan migrate || php artisan migrate:fresh
php artisan db:seed

php artisan serve


