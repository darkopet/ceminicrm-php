<?php
    
    namespace app\controllers;
    
    use app\models\Company;
    use app\Router;

    /** Class CONTROLLER */

    class CompaniesController
    {
        public function index(Router $router)
        {
            $search = $_GET['search'] ?? '';
            $companies = $router->db->getCompanies($search);

            $router->renderView('companies/index',
                [
                    'companies' => $companies,
                    'search' => $search
                ]
            );
        }

        public function create(Router $router)
        {
            $errors = [];

            $CompanyData = [
                'Name' => '',
                'CompanyEmail' => '',
                'logo' => '',
                'website' => ''
            ];

            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $CompanyData['Name'] = $_POST['Name'];
                $CompanyData['CompanyEmail'] = $_POST['CompanyEmail'];
                $CompanyData['logo'] = $_POST['logo'];
                $CompanyData['website'] = $_POST['website'];

                $Company = new Company();

                $Company->load($CompanyData);
                
                $errors = $Company->save();

                if(empty($errors)){ header('Location: /companies'); exit; }
            }

            $router->renderView('companies/create', [
                'Company' => $CompanyData,
                'errors' => $errors
            ]);
        }

        public function update(Router $router)
        {
            $id = $_GET['id'] ?? null;
            if(!$id) { header('Location: /companies'); exit; }

            $errors = [];

            $CompanyData = $router->db->getCompanyById($id);

            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $CompanyData['Name'] = $_POST['Name'];
                $CompanyData['CompanyEmail'] = $_POST['CompanyEmail'];
                $CompanyData['logo'] = $_POST['logo']; 
                $CompanyData['website'] = $_POST['website'];
                
                $Company = new Company();

                $Company->load($CompanyData);

                $errors = $Company->save();
                
                if(empty($errors)){ header('Location: /companies'); exit; }
            } 
            $router->renderView('companies/update', [
                'Company'=> $CompanyData,
                'errors' => $errors
            ]);
        }

        public function delete(Router $router)
        {
            $id = $_POST['id'] ?? null;
            if(!$id) { header('Location: /companies'); exit; }

            $router->db->deleteCompany($id);
            header('Location: /companies');
        }
    }