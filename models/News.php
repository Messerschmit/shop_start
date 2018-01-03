<?php

class News
{
    /*
     * Rerurns single news item with specified id
     *@param integer @id
     * */
    public static function getNewsItemById($id)
    {
        $id = intval($id);
        if ($id){

            $host = 'localhost';
            $dbname = 'mvc_site';
            $user = 'root';
            $password = 'root';
            try{
                $db = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

                $result = $db->query('SELECT * FROM news WHERE id =' . $id) or die ("Error DB Connect!");

                $result->setFetchMode(PDO::FETCH_ASSOC);

                $newsItem = $result->fetch();
            }catch (PDOException $e){
                $e->getMessage();
            }


            return $newsItem;
        }
    }


    /*
     * Returns an array of news items
     *
     * */
    public static function getNewsList(){

        $host = 'localhost';
        $dbname = 'mvc_site';
        $user = 'root';
        $password = 'root';
        try {
            $db = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            print_r($db);
            $newsList = array();

            $result = $db->query('SELECT * FROM news');
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        $i = 0;

        while($row = $result->fetch()){
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $i++;
        }

        return $newsList;
    }
}