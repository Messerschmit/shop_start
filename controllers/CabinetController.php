<?php


/**
 * Manages user data 
 *
 */
class CabinetController 
{
    
    public function actionIndex() 
    {
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        //echo '<br>'.'<pre>';print_r($user); echo '</pre>'; 
        require_once (ROOT.'/views/cabinet/index.php');
        return true;
    }
    
    public function actionEdit(){
        
        //Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();
        
        //Получаем идентификатор о пользователи из БД
        $user = User::getUserById($userId);
        
        $name = $user['name'];
        $password = $user['password'];
        
        $result = false;
        
        if (isset($_POST['submit'])){
            $name = $_POST['name'];
            $password = $_POST['password'];
            
            $errors = false;
            
            if(!User::checkName($name)){
                $errors[] = 'Имя не должно быть короче 2х символов';
            }
            
            if (!User::checkPassword($password)){
                $errors[] = 'Пароль не должен быть короче 6ти символов';
            }
            
            if ($errors == false){
                $result = User::edit($userId, $name, $password);
            }
        }
        
        require_once (ROOT.'/views/cabinet/edit.php');
        
        return true;
    }
}