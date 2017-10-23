<?php


class Category
{
    /*
     *
     * Return categoryList from database
     *
     * */
    public static function getCategoriesList()
    {
        try{

            $db = Db::getConnection();

        }catch (PDOException $e){

            echo $e->getMessage();
        }

        $categoryList = [];

        //$query = 'SELECT * FROM category ORDER by sort_order ASC';
        $query = 'SELECT id, name FROM category ORDER by sort_order ASC';

        $result = $db->query($query);

        $i = 0;

        while($row = $result->fetch()){
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }

        return $categoryList;

    }
}