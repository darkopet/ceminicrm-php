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
    public function load($empdata)
    {
        $this->id = $empdata['id'] ?? null;
        $this->FirstName = $empdata['FirstName'];
        $this->LastName = $empdata['LastName'];
        $this->Company = $empdata['Company'];
        $this->CompanyEmail = $empdata['CompanyEmail'] ?? null;
        $this->Phone = $empdata['Phone'] ?? null;
    }

    public function save()
    {
        $errors = [];

        if (!$this->FirstName) {
            $errors[] = 'Employee First Name is required!';
        }
        if (!$this->LastName) {
            $errors[] = 'Employee Last Name is required!';
        }

        if (empty($errors)) {
            $db = Database::$db;
            if ($this->id) {
                $db->updateEmployee($this);
            } else {
                $db->createEmployee($this);
            }
        }
        return $errors;
    }
}
