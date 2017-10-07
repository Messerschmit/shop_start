<?php

//require_once (ROOT.'/controllers/SiteController.php');

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include ($routesPath);
    }

    /*
     * Return request string
     * @return string
     *
     * */
    private function getURI(){

        if(!empty($_SERVER['REQUEST_URI'])){

            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /*
     * Return Controller and Action
     * @return bool
     * */
    public function run(){

        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern=>$path){

            if (preg_match("~$uriPattern~", $uri)){
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segment = explode('/', $internalRoute);
                $controllerName = ucfirst(array_shift($segment).'Controller');
                $actionName = 'action'.ucfirst(array_shift($segment));
                $parameters = $segment;

                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

                if(file_exists($controllerFile)){
                    include_once ($controllerFile);
                }

                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if($result != null){
                    break;
                }
            }

        }
    }
}