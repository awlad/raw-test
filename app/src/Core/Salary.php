<?php

namespace Module\Core;

/**
 * @author awlad
 * Class Salary
 * @package Module\Core
 */

class Salary extends Database{

    /**
     * @desc add salary of an employee
     * @param $arrSalaryInfo
     * @return bool|string
     */
    public function addSalary($arrSalaryInfo) {
        try {
            $sql = "INSERT INTO salary(employee_id, basic_salary, house_rent, allowance, income_tax, net_salary, grade)
              VALUES(:employee_id, :basic_salary, :house_rent, :allowance, :income_tax, :net_salary, :grade)";
            $objStatement = $this->conn->prepare($sql);
            return $objStatement->execute($arrSalaryInfo);
        }
        catch(\PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @desc get all salary with employee name
     * @return array|string
     */
    public function getAllSalary()
    {
        try {
            $objStatement = $this->conn->prepare('SELECT s.*, e.name FROM salary s JOIN employees e ON  s.employee_id = e.id ');
            $objStatement->execute();
            return $objStatement->fetchAll(\PDO::FETCH_OBJ);
        }
        catch(\PDOException $ex) {
           return $ex->getMessage();
        }
    }

    /**
     * @desc get salary object by an employee id
     * @param $employee_id
     * @return mixed|Object
     */
    public function getSalaryByEmployee($employee_id)
    {

        $strSql = 'SELECT * FROM salary where employee_id = :id limit 1';
        try{
            $objStatement = $this->conn->prepare($strSql);
            $objStatement->bindParam(':id', $employee_id, \PDO::PARAM_INT);
            $objStatement->execute();
            return $objStatement->fetch(\PDO::FETCH_ASSOC);

        }
        catch(\PDOException $ex) {
            return  $ex->getMessage();
        }
    }

    /**
     * @desc update salary of an employee
     * @param $arrSalary
     * @return bool|string
     *
     */
    public function updateSalary($arrSalary)
    {
        try {
            $strSql = 'UPDATE salary SET basic_salary = :basic_salary,' .
                ' house_rent = :house_rent, allowance = :allowance,'.
                ' income_tax = :income_tax, net_salary = :net_salary,'.
                ' grade = :grade '.
                ' WHERE employee_id = :employee_id LIMIT 1';
            $objStatement = $this->conn->prepare($strSql);
            return $objStatement->execute($arrSalary);
        }
        catch(\PDOException $ex) {
            return $ex->getMessage();
        }

    }
}
