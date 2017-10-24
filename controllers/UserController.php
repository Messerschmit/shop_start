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
    
}
