<?php
namespace Module\controllers;
use Module\models\Salary;


class SalaryController extends BaseController{

    /**
     *
     * @var objSal
     */
    protected $objSal;

    /**
     * initialize salary object
     */
    public function set()
    {
        $this->objSal = new Salary();
    }

    /**
     * Salary list
     *
     * @author awlad <awladliton@gmail.com>
     * @return mixed
     */
    public function index()
    {
        $this->set();
        $arrSalary = $this->objSal->getAllSalary();
        return $this->renderPage("salary/list", $arrSalary);
    }

    /**
     * Salary Add form
     *
     * @author awlad <awladliton@gmail.com>
     * @param $id
     * @return mixed
     */
    public function add($id)
    {
        if (isset($id)) {
            $this->set();
            $arrSalary = $this->objSal->getSalaryByEmployee($id);
            if($arrSalary) {
                return $this->redirect('/salary/edit/'. $id);
            }
            else
            {
                return $this->renderPage('salary/form', ['arrSalary' => [], 'action' => 'salary/create/'. $id, 'type' => 'Add', 'id' => $id]);
            }

        }
        else
        {
            return $this->renderPage('salary/form', ['arrSalary' => [], 'action' => 'salary/create/'. $id, 'type' => 'Add', 'id' => $id]);
        }
    }

    /**
     * create new employee's salary
     *
     * @author awlad <awladliton@gmail.com>
     * @return mixed
     */
    public function create()
    {
        $this->set();
        $arrSal = [
            'employee_id'   =>  $_REQUEST['employee_id'],
            'basic_salary'  =>  $_REQUEST['basic_salary'],
            'house_rent'    =>  $_REQUEST['house_rent'],
            'allowance'     =>  $_REQUEST['allowance'],
            'income_tax'    =>  $_REQUEST['income_tax'],
            'net_salary'    =>  $_REQUEST['net_salary'],
            'grade'         =>  $_REQUEST['grade'],
        ];
        $addSalary = $this->objSal->addSalary($arrSal);
        if($addSalary === true) {
            $this->setFlash('Employee salary added successfully');
            return redirect('/salaries');
        }
        else {
            $this->setFlash("Error: "  + $addSalary);
            return redirect('/salaries');
        }

    }

    /**
     *
     * Delete an Salary
     * @author awlad <awladliton@gmail.com>
     * @param $id
     */
    public function destroy($id)
    {
        $this->set();
        $delete_result = $this->objSal->deleteSalary($id);
        if($delete_result === true) {
            $this->setFlash('Salary Deleted successfully');
            return redirect('/employee');
        }
        else {
            $this->setFlash("ERROR: " + $delete_result );
            return redirect('/employee');
        }

    }

    /**
     * Edit employee form
     * @author awlad <awladliton@gmail.com>
     * @param $id
     * @return string|void
     */
    public function edit($id)
    {
        $this->set();

        $arrSalary = $this->objSal->getSalaryByEmployee($id);
        if($arrSalary) {
            return renderPage('salary/form', ['arrSalary' => $arrSalary, 'id' => $id,  'action' => 'salary/update/' . $id, 'type' => 'Edit']);
        }
        else{
            $this->setFlash('Salary Not Found!');
            return redirect('/404');
        }

    }

    /**
     * Update Salary
     *
     * @author awlad <awladliton@gmail.com>
     * @param $id
     */
    public function update($id)
    {
        $this->set();
        $arrSal = [
            'employee_id'   =>  $_REQUEST['employee_id'],
            'basic_salary'  =>  $_REQUEST['basic_salary'],
            'house_rent'    =>  $_REQUEST['house_rent'],
            'allowance'     =>  $_REQUEST['allowance'],
            'income_tax'    =>  $_REQUEST['income_tax'],
            'net_salary'    =>  $_REQUEST['net_salary'],
            'grade'         =>  $_REQUEST['grade'],
        ];
        $update_result = $this->objSal->updateSalary($arrSal);
        if($update_result == true) {
            $this->setFlash('Salary updated successfully');
//            var_dump($_SESSION['flash.message']);die;
            return $this->redirect('/salaries');
        }
        else {
            $this->setFlash("Error: " + $update_result);
            return $this->redirect('/employee/edit/' . $id);
        }

    }
}
