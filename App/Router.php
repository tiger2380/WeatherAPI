<?php

namespace App;

class Router
{
    protected $GET = [];
    protected $POST = [];
    protected $DELETE = [];
    protected $PULL = [];
    protected $UPDATE = [];
    protected $request;
    protected $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($pattern, $callback) {
        $this->GET[$pattern] = $callback;
        return $this;
    }

    public function post($pattern, $callback) {
        $this->POST[$pattern] = $callback;
        return $this;
    }

    public function delete($pattern, $callback) {
        $this->DELETE[$pattern] = $callback;
    }

    public function put($pattern, $callback) {
        $this->PULL[$pattern] = $callback;
    }

    public function update($pattern, $callback) {
        $this->UPDATE[$pattern] = $callback;
    }

    protected function map() {
        $replace = trim(dirname(dirname($this->request->serverName())), '/');
        $uri = rtrim(str_replace($replace, '', $this->request->getUri()), '/');
        $exp = explode('?', $uri);
        $route = array_shift($exp);
        $query_string = array();
        if(isset($exp[0])) {
            parse_str($exp[0], $query_string);
        }

        $a = $this->{$this->request->getType()};
        $data = array_keys($a);
        $pattern_regex = preg_replace("/\{(.*?)\}/", "(?<$1>\w+)", $data);

        foreach($pattern_regex as $key => $pattern) {
            $pattern_regex = "#^". trim($pattern, "/") . "$#";
            preg_match($pattern_regex, trim($route, '/'), $matches);
            
            if($matches) {
                $results = array_merge_recursive($matches, $query_string);

                foreach($results as $id => $match) {
                    $this->request->set($id, $match);
                }

                if(array_key_exists($data[$key], App::$middlewares)) {
                    if(is_callable(App::$middlewares[$data[$key]])) {
                        call_user_func_array(App::$middlewares[$data[$key]], array(&$this->request, &$this->response));
                    } else {
                        App::$middlewares[$data[$key]]->execute($this->request, $this->response);
                    }
                }

                $callback = $a[$data[$key]];
                if(is_callable($callback)) {
                    call_user_func_array($callback, array(&$this->request, &$this->response));
                } else if (is_string($callback)) {
                    if(strstr($callback, '::')) {
                        list($controller, $method) = explode('::', $callback);
                        $className = '\App\Controllers\\'.$controller;
                        $class = new $className();
                        if(class_exists($className)) {
                            call_user_func_array(array($class, $method), array(&$this->request, &$this->response));
                            exit;
                        }
                    }
                } else {
                    throw new \App\AppException(404, 'Unknown page or callable.');
                }
                exit();
            }
        }

        throw new \App\AppException(404, 'Unknown page or callable.');
    }

    public function run() {
        try {
            $this->map();
        } catch (\AppException $ex) {
            \App\Response::setStatusCode($ex->getCode());
            var_dump($ex);
            //(new \App\Controllers\ErrorController())->_error($ex);
        }
    }
}