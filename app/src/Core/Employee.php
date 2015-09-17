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
            $sql = "INSERT INTO employees(name, address, contact_number, zip, salary) VALUES(:name, :address, :mobile, :zip, :salary)";
            $conn = $this->connect->prepare($sql);

            $conn->bindParam(':name', $arrEmployee['name'], \PDO::PARAM_STR);
            $conn->bindParam(':address', $arrEmployee['address'], \PDO::PARAM_STR);
            $conn->bindParam(':mobile', $arrEmployee['mobile'], \PDO::PARAM_STR);
            $conn->bindParam(':zip', $arrEmployee['zip'], \PDO::PARAM_STR);
            $conn->bindParam(':salary', $arrEmployee['salary'], \PDO::PARAM_INT);
            if($conn->execute()) {
                return true;
            }
            else {
                throw new \Exception("Employee data can't save successfully");
            }
        }
        catch(\PDOException $ex) {
            throw $ex;
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
            $conn = $this->connect->prepare('SELECT * FROM employees WHERE id = :id LIMIT 1');
            $conn->bindParam(':id', $id, \PDO::PARAM_INT);
            $conn->execute();
            if($conn->rowCount() > 0) {
                return $conn->fetch(\PDO::FETCH_ASSOC);
            }
            else{
                throw new \PDOException('No user found', 505);
            }
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }

    /**
     * update employee information
     *
     * @param $intId
     * @param $arrEmployee
     * @return bool
     *
     */
    public function updateEmployee($intId, $arrEmployee) {
        try {
            $id = (int) $intId;
            $query = "UPDATE employees SET name = :name, address = :address, contact_number = :contact_number, zip = :zip, salary = :salary WHERE id = :id";
            $conn = $this->connect->prepare($query);
            $conn->bindParam(':name', $arrEmployee['name'], \PDO::PARAM_STR);
            $conn->bindParam(':address', $arrEmployee['address'], \PDO::PARAM_STR);
            $conn->bindParam(':contact_number', $arrEmployee['mobile'], \PDO::PARAM_STR);
            $conn->bindParam(':zip', $arrEmployee['zip'], \PDO::PARAM_STR);
            $conn->bindParam(':salary', $arrEmployee['salary'], \PDO::PARAM_INT);
            $conn->bindParam(':id', $id, \PDO::PARAM_INT);

            return $conn->execute();
        }
        catch(\PDOException $ex) {
            throw $ex;
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
            $conn = $this->connect->prepare('SELECT * FROM employees');
            $conn->execute();
            if($conn->rowCount() > 0) {
                return $conn->fetchAll(\PDO::FETCH_OBJ);
            }
            else{
                throw new \PDOException('No Employee found', 505);
            }
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }

    public function deleteEmployee($id) {
        try {
            $conn = $this->connect->prepare('DELETE FROM employees WHERE id = :id');
            $conn->bindParam(':id', $id, \PDO::PARAM_INT);
            if($conn->execute()) {
                return true;
            }

            else{
                throw new \PDOException('No Employee found', 505);
            }
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }

}