<?php

namespace app\models;

use app\Database;

class Company
{
    public ?int $id = null;
    public ?string $Name = null;
    public ?string $CompanyEmail = null;
    public ?string $logo = null;
    public ?string $website = null;

    public function load($cmpdata)
    {   
        $this->id = $cmpdata['id'] ?? null;
        $this->Name = $cmpdata['Name'];
        $this->CompanyEmail = $cmpdata['CompanyEmail'] ?? null;
        $this->logo = $cmpdata['logo'] ?? null;
        $this->website = $cmpdata['website'] ?? null;
    }

    public function save()
    {
        $errors = [];

        if(!$this->Name){$errors = 'Company Name is required!';}

        if(empty($errors)) 
        {
            $db = Database::$db;
            if($this->id) { $db->updateCompany($this); }
            else { $db->createCompany($this); }
        }
            
        return $errors;    
    } 
}