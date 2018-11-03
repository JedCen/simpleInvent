<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Dashboard config
    |--------------------------------------------------------------------------
    |
    | Here you can modify some aspects of your dashboard
    |
    */
    'dashboard' => [
        // Add custom list items to navbar's dropdown
        'navbar_items' => [
            'Sitio' => [
                'route'        => '/',
                'icon_class'   => 'fa fa-home',
                'target_blank' => false,
            ],
            'Logout' => [
                'route'      => 'logout',
                'icon_class' => 'fa fa-sign-out-alt',
            ],
        ],
        'widgets' => [
        ],
    ],

];