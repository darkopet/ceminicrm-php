<?php
namespace app\models;
use app\Database;

    class Employee
    {
        public ?int $id = null;
        public ?string $FirstName = null;
        public ?string $LastName = null;
        public ?int $Company = null;
        public ?string $CompanyEmail = null;
        public ?int $Phone = null;

        # Data loading function - via the controller
        public function load($data)
        {
            $this->id = $data['id'] ?? null;
            $this->FirstName = $data['FirstName'];
            $this->LastName = $data['LastName'];
            $this->Company = $data['Company'];
            $this->CompanyEmail = $data['CompanyEmail'] ?? null;
            $this->Phone = $data['Phone'] ?? null;
        }

        public function save()
        {
            $errors = [];

            if(!$this->FirstName) { $errors[] = 'Employee First Name is required!'; }
            if(!$this->LastName) { $errors[] = 'Employee Last Name is required!'; }

            if(empty($errors)) {
                $db = Database::$db;
                if($this->id) { $db->updateEmployee($this); }
                else { $db->createEmployee($this); }
            }
            return $errors;
        }
    }   