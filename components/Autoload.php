<?php

/*
 *override function autoload files
 * 
 *  @param string $class_name - name of class
 *  @return bool;
 */
function __autoload($class_name) 
{
    #list all the class directories in the array
    $array_paths = ['/models/', '/components/'];
    
    foreach ($array_paths as $path) {
        $path = ROOT.$path.$class_name.'.php';
        if (is_file($path)){
            include $path;
        }
    }
    return true;
}
