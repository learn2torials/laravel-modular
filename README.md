# Laravel Modular App Plugin

[![Laravel](https://img.shields.io/badge/laravel-5-orange.svg)](http://laravel.com)
[![Release](https://poser.pugx.org/learn2torials/laravel-modular/v/stable)](https://github.com/learn2torials/laravel-modular/releases)
![Issues](https://img.shields.io/github/issues/learn2torials/laravel-modular.svg)
![Licence](https://img.shields.io/github/license/learn2torials/laravel-modular.svg)

Turn your existing laravel app into modular application. Laravel modular plugin allows you to write modular plugins for laravel.

Let's say, you are building a blog application. Your blog needs to have following features:

- comments
- blog post
- user management etc..

You can turn this features into a module and bundle your logic so that you can easily use this module for your other projects. You can easily turn on/off your module.

# Plugin Requirements

- PHP >= 7.2
- Laravel >= 6.0

# Newer Laravel Plugin
For older version >= 8.0 of Laravel use this plugin [Modular Laravel](https://packagist.org/packages/learn2torials/modular-laravel)


# How to install this plugin

Run following command to your existing project.

```

# install this plugin
composer require "learn2torials/laravel-modular"

# create module using artisan
php artisan make:module comments
```

Above command will create a new directory under App/Modules with following structure.

```
App
|- Modules
   |-- Comments
      |-- Controllers
      |-- Models
      |-- Views
      |-- Migrations
         |-- Seeder
      |-- Translations
         |-- en
             |-- general.php
         |-- fr
             |-- general.php
      |-- config.php
      |-- routes.php
```

Next, once this folder structure is generated you can turn on this module by creating console.php file in _config_ directory.

```
<?php

/*
|--------------------------------------------------------------------------
| Configuration File
|--------------------------------------------------------------------------
|
| You can overwrite default configuration here according to your app requirements.
|
*/
return [
    "prefix"   => null,
    "i18n"     => false,
    "https"    => false,
    "modules"  => [
        "comments" => true
    ]
];
```

That is it, your module is now enabled. You can verify that your module is working by browsing

```
http://yourdomain.com/comments
```

### Add prefix before all your modules. Set following config in _config/console.php_ file.

```
"prefix" => "admin",
```

Now, your module url will be:

```
http://yourdomain.com/admin/comments
```

### Enable translation for you module. Set following config in _config/console.php_ file.

```
"i18n" => true,
```

Now, your module url will be:

```
http://yourdomain.com/en/ca/comments      -> for english translation
http://yourdomain.com/fr/ca/comments      -> for french translation
```

### When prefix is enabled

```
http://yourdomain.com/en/ca/admin/comments -> if prefix is admin
http://yourdomain.com/fr/ca/admin/comments -> if prefix is admin
```

How to use translations. Check your view file in your module to get the idea of usage:

```
{{ __('module::file_name.translation_key') }}
```

### Module Configurations

Once module is enabled you can access module related configurations using following syntax.

For example: if you have installed a user module. Configuration file for user module is located in _Modules/User/config.php_

```
<?php

/*
|--------------------------------------------------------------------------
| User Module Configurations
|--------------------------------------------------------------------------
|
| Here you can add configurations that relates to your [User] module
| Only make sure not to add any other configs that do not relate to this
| User Module ...
|
*/
return [

    // module name
    'name' => 'User',

    // register middleware
    'middleware' => [
        'user' => \App\Modules\User\Middleware\UserAuthenticated::class,
    ],

    // register service providers
    'providers' => [
        \App\Modules\User\Provider\UserProvider::class
    ],

    // register route middleware
    'route_middleware' => ['user'],

    // database seeder
    'seeder' => [
        __DIR__. '/Migrations/Seeder/UsersTableSeeder.php'
    ]
];
```

### How to run module migration/seeder

To run migration or seeder for your modules. Add seeder to config file and run following commands.

```

# run module migrations
php artisan migrate

# run module seeders
php artisan db:seed --class="L2T\Database\Seeder"
```

# Reference

Example is shown on [https://learn2torials.com/a/laravel-module-management](https://learn2torials.com/a/laravel-module-management)
