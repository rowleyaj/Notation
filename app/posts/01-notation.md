
title: Notation
date: April 2013

------

Notation is a Markdown based blog written on top of Laravel 4. To get started cd to your installation directory and run the following:

	composer install

If you haven't got Composer installed then you'll need to grab that first. Then run:

	php artisan migrate

You'll also want to add a a user so you can login to the adming panel. You can do this by opening up `app/database/seeds/UserTableSeeder.php` and editing the user there. Then run the following in terminal:

	php artisan db:seed

You're all set! Go check out the [admin panel](/admin)