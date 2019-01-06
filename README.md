# Laravel Modular App Plugin

This plugin makes your existing laravel application into modular application. Followings are some of the feature of this plugin.

- i18n/translation support
- dynamic module generation
- turn on/off modules for your app

# Plugin Requirements

- PHP >= 7.1.3
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension

# How to install this plugin

Run following command to your existing project.

```
composer install "learn2torials/laravel-modular"
```

# How to use this plugin

Once you installed composer dependency you will be able to create dynamic modular app with your existing laravel app. Example: if you are creating a new app and you want to write your code in such a way so that you can easily turn on/off your modules.

Let say, you are building a blog application. You blog needs to have following features:

- comments
- blog post
- user management etc..

You can turn this features into a module and bundle your logic so that you can easily use this module for your other projects. To create a module use following command in your terminal window.

```
php artisan make:module comments
```

Above command will create a new directory under App/Modules with following structure.

App
|- Modules
|-- Comments
|-- Controllers
|-- Models
|-- Views
|-- Migrations
|-- Translations
|-- en
|-- general.php
|-- fr
|-- general.php
|-- config.php
|-- routes.php

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

That is it, your module is now enabled. You can verify that your module is working by browsing http://yourdomain.com/comments

# Other configurations

To enable i18n or language feature in your app set:

```
"i18n" => true,
```

To add prefix before all your modules set:

```
"prefix" => "admin",
```

To force all http routes to https set:

```
"https" => true,
```

# What is i18n feature?

Once you turned on this feature you can easily translate your module
