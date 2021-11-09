<?php
use \App\App;

function getURL($name) {
    if(array_key_exists($name, App::$routeNames)) {
        return App::getConfig('url').App::$routeNames[$name];
    } else {
        return '';
    }
}