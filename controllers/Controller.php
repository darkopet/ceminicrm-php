<?php

    namespace app\controllers;
    use app\models\Employees;
    use app\Router;

    /** Class CONTROLLER */

    class Controller
    {
        public function index(Router $router)
        {
            echo "Index page".'<br>';
            // echo '<pre>';
            // var_dump($Employees);
            // echo '</pre>';
        
            // $search = $_GET['search'] ?? ''

            // $employees = $router->db->getEmployees($search); 

            // $router->renderView('Employees/index', 
            // [
            //     'employees' => $employees,
            //     'search' =>  $search
            // ]);
        }

        public function create(Router $router)
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
                $Employee = new Employees();
                # Loading into the model
                $Employee->load($EmployeeData);
                $errors = $Employee->save();
                if(empty($errors)){ header('Location: /Employees'); exit; }
            }

            $router->renderView('Employees/create', [
                'Employee' => $EmployeeData,
                'errors' => $errors
            ]);
        }

        public function update(Router $router)
        {
            $id = $_GET['id'] ?? null;
            // var_dump($id);
            if(!$id){ header('Location: /Employees'); exit; }
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
                $Employee = new Employees();
                # Loading into the model
                $Employee->load($EmployeeData);
                $errors = $Employee->save();
                if(empty($errors)){ header('Location: /Employees'); exit; }
            } 
            $router->renderView('Employees/update', [
                'Employee'=> $EmployeeData,
                'errors' => $errors
            ]);
        }

        public function delete(Router $router)
        {
            $id = $_POST['id'] ?? null;
            if(!$id) { header('Location: /Employees'); exit; }
            $router->db->deleteEmployee($id);
            header('Location: /Employees');
            # echo "Delete page".'<br>';
        }
    }