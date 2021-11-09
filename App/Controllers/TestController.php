<?php

namespace App\Controllers;

class TestController extends \App\Controller {
    function index($req, $res) {
        $this->model->getManyUsers();
    }
}