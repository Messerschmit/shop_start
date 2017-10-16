<?php

return array(
    'product/([0-9]+)' => 'product/view/$1', //actionView в ProductController
    'category/([0-9]+)' => 'catalog/category/$1', //actionCategory CatalogController
    'catalog' => 'catalog/index', //actionIndex CatalogController
    '' => 'site/index', //actionIndex в SiteController
);