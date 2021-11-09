<?php

$app->get('/api/weather/office/forecast', 'ForecastController::Index')
->registerMiddleware(new App\Middleware\ApiMiddleware)
->name('forecast');