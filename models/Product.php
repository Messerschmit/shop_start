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
}