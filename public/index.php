<?php

    echo "chckpnt1".'<br><br>';
    
    require_once __DIR__.'/../vendor/autoload.php';

    use app\Router;
    use app\controllers\Controller;

    $router = new Router();

    echo "chckpnt2".'<br><br>';

    // $router->get('', [ProductController::class, 'index']);
    // $router->get('/', [ProductController::class, 'index']);
    // $router->get('/products', [ProductController::class, 'index']);
    // $router->get('/products/', [ProductController::class, 'index']);
    // $router->get('/public', [ProductController::class, 'index']);
    // $router->get('/public/', [ProductController::class, 'index']);
    // $router->get('/products/index', [ProductController::class, 'index']);

    // $router->get('/products/create', [ProductController::class, 'create']);
    // $router->post('/products/create', [ProductController::class, 'create']);
    // $router->get('/products/update', [ProductController::class, 'update']);
    // $router->post('/products/update', [ProductController::class, 'update']);
    
    // $router->post('/products/delete', [ProductController::class, 'delete']);
    // $router->post('/public/delete', [ProductController::class, 'delete']);

    // echo "good".'<br><br>';

    $router->get('' , [Controller::class, 'index']);
    
    $router->get('/views/Employees/create', [Controller::class, 'create']);
    $router->post('/views/Employees/create', [Controller::class, 'create']);
    
    $router->get('/views/Employees/update', [Controller::class, 'update']);
    $router->post('/views/Employees/update', [Controller::class, 'update']);

    $router->post('/views/Employees/delete', [Controller::class, 'delete']);
    
    echo "chckpnt3".'<br><br>';

    $router->resolve();

    echo "chckpnt4".'<br><br>';