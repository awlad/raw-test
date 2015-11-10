<?php

namespace Module\models;
/**
 * @author awlad
 * Class Employee
 * @package Module\Core
 */

class Employee extends Database{
    /**
     * @desc Add new employee
     *
     * @param array $arrEmployee
     * @return bool
     * @throws \Exception
     */
    public function addEmployee($arrEmployee) {
        try {
            $sql = "INSERT INTO employees(name, address, contact_number, zip_code, created_at, updated_at) VALUES(:name, :address, :contact_number, :zip_code, :created_at,:updated_at )";
            $statement = $this->conn->prepare($sql);
            $arrEmployee['created_at'] = date('Y-m-d H:i:s');
            $arrEmployee['updated_at'] = date('Y-m-d H:i:s');
            return $statement->execute($arrEmployee);
        }
        catch(\PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @desc get a single employee by id
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
        catch(\PDOException $e) {
            return  $e->getMessage();
        }
    }

    /**
     *@desc update employee
     *
     * @param $arrEmployee
     * @return bool
     */
    public function updateEmployee($arrEmployee) {
        try {

            $query = "UPDATE employees SET name = :name, address = :address, contact_number = :contact_number, zip_code = :zip_code, updated_at = :updated_at WHERE id = :id LIMIT 1";
            $statement = $this->conn->prepare($query);
            $arrEmployee['updated_at'] = date('Y-m-d H:i:s');
            return $statement->execute($arrEmployee);
        }
        catch(\PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     *@desc get all employee
     *
     * @return object employee
     *
     */
    public function getAllEmployee() {
        try {
            $conn = $this->conn->prepare('SELECT * FROM employees');
            $conn->execute();
            return $conn->fetchAll(\PDO::FETCH_OBJ);
        }
        catch(\PDOException $e) {
            $e->getMessage();
        }
    }

    /**
     * @desc delete an employee
     *
     * @param $id
     * @return bool
     */
    public function deleteEmployee($id) {
        try {

            $objSalStatement = $this->conn->prepare("DELETE FROM salary WHERE employee_id = :id");
            $statement = $this->conn->prepare('DELETE FROM employees WHERE id = :id LIMIT 1');
            $statement->bindParam(':id', $id, \PDO::PARAM_INT);
            $objSalStatement->bindParam(':id', $id, \PDO::PARAM_INT);
            $objSalStatement->execute();
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
