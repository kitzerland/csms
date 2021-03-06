<?php

namespace Core;

/**
 * View
 */
class View {

    /**
     * Render a view file
     * @param string $view The view file
     */
    public static function render($view, $args = []) {
        extract($args, EXTR_SKIP);

        $file = "../App/Views/$view";

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    /**
     * Render a view template using Twig
     * @param string $template The template file
     * @param array $args Associative array of data to display in the view
     * @return void
     */
    public static function renderTemplate($template, $args = []) {
        static $twig = null;
        $args['baseURL'] = static::baseURL();
        if ($twig === null) {
            $loader = new \Twig_Loader_Filesystem('../App/Views');
            $twig = new \Twig_Environment($loader);
        }
        if (session_status() == PHP_SESSION_ACTIVE) {
            $args['session'] = $_SESSION;
        }
        echo $twig->render($template, $args);
    }

    private static function baseURL() {
        global $system_name;
        $protocol = '';
        if (isset($_SERVER['HTTPS'])) {
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https://" : "http://";
        } else {
            $protocol = 'http://';
        }
        return $protocol . $_SERVER['HTTP_HOST'];
    }

}
