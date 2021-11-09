<?php

namespace App;

class Controller
{
    protected $_template = '';
    public $app = null;
    public $model = null;
    public $vars = array();

    public function __construct()
    {
        global $app;
        $this->app = $app;

        $class = get_class($this);
        $modelName = str_ireplace('Controller', 'Model', $class);
        
        $model = new $modelName();
        if(class_exists($modelName)) {
            $this->model = $model;
        }
    }

    public function view($page, $data = [])
    {
        $this->getLanguage();
        extract($data);

        if (!file_exists($page . '.php')) {
            return;
        }

        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }

        ob_start();
        require_once $page . '.php';
        $content = ob_get_clean();

        $parsedContent = self::parse($content);
        echo $parsedContent;
    }

    protected function parse($str = null)
    {
        $vars = $this->vars;
        return preg_replace_callback('|{([a-zA-Z0-9_\:]+)}|', function ($matches) use ($vars) {
            $word = isset($vars[$matches[1]]) ? $vars[$matches[1]] : (isset($vars['lang'][$matches[1]]) ? $vars['lang'][$matches[1]] : '');

            $string = isset($word) ? $this->parse($word) : '';
            return $string;
        }, $str);
    }

    protected function getLanguage() {
        global $app;

        $default_lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : App::getConfig('default_lang');
        
        $lang_path = __DIR__."/lang/{$default_lang}.json";
        $string = file_get_contents($lang_path);
        $lang = json_decode($string, true);

        $this->lang = $lang;
    }

    public function __set($key, $value)
    {
        $this->vars[$key] = $value;
    }

    public function __get($key)
    {
        return $this->vars[$key];
    }
}