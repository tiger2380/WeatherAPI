<?php

/** Basic route */
/** "/" is the home page. each routes have access to the $request and $response variable
 *   You can call the view (html file) directly within the ano function itself like below.
 *   You can give a route a name by adding ->name('{route name})
 *  $app->get('{route path}', function($request, $response) {
 *      (new App\Controller())->view('../app/Views/{php filename; no extension}');
  * })->name('{route name}');
 */
$app->get('/', function($request, $response) {
    (new App\Controller())->view('../App/Views/home');
})->name('home');

$app->get('/api/weather/office/forecast', 'ForecastController::Index')
->registerMiddleware(new App\Middleware\ApiMiddleware)
->name('forecast');