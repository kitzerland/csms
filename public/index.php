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
$router->add('student/payment-history', ['controller' => 'PaymentController', 'action' => 'paymentReport', 'namespace' => 'Student']);
$router->add('student/payment-overdue', ['controller' => 'PaymentController', 'action' => 'paymentOverdue', 'namespace' => 'Student']);


$router->add('expenses/add-category', ['controller' => 'CategoriesController', 'action' => 'index', 'namespace' => 'Expences']);
$router->add('expenses/add-expense', ['controller' => 'ExpencesController', 'action' => 'index', 'namespace' => 'Expences']);



/**
 * Post Requests
 */
$router->post('login', ['controller' => 'LoginController', 'action' => 'login', 'namespace' => 'User']);

$router->post('student/register', ['controller' => 'RegistrationController', 'action' => 'register', 'namespace' => 'Student']);
$router->post('student/getstudent', ['controller' => 'RegistrationController', 'action' => 'getstudent', 'namespace' => 'Student']);
$router->post('student/nextIndex', ['controller' => 'RegistrationController', 'action' => 'nextIndex', 'namespace' => 'Student']);
$router->post('student/update', ['controller' => 'RegistrationController', 'action' => 'update', 'namespace' => 'Student']);
$router->post('student/delete', ['controller' => 'RegistrationController', 'action' => 'delete', 'namespace' => 'Student']);

$router->post('student/search', ['controller' => 'SearchController', 'action' => 'index', 'namespace' => 'Student']);
$router->post('student/getResult', ['controller' => 'SearchController', 'action' => 'getResult', 'namespace' => 'Student']);

$router->post('student/achievement', ['controller' => 'AchievementController', 'action' => 'achievement', 'namespace' => 'Student']);
$router->post('student/payment', ['controller' => 'PaymentController', 'action' => 'payment', 'namespace' => 'Student']);
$router->post('student/invoice', ['controller' => 'PaymentController', 'action' => 'invoice', 'namespace' => 'Student']);

$router->post('student/history', ['controller' => 'PaymentController', 'action' => 'paymentHistory', 'namespace' => 'Student']);
$router->post('student/overdue', ['controller' => 'PaymentController', 'action' => 'overdue', 'namespace' => 'Student']);

$router->post('expences/loadCategories', ['controller' => 'CategoriesController', 'action' => 'loadCategories', 'namespace' => 'Expences']);
$router->post('expences/saveCategory', ['controller' => 'CategoriesController', 'action' => 'saveCategory', 'namespace' => 'Expences']);

$router->post('expences/saveExpense', ['controller' => 'ExpencesController', 'action' => 'saveExpense', 'namespace' => 'Expences']);
$router->post('expences/loadExpenses', ['controller' => 'ExpencesController', 'action' => 'loadExpenses', 'namespace' => 'Expences']);


$router->dispatch($_SERVER['QUERY_STRING']);
