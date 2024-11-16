<?php

return [

    [
        'text' => 'Главная',
        'icon' => 'fas fa-fw fa-home',
        'route' => '/',
// EXAMPLE submenu
//        'submenu' => [
//            [
//                'text' => 'Наш подход',
//                'route' => '/',
//                'icon' => 'fa-fw fa-fw fa-comments-dollar'
//            ],
//        ],
    ],
    [
        'text' => 'Пользователи',
        'route' => 'backend.user.index',
        'icon' => 'fa-fw fa-user',
    ],
    [
        'text' => 'Страницы',
        'route' => 'backend.page.index',
        'icon' => 'fa-fw fa-bars',
    ],
];
