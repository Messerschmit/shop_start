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
    'contacts' => 'site/contact', //actionContact в SiteController
    'cart/add/([0-9]+)' => 'cart/add/$1', //actionAdd в CartController
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', //actionAdd в CartController
    'cart/checkout' => 'cart/checkout', //actionCheckout в CartController
    'cart/delete/([0-9]+)' => 'cart/delete/$1', //actionDelete в CartController
    'cart' => 'cart/index', //actionIndex в CartController
    'admin/adminProduct' => 'adminProduct/index', //actionIndex в AdminProductController
    'admin' => 'admin/index', //actionIndex в AdminController
    '' => 'site/index', //actionIndex в SiteController
);