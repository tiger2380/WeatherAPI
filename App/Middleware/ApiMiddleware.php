<?php

namespace App\Middleware;

class ApiMiddleware extends BaseMiddleWare {
    public function execute($request, $response) {
        $token = $request->get('HTTP_API_TOKEN', false);
        if(!$token) {
            \App\Response::setStatusCode('401');
            echo '401 Unauthorized'.PHP_EOL;
            exit();
        }
    }
}