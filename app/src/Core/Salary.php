<?php
/**
 * Created by PhpStorm.
 * User: hizbul
 * Date: 5/26/15
 * Time: 4:48 PM
 */

namespace Module\Core;


class Salary extends Database{

    public function addSalary($arrSalaryInfo) {
        try {
            $sql = "INSERT INTO salary(employee_id, basic_salary, house_rent, allowance, income_tax, net_salary, grade)
              VALUES(:employee_id, :basic_salary, :house_rent, :allowance, :income_tax, :net_salary, :grade)";
            $statement = $this->conn->prepare($sql);

//            $conn->bindParam(':employee_id', $arrSalaryInfo['employee_id'], \PDO::PARAM_INT);
//            $conn->bindParam(':basic_salary', $arrSalaryInfo['basic_salary'], \PDO::PARAM_INT);
//            $conn->bindParam(':house_rent', $arrSalaryInfo['house_rent'], \PDO::PARAM_INT);
//            $conn->bindParam(':allowance', $arrSalaryInfo['allowance'], \PDO::PARAM_INT);
//            $conn->bindParam(':income_tax', $arrSalaryInfo['income_tax'], \PDO::PARAM_INT);
//            $conn->bindParam(':net_salary', $arrSalaryInfo['net_salary'], \PDO::PARAM_INT);
//            $conn->bindParam(':grade', $arrSalaryInfo['grade'], \PDO::PARAM_STR);
            if($statement->execute($arrSalaryInfo)) {
                return true;
            }
            else {
                return $this->conn->errorInfo();
            }
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }

    public function getAllSalary()
    {
        try {
            $conn = $this->conn->prepare('SELECT s.*, e.name FROM salary s JOIN employees e ON  s.employee_id = e.id ');
            $conn->execute();
//
            return $conn->fetchAll(\PDO::FETCH_OBJ);
        }
        catch(\PDOException $ex) {
           return $ex->getMessage();
        }
    }

    public function employee_name($emp_id){
        $conn = $this->conn->prepare('SELECT * FROM employees WHERE id = :id LIMIT 1');
        $conn->bindParam(':id', $emp_id, \PDO::PARAM_INT);
        $conn->execute();
        $objEmp = $conn->fetch(\PDO::FETCH_OBJ);
        print_r($objEmp);
        die;
        return (count($objEmp) > 0) ?  $objEmp->name : "NULL";
    }

}