<?php

/**
 * UserController class processes user requests
 *
 */
class UserController 
{
    /*
     * Processes user registration requests  
     * @return true
     */
    public function actionRegister()
    {
        require_once (ROOT.'/views/user/register.php');
        
        return true;
    }
    
}
