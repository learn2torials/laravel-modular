# Laravel Modular App Plugin

Turn your existing laravel app into modular application. Laravel modular plugin allows you to write modular plugins for laravel.

Let say, you are building a blog application. You blog needs to have following features:

- comments
- blog post
- user management etc..

You can turn this features into a module and bundle your logic so that you can easily use this module for your other projects. You can easily turn on/off your module.


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

# install this plugin
composer install "learn2torials/laravel-modular"

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
|-- Translations
    |-- en
        |-- general.php
    |-- fr
        |-- general.php
|-- config.php
|-- routes.php
```

Next, once this folder structure is generated you can turn on this module by creating console.php file in *config* directory.

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

http://yourdomain.com/comments


### Add prefix before all your modules. Set following config in *config/console.php* file.

```
"prefix" => "admin",
```

Now, your module url will be: 

http://yourdomain.com/admin/comments


### Enable translation for you module. Set following config in *config/console.php* file.

```
"i18n" => true,
```

Now, your module url will be: 

http://yourdomain.com/en/ca/comments      -> for english translation
http://yourdomain.com/fr/ca/comments      -> for french translation

### When prefix is enabled

http://yourdomain.com/en/ca/admin/comments -> if prefix is admin
http://yourdomain.com/fr/ca/admin/comments -> if prefix is admin


How to use translations. Check your view file in your module to get the idea of usage:
```
{{ __('module::file_name.translation_key') }}
```

# Reference

Visit my website for cool articles: https://learn2torials.com
