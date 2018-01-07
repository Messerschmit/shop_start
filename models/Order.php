<?php

class Order {
    
    /*
     * Сохраняет заказ пользователя в БД 
     * @param string $userName
     * @param string $userPhone
     * @param string $userComment
     * @param int $userId
     * @param array $products
     * 
     *      */
    public static function save($userName, $userPhone, $userComment, $userId, $products) {
        
        $products = json_encode($products); 
        
        try {
            
            $db = Db::getConnection();
            
        } catch (PDOException $exc) {
        
            echo $exc->getMessage();
        }
        
        $sql = "INSERT INTO product_order (userName, userPhone, userComment, user_id, products) VALUES (:userName, :userPhone, :userComment, :user_id, :products)";
        
        $result = $db->prepare($sql);
        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':userPhone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':userComment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':products', $products, PDO::PARAM_STR);
        
        return $result->execute();
        //echo 'Заказ сохранен';
        
    }
}
