<?php

class AdminProductController extends AdminBase{
    
    public function actionIndex() {
        
        //проверка пользователя
        self::checkAdmin();
        
        //Получаем список товаров
        $productList = [];
        $productList = Product::getProductsList();
        
        //Вид
        include_once (ROOT.'/views/admin/admin_product/index.php');
        return true;              
    }
    
}
