<?php
/**
 * Абстрактный класс AdminBase определяет общую логику для контроллеров, 
 * которые используются в панели администратора
 */
abstract class AdminBase {
    
    /*
     * Метод определяем является ли пользователь админитратором 
     * @return boolean
     */
    public static function checkAdmin() {
       
        //Проверяем авторизирован ли пользователь, если нет то будет авторизация
        $userId = User::checkLogged();
        
        //Получаем информацию о текущем пользователе
        $user = User::getUserById($userId);
        
        //Если роль текущего пользователя 'admin', то пускаем его в панель
        if ($user['role'] == 'admin'){
            return true;
        }
        
        //Завершаем работу, соединение о закрытом доступе
        die('Access denied!');
    }
    
}
