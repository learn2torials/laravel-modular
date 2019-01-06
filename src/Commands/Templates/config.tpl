<?php

/*
|--------------------------------------------------------------------------
| [[module]] Module Configurations
|--------------------------------------------------------------------------
|
| Here you can add configurations that relates to your [[[module]]] module
| Only make sure not to add any other configs that do not relate to this
| [[module]] Module ...
|
*/
return [
    'menu_items' => [
        'admin_[[module_lower]]' => [
            'active' => '[[module_lower]]',
            'title'  => '[[module]]',
            'icon'   => 'fa fa-question'
        ]
    ],
    'middleware' => ['web', 'auth', 'admin']
];