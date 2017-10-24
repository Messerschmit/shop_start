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
     * Checking the data which was entered
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
     * Checking the data which was entered
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
     * Checking the data which was entered
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
    
    
    
}
