<?php

/**
 * Created a route for the API
 */
$app->get('/api/weather/office/forecast', 'ForecastController::Index')
->registerMiddleware(new App\Middleware\ApiMiddleware)
->name('forecast');