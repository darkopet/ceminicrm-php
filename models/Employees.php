<?php

namespace app\models;
use app\Database;
use app\helpers\UtilHelper;
use app\controllers\Controller;

    class Employees
    {
        public ?int $id = null;
        public ?string $FirstName = null;
        public ?string $LastName = null;
        public ?int $Company = null;
        public ?string $CompanyEmail = null;
        public ?string $Phone = null;

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
            # Validation
            if(!$this->FirstName) { $errors[] = 'Employee First Name is required!'; }
            if(!$this->LastName) { $errors[] = 'Employee Last Name is required!'; }
            // if(!is_dir(__DIR__.'/../public/images')) { mkdir(__DIR__.'/../public/images'); }
            // echo "<pre>";
            // var_dump($errors);
            // echo "</pre>";
            if(empty($errors)) {
                # Make an image upload    
                // if ($this->imageFile && $this->imageFile['tmp_name']) {
                //   if($this->imagePath) { unlink(__DIR__.'/../public/'.$this->imagePath); }
                //   $this->imagePath = 'images/'.UtilHelper::randomString(8).'/'.$this->imageFile['name'];
                //   mkdir(dirname(__DIR__.'/../public/'.$this->imagePath));
                //   move_uploaded_file($this->imageFile['tmp_name'], __DIR__.'/../public/'.$this->imagePath); 
                // }
                $db1 = Database::$db1;
                if($this->id) { $db1->updateEmployee($this); }
                else { $db1->createEmployee($this); }
            }
            return $errors;
        }
    }   