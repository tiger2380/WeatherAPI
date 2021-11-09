<?php
    require __DIR__ . '/../autoload.php';

    if(App\App::getConfig('DEVELOPMENT_ENVIRONMENT')) {
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
    }


    $app = new App\App();

    //routes
    require_once __DIR__.'/../routes.php';
    require_once __DIR__.'/../App/helpers.php';

    $app->run();