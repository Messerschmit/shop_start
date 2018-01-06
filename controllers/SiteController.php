<?php

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
    
    public function actionContact() {
        $userEmail = '';
        $userText = '';
        $result = false;
        
        if (isset($_POST['submit'])){
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];
            
            $errors = false;
            
            //Валидация полей
            if (!User::checkEmail($userEmail)){
                $errors = 'Неправильный адрес почты';
            }
            
            if ($errors = false){
                $adminEmail = 'admin@localhost';
                $message = "Текст: {$userText}. От: {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }
        
        include_once (ROOT.'/views/site/contact.php');
        
        return true;
    }
}