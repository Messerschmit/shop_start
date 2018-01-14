<?php

class Product
{
    const SHOW_BY_DEFAULT = 6;


    /**
     * @param int $count
     * Returns an array of latest products from database
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);
        try{

            $db = DB::getConnection();

        }catch (PDOException $e){

            $e->getMessage();
        }

        $productsList = [];

        $query = 'SELECT id, name, price, image, is_new FROM product WHERE'
                    .' status = "1" ORDER BY id DESC LIMIT '. $count;

        $result = $db -> query($query);

        $i = 0;

        while($row = $result->fetch()){
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['image'] = $row['image'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productsList;
    }
    /*
     * Получаем список всех товаров
     * @return array $productList
     */
    public static function getProductsList()
    {
        try {
            
            $db = Db::getConnection();
            
        } catch (PDOException $exc) {
            
            echo $exc->getMessage();
        }
        
        $sql = "SELECT * FROM product ORDER BY id ASC";
        
        $result = $db->query($sql);
        
        $productList = [];
        
        $i = 0;
        
        while( $row = $result->fetch() ){
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['category_id'] = $row['category_id'];
            $productList[$i]['code'] = $row['code'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['availability'] = $row['availability'];
            $productList[$i]['brand'] = $row['brand'];
            $productList[$i]['image'] = $row['image'];
            $productList[$i]['description'] = $row['description'];
            $productList[$i]['is_new'] = $row['is_new'];
            $productList[$i]['is_recomended'] = $row['is_recomended'];
            $productList[$i]['status'] = $row['status'];
            
            $i++;
        }
        
        return $productList;
    }

        /**
     * Returns the required products list by category_id
     * @param $categoryId
     * @return array
     */
    public static function getProductsListByCategory($categoryId, $page = 1)
    {
        if ($categoryId){

            try{

                $db = DB::getConnection();

            }catch (PDOException $e){

                $e -> getMessage();

            }

            $page = intval($page);
            $offset = ($page-1)*self::SHOW_BY_DEFAULT;

            $products = [];

            $query = 'SELECT id, name, price, image, is_new FROM product WHERE status = 1 and category_id = '
                .$categoryId .' ORDER BY id DESC LIMIT '. self::SHOW_BY_DEFAULT. ' OFFSET '.$offset;

            $result = $db -> query($query);

            $i = 0;

            while($row = $result->fetch()){
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['image'] = $row['image'];
                $products[$i]['is_new'] = $row['is_new'];

                $i++;
            }

            return $products;
        }

    }


    /**
     * Returns the requested product by id
     * @param $productId
     * @return mixed
     */
    public static function getProductById($productId)
    {
        $id = intval($productId);

        if ($id){

            try{

                $db = Db::getConnection();

            }catch (PDOException $e){
                $e -> getMessage();
            }

            $query = 'SELECT * FROM product WHERE id = ' . $id;

            $result = $db -> query($query);

            $result -> setFetchMode(PDO::FETCH_ASSOC);

            return $result -> fetch();

        }
    }
    
    /*
     * Получаем данные продуктов по Id-м
     * @param array $idArray
     * @return array
     */
    public static function getProductsByIds($idArray) {
        
        $products = [];
        
        try {
    
            $db = Db::getConnection();
            
        } catch (PDOException $exc) {
            
            echo $exc->getMessage();
        }
        
        $idsString = implode(',', $idArray);
        
        //echo $idsString;
        
        $sql = "SELECT * FROM product WHERE status = '1' AND id IN ($idsString)";
        
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
    
        $i = 0;
        
        while ($row = $result->fetch()){
            //echo '<pre>';print_r($row);echo '</pre>';
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        //echo '<pre>';print_r($products);echo '</pre>';
        return $products;
    }
    
    /*
     * Получаем данные рекомендованных продуктов
     * 
     * @return array 
     */
    public static function getRecomendedProducts(){
        
        $products = [];
                
        try {
            
            $db = Db::getConnection();
            
        } catch (PDOException $exc) {
            
            echo $exc->getMessage();
        }
        
        $sql = "SELECT * FROM product WHERE is_recomended = '1' AND status = '1'";
        
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        
        while ($row = $result->fetch()){
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['image'] = $row['image'];
            $i++;
        }
        
        return $products;
            
    }

        
    public static function getTotalProductsInCategory($categoryId)
    {
        try {
            
            $db = Db::getConnection();
            
        } catch (PDOException $exc) {
            
            echo $exc->getMessage();
        }
        
        $query = 'SELECT count(id) as count FROM product'
                .' WHERE status = "1" AND category_id ="'. $categoryId.'"';
        
        $result = $db -> query($query);
        
        $result -> setFetchMode(PDO::FETCH_ASSOC);
        
        $row = $result -> fetch();
        
        return $row['count'];
    }
}