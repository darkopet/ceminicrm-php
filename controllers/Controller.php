<?php

    namespace app\controllers;
    use app\models\employees;
    use app\Router;

    /** Class CONTROLLER */

    class Controller
    {
        public static function index(Router $router)
        {
            // echo "Index page".'<br>';
            // echo '<pre>';
            // var_dump($products);
            // echo '</pre>';
        
            $search = $_GET['search'] ?? '';
            $employees = $router->db->getEmployees($search); 

            $router->renderView('employees/index', 
            [
                'employees' => $employees,
                'search' =>  $search
            ]);
        }

        public static function create(Router $router)
        {   
            $errors = [];
            $EmployeeData = [
                'FirstName' => '',
                'LastName' => '',
                'Company' => '',
                'CompanyEmail' => '',
                'Phone' => ''
            ];
            
            # Loading data from the $_POST and $_FILES via the controller
            if ($_SERVER['REQUEST_METHOD'] === 'POST') 
            {
                $EmployeeData['FirstName'] = $_POST['FirstName'];
                $EmployeeData['LastName'] = $_POST['LastName'];
                $EmployeeData['Company'] = (int)$_POST['Company'];
                $EmployeeData['CompanyEmail'] = $_POST['CompanyEmail'] ?? null;
                $EmployeeData['Phone'] = $_POST['Phone'] ?? null;

                # Instance of the class Employee created before
                $Employee = new employees();
                # Loading into the model
                $Employee->load($EmployeeData);
                $errors = $Employee->save();
                if(empty($errors)){ header('Location: /employees'); exit; }
            }

            $router->renderView('employees/create', [
                'Employee' => $EmployeeData,
                'errors' => $errors
            ]);
        }

        public static function update(Router $router)
        {
            $id = $_GET['id'] ?? null;
            // var_dump($id);
            if(!$id){ header('Location: /employees'); exit; }
            $errors = []; 
            $EmployeeData = $router->db->getEmployeeById($id);
            // var_dump($EmployeeData);
            // echo "<pre>";
            // var_dump($EmployeeData);
            // echo "</pre>";
            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {  
                $EmployeeData['FirstName'] = $_POST['FirstName'];
                $EmployeeData['LastName'] = $_POST['LastName'];
                $EmployeeData['Comapny'] = (int)$_POST['Company'];
                $EmployeeData['CompanyEmail'] = $_POST['CompanyEmail'] ?? null;
                $EmployeeData['Phone'] = $_POST['Phone'] ?? null;
                # Instance of the class Employee created before
                $Employee = new employees();
                # Loading into the model
                $Employee->load($EmployeeData);
                $errors = $Employee->save();
                if(empty($errors)){ header('Location: /employees'); exit; }
            } 
            $router->renderView('employees/update', [
                'Employee'=> $EmployeeData,
                'errors' => $errors
            ]);
        }

        public static function delete(Router $router)
        {
            $id = $_POST['id'] ?? null;
            if(!$id) { header('Location: /employees'); exit; }
            $router->db->deleteEmployee($id);
            header('Location: /employees');
            # echo "Delete page".'<br>';
        }
    }