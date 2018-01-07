<?php

/**
 * class User - processes requests from UserController
 *
 */
class User 
{
    /*

     * Registering new user
     * @param string $name - user name
     * @param string $email - user email
     * @param string $password - user password
     * return bool
     *      
    */
    public static function register($name, $email, $password) 
    {
        try {
    
            $db = Db::getConnection();
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        
        $query = 'INSERT INTO user (name, email, password) VALUES (:name, :email, :password)';
        
        $result = $db -> prepare($query);
        $result ->bindParam(':name', $name, PDO::PARAM_STR);
        $result ->bindParam(':email', $email, PDO::PARAM_STR);
        $result ->bindParam(':password', $password, PDO::PARAM_STR);
        
        return $result ->execute();
    }
    
    /*
     * Checking the data was entered
     * @param string $name - user name
     * @return bool
     */
    public static function checkName($name) {
        if (strlen($name)>=2){
            return true;
        }
        return false;
    }
    
    /*
     * Checking the data was entered
     * @param string $phone
     * @return bool
     */
    public static function checkPhone($phone) {
        if (strlen($phone)>=6){
            return true;
        }
        return false;
    }    
    
    /*
     * Checking the data was entered
     * @param string $email - user email
     * @return bool
    */
    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }
    
    /*
     * Checking the data was entered
     * @param string $password - user password
     * @return bool
    */
    public static function checkPassword($password) {
        if (strlen($password)>=6){
            return true;
        }
        return false;
    }
    
    /*
     * Verifies the presence of a registered user 
     * @param string $email - user email
     * @return bool     
    */
    public static function checkEmailExists($email){
        try {
            
            $db = Db::getConnection();
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        
        $query = 'SELECT COUNT(*) FROM user WHERE email = :email';
        
        $result = $db -> prepare($query);
        $result ->bindParam(':email', $email, PDO::PARAM_STR);
        $result ->execute();
        
        if ($result ->fetchColumn()){
            return true;
        }

        return false;
    }
    
    public static function checkUserData($email, $password)
    {
        try {
            
            $db = Db::getConnection();
            
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';
        
        $result = $db ->prepare($sql);
        $result ->bindParam(':email', $email, PDO::PARAM_INT);
        $result ->bindParam(':password', $password, PDO::PARAM_INT);
        $result ->execute();
        
        $user = $result ->fetch();
        if($user){
            return $user['id'];
        }
        
        return false;
    }
    
    /*
     * Возвращает пользователя по id 
     * @param $id integer 
     */
    public static function getUserById($id) {
        if ($id){
            try {
            
                $db = Db::getConnection();
            
            } catch (PDOException $exc) {
                echo $exc->getMessage();
            }
            
            $sql = 'SELECT * FROM user WHERE id = :id';
            
            $result = $db->prepare($sql);
            $result->bindParam(':id',$id, PDO::PARAM_INT);
            
            //Указываем, что хотим получить данные в виде массив
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            
            return $result->fetch();
        }
    }
    
    /*
     * Редактирует данные пользователя
     * @param integer $userId
     * @param string $name
     * @param string $password
     */
    public static function edit($userId, $name, $password) {
        try {
            
            $db = Db::getConnection();
            
        } catch (PDOException $exc) {
            
            echo $exc->getMessage();
        }
        
        $sql = 'UPDATE user set name = :name, password = :password WHERE id = :id';
        
        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        
        return $result->execute();
    }

    /*
     * Запоминаем пользователя 
     * @param $userId int
     *
     */
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    /*
     * Проверка зашел ли на сайт пользователь, 
     * если нет перемещает на страницу Входа
     * 
     */
    public static function checkLogged()
    {
        //Если сессия есть, возвращаем идентификатор пользователя
        if (isset($_SESSION['user'])){
            return $_SESSION['user'];
        }
        header ("Location: /user/login");
    }
    
    /*
     * Проверка авторизирован ли пользователь или  
     * зашел как гость
     */
    public static function isGuest(){
        if (isset($_SESSION['user'])){
            return false;
        }
        return true;
    }
    
    
    
    
}
