<?php

namespace App\Controllers;

class ForecastController extends \App\Controller {
    function Index($req, $res) {
        header('Content-Type: application/json');
        $token = $req->get('HTTP_API_TOKEN', false);
        $results = [];

        if(!$this->model->checkToken($token)) {
            \App\Response::setStatusCode('401');
            $results = '401 Unauthorized';
        } else {
            \App\Response::setStatusCode('200');
            $url = 'https://api.weather.gov/gridpoints/OKX/31,34/forecast';
            $options = array('http' => array(
                'method'  => 'GET',
                'user_agent' => 'forecastapi'
            ));
            $context  = stream_context_create($options);
            $data = file_get_contents($url, false, $context);

            $response = json_decode($data);
            $this->model->update($token);

            foreach($response->properties->periods as $period) {
                $results[] = array(
                    'name' => $period->name,
                    'startTime' => $period->startTime,
                    'endTime' => $period->endTime,
                    'temperature' => $period->temperature,
                    'temperatureUnit' => $period->temperatureUnit,
                    'temperatureTrend' => $period->temperatureTrend,
                    'icon' => $period->icon,
                    'shortForecast' => $period->shortForecast,
                );
            }

            $results = json_encode($results);
        }
        
        echo $results.PHP_EOL;
    }
}