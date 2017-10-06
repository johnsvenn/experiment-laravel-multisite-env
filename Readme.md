Test for a multisite / themed approach for a Laravel site
=========================================================

Aims
----

- Create a theme system so that we can serve multiple 'sites' (domains) with a single set of code
- Each 'site' has it's own datbase
- Allow custom templates for each 'site' but if a custom template doesn't exist fall back and use the default template
- Use a different .env file for each 'site' to allow customisation 

Caveats
-------

There are already packages for themeing / multisite where the configuation is stored in the database and which could be used as the basis for adding new sites dynamically e.g. https://github.com/appstract/laravel-multisite

This is a different approach and is specifically not about being able to add sites dynamically

Setup
-----

We are going to create 3 sites e.g.

1. t1.example.com
2. t2.example.com
3 .t3.example.com

Each site will have it's vhost config but they will all share the same server 'root' directory (a single set of code)


Create a new laravel site e.g. `laravel new t1.example.com`

Genenerate a key `php artisan key:generate`

Edit and setup your `.env` file as normal

Rename and then copy your `.env` file for each 'site' e.g. `.env.t1`, `.env.t2`, `.env.t3`

Edit the files updating credentials and adding a new variable 'SITE_KEY' - this is a unique id for your 'site', it will be loaded into config and so accessed within your application. It is also the name of the directory used to store overloaded views.

```
APP_NAME='Site 1'
APP_ENV=local
APP_KEY=base64:b5NiRQV1i1f2Azc+QTZVyEbMj+rGvLl6Rr75BuMfRkc=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://t1.example.com

SITE_KEY=site1

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=t1       
DB_USERNAME=homestead
DB_PASSWORD=secret

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
```

```
APP_NAME='Site 2'
APP_ENV=local
APP_KEY=base64:b5NiRQV1i1f2Azc+QTZVyEbMj+rGvLl6Rr75BuMfRkc=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://t2.example.com

SITE_KEY=site1

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=t2       
DB_USERNAME=homestead
DB_PASSWORD=secret

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
```

Custom .env files
-----------------

(see the code)

Create and edit  /config/sites.php

We need to get Laravel to load different .env files based on the environment - so edit /bootstrap/app.php

Edit /resources/views/welcome.blade.php so we can confirm which .env file we are using

You can test this by visiting the various URLs you've defined and they will show that they are using different configs.

Site based view overloading
---------------------------

(see the code)

Create a new ViewServiceProvider that allows us to update the view.paths

Update /config/app.php to use the new Service Provider

Create /resources/site-views/ and then a directory for each 'site' - this is where we store the views templates that we want to customise between sites.

Copy welcome.blade.php into each of these sites and customise so you can test

Create some further test routes and files

Notes
-----

It is possible to specify a datbase to use when using `php artisan migrate` e.g. `DB_DATABASE=t2 php artisan migrate`

It doesn't appear to be possible to specify a `.env` file to use when running command like `php artisan key:generate` which is a shame (need to investigate further). It is possible to specify and environment using `--env=production` etc. but this is not the same - in this scenario we might have 'production' environments for each 'site'.







