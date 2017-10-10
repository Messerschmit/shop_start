<?php

include_once ROOT.'/models/Category.php';

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
        require_once (ROOT.'/views/site/index.php');

        return true;
    }
}