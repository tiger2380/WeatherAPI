<?php

namespace App\Middleware;

class AuthMiddleware extends BaseMiddleWare {
    public function execute() {
        if(!isset($_SESSION[\App::getConfig('session_name')])) {
            Global $app;
            $app->response->redirect($app->reverse('login-form'), $_SERVER['REQUEST_URI']);
            exit();
        }
    }
}