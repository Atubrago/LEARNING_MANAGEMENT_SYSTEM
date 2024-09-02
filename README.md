

## About Project
<b>This is a Learning Management System for SHS(AAMUSTED FINAL YEAR STUDENT PROJECT)</b>

<b>Authors</b>
<hr>
Brefo Enoch - 52010406172. <hr>
Akanaba Asamane Christopher - 52010406203.<hr>
Aboagye Akwasi - 52010406964.<hr>
 Owusu Prince - 5201040697<hr>

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
