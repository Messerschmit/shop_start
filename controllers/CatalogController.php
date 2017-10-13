<?php

include_once ROOT.'/models/Category.php';
include_once ROOT.'/models/Product.php';

class CatalogController
{


    /**
     * Returns the requsted page
     * @return bool
     */
    public static function actionIndex()
    {
        $categories = [];
        $categories = Category::getCategoriesList();

        $latestProducts = [];
        $latestProducts = Product::getLatestProducts(10);

        require_once ROOT.'/views/catalog/index.php';

        return true;
    }
}