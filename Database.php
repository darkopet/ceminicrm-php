<?php

    namespace app;
    use PDO;
    use app\models\employees;

    class Database
    {
        public \PDO $pdo;
        public static Database $db;

        public function __construct() # CONSTRUCT the database connection
        {   # DSN string = defines the connection string of the database
            $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=ceminicrm_php', 'phpmyadmin', 'phpmyadmindb00+--+');
            # If the connection to the database is not succesfull:
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            # SQL Database self-healing?
            self::$db = $this;
        }

        public function getemployees($search = '') # GET employees from the database via quering to select & fetching the database content
        {
            $search = $_GET['search'] ?? '';
            if($search) {
                # Query in the database in order to select products depending on searched word:
                $statement = $this->pdo->prepare('SELECT * FROM employees WHERE CompanyEmail LIKE :CompanyEmail ORDER BY id DESC');
                $statement->bindValue(':CompanyEmail', "%$search%");
            } else {
                # Query in the database in order to select employees:
                $statement = $this->pdo->prepare('SELECT * FROM employees ORDER BY id DESC');
            }    
            # Make the query 
            $statement->execute();
            # Fetching
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    

        public function getEmployeeById($id)
        {
            $statement = $this->pdo->prepare('SELECT * FROM employees WHERE id = :id');
            $statement->bindValue(':id',$id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public function createEmployee(employees $employee)
        {
            # Make an insert to the database of the superglobal $_POST data
            $statement = $this->pdo->prepare("INSERT INTO employees (FirstName, LastName, Company, CompanyEmail, Phone) 
                                              VALUES (:FirstName, :LastName, :Company, :CompanyEmail, :Phone)");
                # Make the change in the database
                $statement->bindValue(':FirstName', $employee->FirstName);
                $statement->bindValue(':LastName', $employee->LastName);  
                $statement->bindValue(':Company', $employee->Company);
                $statement->bindValue(':CompanyEmail', $employee->CompanyEmail);
                $statement->bindValue(':Phone', $employee->Phone);
                $statement->execute();
        }

        public function updateEmployee(employees $employee)
        {
                # Make an insert to the database of the superglobal $_POST data
                $statement = $this->pdo->prepare("UPDATE employees SET FirstName=:FirstName, LastName=:LastName, Company=:Company, CompanyEmail=:CompanyEmail, Phone=:Phone WHERE id = :id");
                # Make the change in the database
                $statement->bindValue(':FirstName', $employee->FirstName);
                $statement->bindValue(':LastName', $employee->LastName);  
                $statement->bindValue(':Company', $employee->Company);
                $statement->bindValue(':CompanyEmail', $employee->CompanyEmail);
                $statement->bindValue(':Phone', $employee->Phone);
                $statement->bindValue(':id', $employee->id);
                $statement->execute();
        }

        public function deleteEmployee($id)
        {
            $statement = $this->pdo->prepare('DELETE FROM employees WHERE id=:id');
            $statement->bindValue(':id',$id);
            $statement->execute();
        }
    };   