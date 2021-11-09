<?php
namespace App;

use App\Router;

class App {
    protected $router = null;
    public $request = null;
    protected $container = null;
    protected static $settings = null;
    public $template = null;
    public $response = null;
    public static $middlewares = [];
    public static $routeNames = [];
    protected $next = null;
    protected $db = null;
    public $form = null;

    public function __construct()
    {
        $this->template = new \App\Template;
        $this->container = new \App\Container;
        $this->request = new \App\Request;
        $this->response = new \App\Response;
        $this->router = new \App\Router($this->request, $this->response);
        $this->form = new \App\Form;
    }

    public static function getConfig($name, $default = '') {
        if(!isset(static::$settings)) {
            static::$settings = require_once('Settings.php');
        }
        if(array_key_exists($name, static::$settings)) {
            return static::$settings[$name];
        } else {
            return $default;
        }
    }

    public function get($key, $value) {
        $this->router->get($key, $value);
        $this->next = $key;
        return $this;
    }

    public function post($key, $value) {
        $this->router->post($key, $value);
        $this->next = $key;
        return $this;
    }

    public function delete($key, $value) {
        $this->router->delete($key, $value);
        $this->next = $key;
        return $this;
    }

    public function put($key, $value) {
        $this->router->put($key, $value);
        $this->next = $key;
        return $this;
    }

    public function group($key, $value) {
        $this->router->group($key, $value);
        $this->next = $key;
        return $this;
    }

    public function container($key, $value = null) {
        if(isset($value)) {
            $this->container->set($key, $value);
        } else {
            return $this->container->get($key);
        }
    }

    public function name($routeName) {
        self::$routeNames[$routeName] = $this->next;
        return $this;
    }

    public function registerMiddleware($middleware) {
        self::$middlewares[$this->next] = $middleware;
        return $this;
    }

    public function run() {
        $this->router->run();
    }

    public function reverse($name) {
        global $base_url;
        if(array_key_exists($name, App::$routeNames)) {
            return static::getConfig('url').App::$routeNames[$name];
        } else {
            return '';
        }
    }

    public function activeLink($page = null) {
        $result = '';
        if(isset($page)) {
            if($page === $this->request->get('path')) {
                $result = ' active';
            } 
        }
        
        echo $result;
    }

    public function getNameByURL($url) {
        $values = array_reverse(App::$routeNames);
        global $base_url;
        
        $newArray = array_filter($values, function($var) use ($base_url, $url) {
            return $base_url.$var === $url;
        });
        
        return reset($newArray);
    }

    public function staticPage($page = null, $data = []) {
        echo $this->template->render('header', ROOT . DS . 'app' . DS . 'Views' . DS.'partials'.DS);
        echo $this->template->render('navbar', ROOT . DS . 'app' . DS . 'Views' . DS.'partials'.DS);
        if(isset($page)) {
            echo $this->template->render($page, $data);
        } else {
            echo $this->template->render('404', $data);
        }
        echo $this->template->render('footer', ROOT . DS . 'app' . DS . 'Views' . DS.'partials'.DS);
    }

}