<?php

/**
 * UserController class processes user requests
 *
 */
class UserController 
{
    /*
     * Processes user registration requests  
     * @return true
     */
    public function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';
        $result = false;
        
        if (isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
        }
        
        $errors = false;
        
        //проверка валидности формы
        if(!User::checkName($name)){
            $errors[] = 'Имя не должно быть короче 2х  символов';
        }
        
        if(!User::checkEmail($email)){
            $errors[] = 'Неправильный email';            
        }
        
        if(!User::checkPassword($password)){
            $errors[] = 'Пароль не должно быть короче 6ти символов';
        }
        
        if(User::checkEmailExists($email)){
            $errors[] = 'Пользователь с таким email уже существует'; 
        }
        
        if ($errors == false){
            $result = User::register($name, $email, $password);
        }
        
        require_once (ROOT.'/views/user/register.php');
      
        return true;
    }
    
    public function actionLogin() {
        $email = '';
        $password = '';
        
        if (isset($_POST['submit'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = false;
            
            //проверка валидности формы
            if (!User::checkEmail($email)) {
               $errors[] = 'Неправильный email';
            }
                
            if(!User::checkPassword($password)){
                $errors[] = 'Пароль не должно быть короче 6ти символов';
            }
                
                //Проверка существует ли пользователь
                $userId = User::checkUserData($email, $password);

                if($userId == false){
                    $errors[] = 'Неправильные данные пользователя';
                }else{
                    //если данные правильные записываем пользователя в сессию
                    User::auth($userId);
                    //перенаправляем в персональный кабинет
                    header("Location: /cabinet/");
                }
            }
            

        
        require_once (ROOT.'/views/user/login.php');
        
        return true;
    }
    
    public function actionLogout() {
        unset($_SESSION['user']);
        header("Location: /");
    }
    
}
