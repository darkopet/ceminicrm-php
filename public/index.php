<?php
    // echo "chckpnt1".'<br><br>';
    
    require_once __DIR__.'/../vendor/autoload.php';

    use app\Router;
    use app\controllers\Controller;

    $router = new Router();

    // echo "chckpnt2".'<br><br>';

    $router->get('/' , [Controller::class, 'index']);
    $router->get('/employees' , [Controller::class, 'index']);
    $router->get('/employees/index', [Controller::class, 'index']);

    $router->get('/employees/create', [Controller::class, 'create']);
    $router->post('/employees/create', [Controller::class, 'create']);
    
    $router->get('/employees/update', [Controller::class, 'update']);
    $router->post('/employees/update', [Controller::class, 'update']);

    $router->post('/employees/delete', [Controller::class, 'delete']);
    
    // echo "chckpnt3".'<br><br>';

    $router->resolve(); // PROBLEM!

    // echo "<br><br>";
    // echo "chckpnt4".'<br><br>';