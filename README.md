Product Development Backend

-> Project setup

composer install --ignore-platform-reqs
create .env  file
php artisan key:generate

-> Compiles for development

php artisan migrate || php artisan migrate:fresh 
php artisan db:seed

php artisan serve
# team-portfolio-backend
