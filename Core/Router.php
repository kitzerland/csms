<?php

namespace Core;

/**
 * Router
 */
class Router {

    /**
     * Associative array of rutes(routing rable)
     * @var array
     */
    protected $routes = [];

    /**
     * Parameters from the matched route
     * @var array
     */
    protected $params = [];

    /**
     * Add aroute to the routing table
     * 
     * @param string $route The route URL
     * @param array $params Parameters (controller, action, ect.)
     */
    public function add($route, $params = []) {
//        echo $route;
        //Escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        //Convert variables e.g {controller}
        $route = preg_replace('/\{([a-z]+)}/', '(?P<\1>[a-z-]+)', $route);

        //Convert variables with custome regualr expressions eg. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        //Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    protected $postRoutes = [];
    protected $postParams = [];

    public function post($route, $params = []) {
        $route = preg_replace('/\//', '\\/', $route);
        $route = preg_replace('/\{([a-z]+)}/', '(?P<\1>[a-z-]+)', $route);
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        $route = '/^' . $route . '$/i';
        $this->postRoutes[$route] = $params;
    }

    /**
     * Get all the routes from the routing table
     * 
     * @return array
     */
    public function getRoutes() {
        return $this->routes;
    }

    /**
     * Matches route. Sets $params if a route is found
     * @param string $url Trhe route URL
     * @return boolean true if a match found, false otherwise
     */
    public function match($url) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            foreach ($this->routes as $route => $params) {
                if (preg_match($route, $url, $matches)) {

                    foreach ($matches as $key => $match) {
                        if (is_string($key)) {
                            $params[$key] = $match;
                        }
                    }
                    $this->params = $params;
                    return true;
                }
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($this->postRoutes as $route => $params) {
                if (preg_match($route, $url, $matches)) {

                    foreach ($matches as $key => $match) {
                        if (is_string($key)) {
                            $params[$key] = $match;
                        }
                    }
                    $this->postParams = $params;
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Get the currently matched parameters
     * 
     * @return array
     */
    public function getParams() {
        return $this->params;
    }

    public function dispatch($url) {
        $url = $this->removeQueryStringVariables($url);

        if ($this->match($url)) {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $controller = $this->params['controller'];
                $controller = $this->convertToStudlyCaps($controller);
                $controller = $this->getNamespace() . $controller;
                if (class_exists($controller)) {
                    $controller_object = new $controller($this->params);

                    $action = $this->params['action'];
                    $action = $this->convertToCamelCase($action);

                    if (is_callable([$controller_object, $action])) {
                        $controller_object->$action();
                    } else {
                        throw new \Exception("Method $action (in controller $controller) not found");
                    }
                } else {
                    throw new \Exception("Controller class $controller not found");
                }
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $postData = filter_input_array(INPUT_POST);
                if (!empty($postData)) {
                    $postData = $this->htmlspecial_array($postData);
                }

                $controller = $this->postParams['controller'];
                $controller = $this->convertToStudlyCaps($controller);
                $controller = $this->getNamespace() . $controller;

                if (class_exists($controller)) {
                    $controller_object = new $controller($postData);

                    $action = $this->postParams['action'];
                    $action = $this->convertToCamelCase($action);
                    if (is_callable([$controller_object, $action])) {
                        $controller_object->$action();
                    } else {
                        throw new \Exception("Method $action (in controller $controller) not found");
                    }
                } else {
                    throw new \Exception("Controller class $controller not found");
                }
            }
        } else {
            throw new \Exception("No route matched", 404);
        }
    }

    protected function htmlspecial_array($arr) {
        foreach ($arr as $k => $v) {
            if (!is_array($v)) {
                $arr[$k] = htmlspecialchars($v);
            } else {
                $this->htmlspecial_array($v);
            }
        }
        return $arr;
    }

    protected function convertToStudlyCaps($string) {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    protected function convertToCamelCase($string) {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    protected function removeQueryStringVariables($url) {
        if ($url != '') {
            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }

    protected function getNamespace() {
        $namespace = 'App\Controllers\\';

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (array_key_exists('namespace', $this->params)) {
                $namespace .= $this->params['namespace'] . '\\';
            }
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (array_key_exists('namespace', $this->postParams)) {
                $namespace .= $this->postParams['namespace'] . '\\';
            }
        }
        return $namespace;
    }

}
