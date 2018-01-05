<?php

return array(
    'product/([0-9]+)' => 'product/view/$1', //actionView в ProductController
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', //actionCategory CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', //actionCategory CatalogController
    'catalog' => 'catalog/index', //actionIndex CatalogController
    'user/register' => 'user/register', //actionRegister UserController
    'user/login' => 'user/login', //actionLogin UserController
    'user/logout' => 'user/logout', //actionLogout UserController
    'cabinet/edit' => 'cabinet/edit', //actionEdit CabinetController
    'cabinet' => 'cabinet/index', //actionIndex CabinetController
    '' => 'site/index', //actionIndex в SiteController
);