<?php


class ProductController
{
     /*
    *Return the requsted page
    *@return bool
    */
    public function actionView()
    {
        require_once (ROOT.'/views/product/view.php');

        return true;
    }
}