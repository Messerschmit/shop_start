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
    
    public function actionCheckout() {
        
        //Получаем список категорий
        $categories = [];
        $categories = Category::getCategoriesList();
        
        //Статус успешного оформления заказа
        $result = false;
        
        //Форма отправлена?
        if (isset($_POST['submit'])){
            //Форма отправлена? Да
            
            //Считываем данные формы
            $userName = $_POST['userName'];
            $userPhone = $_POST['userPhone'];
            $userComment = $_POST['userComment'];
            
            //Валидация полей
            $errors = false;
            
            if (!User::checkName($userName)){
                $errors[] = 'Неправильное имя';
            }
            
            if (!User::checkPhone($userPhone)){
                $errors[] = 'Неправильный номер телефона';
            }
            
            //Форма заполнена корректно?
            if ($errors == false){
                //Форма заполнена корректно? Да
                //Сохраняем заказ в БД
                
                //Собираем данные о заказе
                $productsInCart = Cart::getProducts();
                
                if (User::isGuest()){
                    $userId = false;
                }else{
                    $userId = User::checkLogged();
                }
                
                //Сохраняем заказ в БД
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);
                echo $result.'<br>';
                
                //Оповещаем адмнистратора о новом заказе
                if ($result){
                    $adminEmail = 'kasatkin87@i.ua';
                    $message = '/admin/orders';
                    $subject = 'Новый заказ';
                    mail($adminEmail, $subject, $message);
                }
                
                Cart::clear();
            }
        }else{
            //Форма отправлена? Нет
            
            //Получаем данные из корзины
            $productsInCart = Cart::getProducts();
            
            //В корзине есть товары?
            if ($productsInCart == false){
                //В корзине нет товаров - отправляем на главную страницу
                header("Location: /");
            }else{
                //В корзине есть товары.
                //Итоги: общая стоимость, количество товаров
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItem();
                
                $userName = false;
                $userPhone = false;
                $userComment = false;
                
                //Пользователь авторизирован?
                if(User::isGuest()){
                    //Нет - значение для формы пустые
                }else{
                    //Да, авторизирован
                    //Получаем данные пользователя из БД по id
                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);
                    $userName = $user['name'];    
                }
            }
        }
        
        require_once(ROOT.'/views/cart/checkout.php');
        
        return true;
    }
    
    public function actionDelete($id){
        Cart::deleteProduct($id);
        //Перенаправляем в корзину
        header("Location: /cart/");
    }
}
