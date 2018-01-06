<?php

class CartController {
    
    public function actionAdd($id) {
        
        //Добавляем товар в корзину
        Cart::addProduct($id);
        
        //Перенапраялем пользователя на страницу с которой пришел
        $reffer = $_SERVER['HTTP_REFERER'];
        echo $reffer;
        header("Location: $reffer");
    }
    
    public function actionAddAjax($id) {
        
        //Добавляем товар в корзину
        echo Cart::addProduct($id);
        return true;
    }
    
    public function actionIndex() {
        //Получаем список категорий
        $categories = [];
        $categories = Category::getCategoriesList();
        
        $productsInCart = false;
        
        //Получаем данные из корзины
        $productsInCart = Cart::getProducts();
        
        if($productsInCart){
            //Получаем полную информацию о товарах для списка
            $productsIds = array_keys($productsInCart);
            $products = Product::getProductsByIds($productsIds);
            
            //Получаем общую стоимость товаров
            $totalPrice = Cart::getTotalPrice($products);
        }
        
        require_once (ROOT.'/views/cart/index.php');
        
        return true;
        
    }
}
