<?php

namespace App\Models;

use App\Model;

class ForecastModel extends Model {
    protected $table = 'ApiToken';
    protected $idField = 'Token';

    public function checkToken($token) {
        $response = $this->find($token);
        return $response->result || false;
    }

    public function update($token) {
        $response = $this->find($token)->result;
        $updateCount = (int)$response['UsageCount'] + 1;

        \App\DB::run("UPDATE ApiToken SET UsageCount = ?, LastUsedOn = Now() WHERE Token = ?", [$updateCount, $token]);
    }
}