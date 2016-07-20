<?php

/**
 * Front Controller
 */
/**
 * Twig
 */
//require_once dirname(__DIR__);
require_once '../vendor/Twig/Autoloader.php';
Twig_Autoloader::register();

/**
 * Autoloader
 */
spl_autoload_register(function($class) {
    $root = dirname(__DIR__);
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $file;
    }
});

/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');

/**
 * Routing
 */
$router = new Core\Router();

//Add the routes
//$router->add('home', ['controller' => 'Home', 'action' => 'index']);
//$router->add('', ['controller' => 'Home', 'action' => 'index']);
//$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
//$router->add('{controller}/{action}');
//$router->add('admin/{action}/{controller}');
//$router->add('{controller}/{id:\d+}/{action}');
//$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
//$router->post('PostRequests/index', ['controller' => 'PostRequests', 'action' => 'index']);

$router->add('', ['controller' => 'HomeController', 'action' => 'index']);


$router->dispatch($_SERVER['QUERY_STRING']);
