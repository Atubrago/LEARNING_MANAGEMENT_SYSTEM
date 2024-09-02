

## About Project
This a Learning Management System for SHS

##Configuration
Run git clone repo

Run composer install (install composer beforehand)
From the projects root run cp .env.example .env
Configure your .env file, with:

DB_DATABASE=lms_2024
DB_USERNAME=root
DB_PASSWORD=root

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

Run php artisan key:generate

Run php artisan migrate

Run php artisan db:seed

php artisan storage:link

Start the Laravel server php artisan serve 

##Admin Login
username:admin@admin.com
password:password
