<?php

// Массив с путями (роутами)

return [
    // Order
    'order/view/([0-9]+)' => 'order/view/$1', // actionView в OrderController
    'order/create' => 'order/create', // actionCreate в OrderController
    'order/list' => 'order/list', // actionList в OrderController
    // Basket
    'basket/add/([0-9]+)' => 'basket/add/$1', // actionAdd в BasketController
    'basket/index' => 'basket/index', // actionIndex в BasketController
    'basket' => 'basket/index', // actionIndex в BasketController
    // Good
    'goods/view/([0-9]+)' => 'goods/view/$1', // actionView в GoodController
    // Cabinet
    'cabinet/index' => 'cabinet/index', //actionIndex в CabinetController
    'cabinet' => 'cabinet/index', //actionIndex в CabinetController
    // User
    'user/registration' => 'user/registration', //actionRegistration в UserController
    'user/login' => 'user/login', //actionLogin в UserController
    'user/logout' => 'user/logout', //actionLogin в UserController
    // AdminOrder
    'admin/order/update' => 'adminOrder/update', //actionIndex в AdminOrderController
    'admin/order/index' => 'adminOrder/index', //actionIndex в AdminOrderController
    'admin/order' => 'adminOrder/index', //actionIndex в AdminOrderController
    // Admin
    'admin/index' => 'admin/index', //actionIndex в AdminController
    'admin' => 'admin/index', //actionIndex в AdminController
    // Главная страница
    'index' => 'site/index', // actionIndex в SiteController
    '(.)+' => 'site/error', // actionError в SiteController
    '' => 'site/index', // actionIndex в SiteController
];
