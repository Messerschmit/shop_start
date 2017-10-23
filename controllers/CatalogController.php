<?php

include_once ROOT.'/models/Category.php';
include_once ROOT.'/models/Product.php';

class CatalogController
{


    /**
     * Returns the requsted page (index)
     * @return bool
     */
    public static function actionIndex()
    {
        $categories = [];
        $categories = Category::getCategoriesList();

        $latestProducts = [];
        $latestProducts = Product::getLatestProducts(5);

        require_once ROOT.'/views/catalog/index.php';

        return true;
    }


    /**
     * Return the requsted page with Products List By Category
     * @param $categoryId
     * @return bool
     */
    public static function actionCategory($categoryId, $page = 1)
    {

        $categories = [];
        $categories = Category::getCategoriesList();

        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);

        require_once (ROOT.'/views/catalog/category.php');

        return true;
    }
}