<?php

namespace App\Models;

use App\Model;

class TestModel extends Model {
    protected $table = 'user';
    protected $idField = 'id';
    protected $fields = [
        'name',
        'username',
        'password',
        'email'
    ];

    public function getOneUser($id) {
        $this->getOne($id);
    }

    public function getManyUsers() {
        $this->getMany();
    }
}