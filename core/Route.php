<?php
namespace Zems;
use App\Controller;
class Route
{
    protected static $routes = [];
    protected static $ckParams = false;
    public static $cMethod = "GET";
    public function __construct() {
        self::$cMethod = $_SERVER['REQUEST_METHOD'];
    }
    private static function addRoute($route, $controller, $action, $method)
    {
        self::$routes[$method][$route] = ['controller' => $controller, 'action' => $action];
    }

    public static function get($route, $controller, $action)
    {
        self::addRoute($route, $controller, $action, "GET");
    }

    public static function post($route, $controller, $action)
    {
        $method = "POST";
        self::addRoute($route, $controller, $action, $method);
    }
    public static function put($route, $controller, $action)
    {
        $method = "PUT";
        // if(isset($_POST["_method"])){
        //     $method = strtoupper($_POST["_method"]);
        // }
        self::addRoute($route, $controller, $action, $method);
    }
    public static function delete($route, $controller, $action)
    {
        $method = "DELETE";
        self::addRoute($route, $controller, $action, $method);
    }

    public static function dispatch()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method =  $_SERVER['REQUEST_METHOD'];
        // return self::resolveParams();
        $uri = rtrim($uri, "/");
        if($uri == ""){
            $uri = "/";
        }
        if (array_key_exists($uri, self::$routes[$method])) {
            $controller = self::$routes[$method][$uri]['controller'];
            $action = self::$routes[$method][$uri]['action'];
            $controller = new $controller();
            $controller->$action();
        } else {
            self::resolveParams();
            if(self::$ckParams  == false){
                throw new \Exception("No route found for URI: $uri");
            }
        }
    }
    
    public static function resolveParams()  {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if(isset($_POST["_method"])){
            $requestMethod = strtoupper($_POST["_method"]);
            self::$cMethod = $requestMethod;
        }
        foreach(self::$routes as $k=>$route){
            self::route_back($k);
        }

        // self::route_back('GET');
        // self::route_back('POST');
    }
    public static function route_back($requestMethod) {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method =  $_SERVER['REQUEST_METHOD'];
        $uri = rtrim($uri, "/");
        $var_route = [];
        $routeParams = null;
        
        
        foreach(self::$routes[$requestMethod] as $k=>$route){
            // echo $k." - " . $requestMethod ." +";
            if(preg_match_all('/\{(\w+)(:[^}]+)?}/', $k, $matches)) {
                $var_route = $matches[1];
            }
            
            $route_regex = "@^".preg_replace_callback('/\{(\w+)(:[^}]+)?}/', fn($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', $k)."$@";
            
            if(preg_match_all($route_regex, $uri, $final_route)){
                $values = [];
                for($i=1; $i< count($final_route); $i++){
                    $values[] = $final_route[$i][0];
                }
                $routeParams = array_combine($var_route, $values);
                $controller = self::$routes[self::$cMethod][$k]['controller'];
                $action = self::$routes[self::$cMethod][$k]['action'];
                
                $controller = new $controller;
                self::$ckParams = true;
                return call_user_func_array(array($controller, $action), $routeParams);
            } 
        }
        
    }
}

