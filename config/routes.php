<?php

return array(
    'product/([0-9]+)' => 'product/view/$1', //actionView в ProductController
    'catalog' => 'catalog/index', //actionIndex CatalogController
    '' => 'site/index', //actionIndex в SiteController
);