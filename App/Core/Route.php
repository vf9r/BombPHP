<?php
namespace App\Core;

/**
 * Cited sources:
 * 
 * https://stackoverflow.com/questions/20960877/the-basics-of-php-routing
 * https://tech.jotform.com/what-is-router-and-how-to-create-your-own-router-with-php-fad811cf2873
 */

class Route {
    
    /**
     * @since 4.13.25
     * @var array Keeps all the routes, seperated by POST and GET.
     */

    protected static array $routes = [
        "POST" => [],
        "GET" => [],
    ];

    /**
     * Prepares a GET route to be added to the routes array.
     * 
     * @since 4.13.25
     * @param string $uri Request URI
     * @param _ The controller method that closes the route.
     * @return void
     */

    public static function get(string $uri, $target): void {
        self::stow("GET", $uri, $target);
    }

    /**
     * Stows a route into the routes array.
     * 
     * @since 4.13.25
     * @param string $method Type of method (POST/GET)
     * @param string $uri Request URI
     * @param _ The controller method that closes the route.
     * @return void
     */

    public static function stow(string $method, string $uri, $target): void {
        $uri = '/' . trim($uri, '/');
        self::$routes[$method][$uri] = $target;
    }

    /**
     * Dispatches the request URI to the corresponding route.
     * 
     * @since 4.13.25
     * @param string $method Type of method (POST/GET)
     * @param string $uri Request URI
     * @return void
     */

    public static function dispatch(string $method, string $uri): void {
        $uri = '/' . trim($uri, '/');
        if (!isset(self::$routes[$method][$uri])) {
            http_response_code(404);
            return;
        }
    
        $action = self::$routes[$method][$uri];
    
        if (is_callable($action)) {
            call_user_func($action);
            return;
        }

        if (is_string($action)) {
            try {
                self::callController($action);
            } catch (Exception $e) {
                http_response_code(500);
                echo $e->getMessage();
            }
            return;
        }

        http_response_code(500);
    }

    /**
     * Helper function that calls the given method of the controller.
     * 
     * @since 4.13.25
     * @param string $action (Ex: ControllerAlias@MethodAlias)
     * @throws Exception If the controller was not found, does not exist, or if the method was not found/does not exist.
     * @return void
     */

    protected static function callController(string $action): void {
        [$controllerAlias, $method] = explode("@", $action);
        $controllerAlias = ucfirst($controllerAlias);
        $controllerPath = $_SERVER["DOCUMENT_ROOT"] . "/App/Controllers/$controllerAlias.php";

        if (!file_exists()) {
            throw new Exception("The controller $controllerAlias was not found.");
        }

        require_once($controllerPath);

        if (!class_exists($controllerAlias)) {
            throw new Exception("Controller class $controllerAlias does not exist.");
        }
    
        $controller = new $controllerAlias;
    
        if (!method_exists($controller, $method)) {
            throw new Exception("Method $method not found in $controllerAlias.");
        }
    
        call_user_func([$controller, $method]);
    }

}
?>