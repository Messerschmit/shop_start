<?php

class Cart {
    
    /*
     * Добавление товара в корзин/у 
     * @param integer $id
     * @return int
     */
    public static function addProduct($id){
        $id = intval($id);
        
        //Пустой массив для товаров в корзине
        $productsInCart = [];
        
        //Если в корзине уже есть товар с $id, они хранятся в сессии
        if (isset($_SESSION['products'])){
            //То заполнить массив товарами 
            $productsInCart = $_SESSION['products'];
        }
        
        //Если товар есть в корзине, но был добавлен еще раз, увеличить количество
        if (array_key_exists($id, $productsInCart)){
            $productsInCart[$id]++;
        }else{
            //Добавление нового товара в корзину
            $productsInCart[$id] = 1;
        }
        $_SESSION['products'] = $productsInCart;
        //echo '<pre>';print_r($_SESSION['products']);die();
        return self::countItem();
    }
    
    /*
     * Удаляем товары из корзины 
     * @param int $id
     * @return int 
     *      */
    public static function deleteProduct($id) {
        $id = intval($id);
        
        //Пустой массив для товаров в карзине
        $productsInCart = [];
        
        //Если в корзине уже есть товар с $id, они хранятся в сессии
        if (isset($_SESSION['products'])){
            
            $productsInCart = $_SESSION['products'];
        }
        
        //Если товар есть в корзине несколько раз, то удаляем 1 экземпляр        
        if ($productsInCart[$id] > 1){
            $productsInCart[$id]--;
        } else {
            unset($productsInCart[$id]);
        }
        
        //unset($productsInCart[$id]);
        
        $_SESSION['products'] = $productsInCart;
        //echo '<pre>';print_r($_SESSION['products']);die();
        return self::countItem();
    }
    
    /*
     * Подсчет количества товаров в корзине 
     * @return int
     */
    public static function countItem(){
        
        if(isset($_SESSION['products'])){
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count += $quantity;
            }
            return $count;
        }else{
            return 0;
        }
    }
    
    /*
     * Получаем массив товаров из корзины
     * @return array 
     */
    public static function getProducts(){
        if (isset($_SESSION['products'])){
            return $_SESSION['products'];
        }
        return false;
    }
    /*
     * Получаем сумму покупок 
     * @param array $products
     * @return int
     */
    public static function getTotalPrice($products) {
        
        $productsInCart = self::getProducts();
        
        $total = 0;
        
        if ($productsInCart){
            foreach ($products as $item) {
                $total +=$item['price']*$productsInCart[$item['id']]; 
            }
        }
        
        return $total;
    }
    
    /*
     * Очищает корзину;
     *      
     */
    public static function clear() {
        if (isset($_SESSION['products'])){
            unset($_SESSION['products']);
        }
    }
}
