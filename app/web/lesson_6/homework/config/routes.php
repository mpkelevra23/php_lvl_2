<?php

// Массив с путями (роутами)

return [
    // Cabinet
    'cabinet/index' => 'cabinet/index', //actionIndex в CabinetController
    'cabinet' => 'cabinet/index', //actionIndex в CabinetController
    // User
    'user/registration' => 'user/registration', //actionRegistration в UserController
    'user/login' => 'user/login', //actionLogin в UserController
    'user/logout' => 'user/logout', //actionLogin в UserController
    // Главная страница
    'index' => 'site/index', // actionIndex в SiteController
    '(.)+' => 'site/error', // actionError в SiteController
    '' => 'site/index', // actionIndex в SiteController
];
