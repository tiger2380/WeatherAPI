<?php

namespace App;

class Container {
    protected $container = [];

    public function set($key, $value) {
        $this->container[$key] = $value;
    }

    public function get($key) {
        return $this->container[$key];
    }
}