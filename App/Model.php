<?php

namespace App;

class Model {
    public $db;
    public $app;
    protected $class;

    public function __construct()
    {
        global $app;
        $this->class = get_called_class();
        $this->app = $app;
        $this->result = null;

        $reflectionClass = new \ReflectionClass($this->class);
        $this->classProps = (object)$reflectionClass->getDefaultProperties();
    }

    function find($id) {
        $sql = "SELECT * FROM {$this->classProps->table} WHERE {$this->classProps->idField} = ?";
        $this->result = \App\DB::run($sql, [ $id ])->fetch();
        return $this;
    }

    function fetchAll() {
        $sql = "SELECT * FROM {$this->classProps->table}";
        $this->result = \App\DB::run($sql)->fetchAll();
        return $this;
    }
}