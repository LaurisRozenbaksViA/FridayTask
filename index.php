<?php

require  'vendor/autoload.php';

class Database
{

}

$response = ''; //render('views/landing.view.php');
if (array_key_exists('page', $_GET)) {
    $requestedPage = $_GET['page'];

    $dependencies = [
        'model.animals' => new Animals(),
        'model.animals.small' => new SmallAnimals(),
        'model.cars' => new Cars(),
        'model.wiskey' => new Wiskey()
    ];

    $container = new Container($dependencies);

    $animals = new AnimalsController($container);
    $cars = new CarsController($container);
    $wiskey = new WiskeyController($container);

    $pages = [
        'animals' => [$animals, 'animalsAction'],
        'small-animals' => [$animals, 'smallAnimalsAction'],
        'cars' => [$cars, 'carsAction'],
        'wiskey' => [$wiskey, 'wiskeyAction'],
    ];

    if (array_key_exists($requestedPage, $pages)) {
        $response = call_user_func($pages[$requestedPage]);
    } else {
        //http_response_code(404);
        header('HTTP/1.1 404 Not Found');
    }
}

include __DIR__ . '/app/view.php';