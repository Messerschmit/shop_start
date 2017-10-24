<?php

return array(
    'product/([0-9]+)' => 'product/view/$1', //actionView в ProductController
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', //actionCategory CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', //actionCategory CatalogController
    'catalog' => 'catalog/index', //actionIndex CatalogController
    'user/register' => 'user/register', //actionRegister UserController
    '' => 'site/index', //actionIndex в SiteController
);