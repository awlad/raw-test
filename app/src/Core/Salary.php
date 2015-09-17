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
            $sql = "INSERT INTO salary(employee_id, basic_salary, house_rent, allowance, income_tax, net_salary, grade) VALUES(:employee_id, :basic_salary, :house_rent, :allowance, :income_tax, :net_salary, :grade)";
            $conn = $this->connect->prepare($sql);

            $conn->bindParam(':employee_id', $arrSalaryInfo['employee_id'], \PDO::PARAM_INT);
            $conn->bindParam(':basic_salary', $arrSalaryInfo['basic_salary'], \PDO::PARAM_INT);
            $conn->bindParam(':house_rent', $arrSalaryInfo['house_rent'], \PDO::PARAM_INT);
            $conn->bindParam(':allowance', $arrSalaryInfo['allowance'], \PDO::PARAM_INT);
            $conn->bindParam(':income_tax', $arrSalaryInfo['income_tax'], \PDO::PARAM_INT);
            $conn->bindParam(':net_salary', $arrSalaryInfo['net_salary'], \PDO::PARAM_INT);
            $conn->bindParam(':grade', $arrSalaryInfo['grade'], \PDO::PARAM_STR);
            if($conn->execute()) {
                return true;
            }
            else {
                throw new \Exception("Salary data can't save successfully");
            }
        }
        catch(\PDOException $ex) {
            throw $ex;
        }
    }

}