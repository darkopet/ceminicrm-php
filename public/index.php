<?php
    // echo "chckpnt1".'<br><br>';
    
    require_once __DIR__.'/../vendor/autoload.php';

    use app\Router;
    use app\controllers\EmployeesController;
    use app\controllers\CompaniesController;

    // $db = new \app\Database();
    $router = new Router();

    // echo "chckpnt2".'<br><br>';

    $router->get('/' , [new EmployeesController(), 'index']);
    $router->get('/employees' , [new EmployeesController(), 'index']);
    $router->get('/employees/index', [new EmployeesController(), 'index']);

    $router->get('/employees/create', [new EmployeesController(), 'create']);
    $router->post('/employees/create', [new EmployeesController(), 'create']);
    
    $router->get('/employees/update', [new EmployeesController(), 'update']);
    $router->post('/employees/update', [new EmployeesController(), 'update']);

    $router->post('/employees/delete', [new EmployeesController(), 'delete']);


    $router->get('/companies', [new CompaniesController(), 'index']);
    $router->get('/companies/index', [new CompaniesController(), 'index']);

    $router->get('companies/create', [new CompaniesController(), 'create']);
    $router->post('companies/create', [new CompaniesController(), 'create']);

    $router->get('companies/update', [new CompaniesController(), 'update']);
    $router->post('companies/update', [new CompaniesController(), 'update']);

    $router->post('companies/delete', [new CompaniesController(), 'delete']);
    
    // echo "chckpnt3".'<br><br>';

    $router->resolve(); // PROBLEM!

    // echo "<br><br>";
    // echo "chckpnt4".'<br><br>';