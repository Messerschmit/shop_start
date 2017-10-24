<?php
//
//include_once ROOT.'/models/Category.php';
//include_once ROOT.'/models/Product.php';

class SiteController
{
     /*
    *Return the requsted page
    *@return bool
    */
    public function actionIndex()
    {
        $categories = [];
        $categories = Category::getCategoriesList();

        $latestProducts = [];
        $latestProducts = Product::getLatestProducts(6);

        require_once (ROOT.'/views/site/index.php');

        return true;
    }
}