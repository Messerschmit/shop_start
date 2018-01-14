<?php

class AdminController extends AdminBase{
    
    public function actionIndex() {
        //Проверка доступа
        self::checkAdmin();
        
        //Подключаем вид
        include_once (ROOT.'/views/admin/index.php');
        
        return true;
    }    
}
