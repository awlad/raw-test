<?php
/**
 * Created by PhpStorm.
 * User: hizbul
 * Date: 5/26/15
 * Time: 12:26 PM
 */

namespace Module\Core;


class Employee extends Database{
    /**
     * Add employee information
     *
     * @param array $arrEmployee
     * @return bool
     * @throws \Exception
     */
    public function addEmployee(array $arrEmployee) {
        try {
            $sql = "INSERT INTO employees(name, address, contact_number, zip_code, salary) VALUES(:name, :address, :contact_number, :zip_code, :salary)";
            $statement = $this->conn->prepare($sql);

//            $conn->bindParam(':name', $arrEmployee['name'], \PDO::PARAM_STR);
//            $conn->bindParam(':address', $arrEmployee['address'], \PDO::PARAM_STR);
//            $conn->bindParam(':mobile', $arrEmployee['mobile'], \PDO::PARAM_STR);
//            $conn->bindParam(':zip_code', $arrEmployee['zip_code'], \PDO::PARAM_STR);
//            $conn->bindParam(':salary', $arrEmployee['salary'], \PDO::PARAM_INT);

            if($statement->execute($arrEmployee)) {
                return true;
            }
            else {
//                return print_r($this->conn->errorInfo());
                return $this->conn->errorInfo();
            }
        }
        catch(\PDOException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * get a single employee by id
     *
     * @param $id
     * @return object employee
     *
     */
    public function getEmployeeById($id) {
        try {
            $conn = $this->conn->prepare('SELECT * FROM employees WHERE id = :id LIMIT 1');
            $conn->bindParam(':id', $id, \PDO::PARAM_INT);
            $conn->execute();
            return $conn->fetch(\PDO::FETCH_ASSOC);

        }
        catch(\PDOException $ex) {
            return  $ex->getMessage();
        }
    }

    /**
     * update employee information
     *
     * @param $arrEmployee
     * @return bool
     */
    public function updateEmployee($arrEmployee) {
        try {
            $query = "UPDATE employees SET name = :name, address = :address, contact_number = :contact_number, zip_code = :zip_code, salary = :salary WHERE id = :id";
            $statement = $this->conn->prepare($query);
//            $conn->bindParam(':name', $arrEmployee['name'], \PDO::PARAM_STR);
//            $conn->bindParam(':address', $arrEmployee['address'], \PDO::PARAM_STR);
//            $conn->bindParam(':contact_number', $arrEmployee['mobile'], \PDO::PARAM_STR);
//            $conn->bindParam(':zip_code', $arrEmployee['zip_code'], \PDO::PARAM_STR);
//            $conn->bindParam(':salary', $arrEmployee['salary'], \PDO::PARAM_INT);
//            $conn->bindParam(':id', $id, \PDO::PARAM_INT);
           if ($statement->execute($arrEmployee)){
               return true;
           }
            else {
                return $this->conn->errorInfo();
            }
        }
        catch(\PDOException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Get all employee
     *
     * @params none
     * @return object employee
     *
     */
    public function getAllEmployee() {
        try {
            $conn = $this->conn->prepare('SELECT * FROM employees');
            $conn->execute();
            return $conn->fetchAll(\PDO::FETCH_OBJ);
        }
        catch(\PDOException $ex) {
            $ex->getMessage();
        }
    }

    /**
     * delete an employee
     * @param $id
     * @return bool
     */
    public function deleteEmployee($id) {
        try {
            $statement = $this->conn->prepare('DELETE FROM employees WHERE id = :id');
            $statement->bindParam(':id', $id, \PDO::PARAM_INT);
            $statement->execute();
            if($statement->rowCount() > 0) {
                return true;
            }
            else{
                return "Employee not found with Id: $id";
            }
        }
        catch(\PDOException $ex) {
          return  $ex->getMessage();
        }
    }

}