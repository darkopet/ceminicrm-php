<?php

    namespace app;
    use PDO;
    use app\models\Employees;

    class Database
    {
        public \PDO $pdo;
        public static Database $db1;
        public function __construct() # CONSTRUCT the database connection
        {   # DSN string = defines the connection string of the database
            $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=ceminicrm', 'phpmyadmin', 'phpmyadmindb+--+');
            # If the connection to the database is not succesfull:
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$db1 = $this;
        }

        public function getEmployees($search = '') # GET employeeS from the database via quering to select & fetching the database content
        {
            $search = $_GET['search'] ?? '';
            if($search) {
                # Query in the database in order to select products depending on searched word:
                $statement = $this->pdo->prepare('SELECT * FROM Employees WHERE CompanyEmail LIKE :CompanyEmail ORDER BY emp_id DESC');
                $statement->bindValue(':CompanyEmail', "%$search%");
            } else {
                # Query in the database in order to select employees:
                $statement = $this->pdo->prepare('SELECT * FROM Employees ORDER BY emp_id DESC');
            }    
            # Make the query 
            $statement->execute();
            # Fetching
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    

        public function getEmployeeById($emp_id)
        {
            $statement = $this->pdo->prepare('SELECT * FROM Employees WHERE emp_id = :emp_id');
            $statement->bindValue(':emp_id',$emp_id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public function createEmployee(Employees $employee)
        {
            # Make an insert to the database of the superglobal $_POST data
            $statement = $this->pdo->prepare("INSERT INTO Employees (FirstName, LastName, Company, CompanyEmail, Phone) 
                                              VALUES (:FirstName, :LastName, :Company, :CompanyEmail, :Phone)");
                # Make the change in the database
                $statement->bindValue(':FirstName', $employee->FirstName);
                $statement->bindValue(':LastName', $employee->LastName);  
                $statement->bindValue(':Company', $employee->Company);
                $statement->bindValue(':CompanyEmail', $employee->CompanyEmail);
                $statement->bindValue(':Phone', $employee->Phone);
                $statement->execute();
        }

        public function updateEmployee(Employees $employee)
        {
                # Make an insert to the database of the superglobal $_POST data
                $statement = $this->pdo->prepare("UPDATE Employees SET FirstName=:FirstName, LastName=:LastName, Company=:Company, CompanyEmail=:CompanyEmail, Phone=:Phone WHERE emp_id = :emp_id");
                # Make the change in the database
                $statement->bindValue(':FirstName', $employee->FirstName);
                $statement->bindValue(':LastName', $employee->LastName);  
                $statement->bindValue(':Company', $employee->Company);
                $statement->bindValue(':CompanyEmail', $employee->CompanyEmail);
                $statement->bindValue(':Phone', $employee->Phone);
                $statement->bindValue(':emp_id', $employee->emp_id);
                $statement->execute();
        }

        public function deleteEmployee($emp_id)
        {
            $statement = $this->pdo->prepare('DELETE FROM Employees WHERE emp_id=:emp_id');
            $statement->bindValue(':emp_id',$emp_id);
            $statement->execute();
        }
    };   