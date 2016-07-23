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
 * Session start
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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

/**
 * Get requests
 */
$router->add('login', ['controller' => 'LoginController', 'action' => 'index', 'namespace' => 'User']);
$router->add('logout', ['controller' => 'LoginController', 'action' => 'logout', 'namespace' => 'User']);
$router->add('', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('index', ['controller' => 'HomeController', 'action' => 'index']);
$router->add('student/register', ['controller' => 'RegistrationController', 'action' => 'index', 'namespace' => 'Student']);
$router->add('student/achievement', ['controller' => 'AchievementController', 'action' => 'index', 'namespace' => 'Student']);
$router->add('student/payment', ['controller' => 'PaymentController', 'action' => 'index', 'namespace' => 'Student']);


/**
 * Post Requests
 */
$router->post('login', ['controller' => 'LoginController', 'action' => 'login', 'namespace' => 'User']);
$router->post('student/register', ['controller' => 'RegistrationController', 'action' => 'register', 'namespace' => 'Student']);
$router->post('student/search', ['controller' => 'SearchController', 'action' => 'index', 'namespace' => 'Student']);
$router->post('student/getResult', ['controller' => 'SearchController', 'action' => 'getResult', 'namespace' => 'Student']);
$router->post('student/achievement', ['controller' => 'AchievementController', 'action' => 'achievement', 'namespace' => 'Student']);
$router->post('student/payment', ['controller' => 'PaymentController', 'action' => 'payment', 'namespace' => 'Student']);



$router->dispatch($_SERVER['QUERY_STRING']);
