<?php
    // echo "chckpnt1".'<br><br>';
    
    require_once __DIR__.'/../vendor/autoload.php';

    use app\Router;
    use app\controllers\EmployeesController;
    use app\controllers\CompaniesController;

    $router = new Router();

    // echo "chckpnt2".'<br><br>';

    $router->get('/' , [EmployeesController::class, 'index']);
    $router->get('/employees' , [EmployeesController::class, 'index']);
    $router->get('/employees/index', [EmployeesController::class, 'index']);

    $router->get('/employees/create', [EmployeesController::class, 'create']);
    $router->post('/employees/create', [EmployeesController::class, 'create']);
    
    $router->get('/employees/update', [EmployeesController::class, 'update']);
    $router->post('/employees/update', [EmployeesController::class, 'update']);

    $router->post('/employees/delete', [EmployeesController::class, 'delete']);


    $router->get('/companies', [CompaniesController::class, 'index']);
    $router->get('/companies/index', [CompaniesController::class, 'index']);

    $router->get('companies/create', [CompaniesController::class, 'create']);
    $router->post('companies/create', [CompaniesController::class, 'create']);

    $router->get('companies/update', [CompaniesController::class, 'update']);
    $router->post('companies/update', [CompaniesController::class, 'update']);

    $router->post('companies/delete', [CompaniesController::class, 'delete']);
    
    // echo "chckpnt3".'<br><br>';

    $router->resolve(); // PROBLEM!

    // echo "<br><br>";
    // echo "chckpnt4".'<br><br>';