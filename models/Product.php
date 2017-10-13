<?php


class Product
{
    const SHOW_BY_DEFAULT = 10;


    /**
     * @param int $count
     * Return an array of latest products from database
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

        $query = 'SELECT id, name, price, image, is_new FROM product WHERE status = "1" ORDER BY id DESC LIMIT '.$count;

        $result = $db->query($query);

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
}