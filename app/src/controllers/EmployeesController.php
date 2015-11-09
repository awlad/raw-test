<?php
namespace Module\controllers;
use Module\Core\Employee;
use Module\Core\Salary;

class EmployeesController extends BaseController{

    protected $objEmp;

    public function set()
    {
        $this->objEmp = new Employee();
    }

    public function index()
    {
        $this->set();
        $arrEmployee = $this->objEmp->getAllEmployee();
        return $this->renderPage("employee/list", $arrEmployee);
    }

    public function add()
    {
        return $this->renderPage('employee/add_edit', ['arrEmployee' => [], 'action' => 'employee/create', 'type' => 'Add']);
    }

    public function create()
    {
        $this->set();
        $addResult = $this->objEmp->addEmployee(
            [
                'name'              => $_REQUEST['name'],
                'address'           => $_REQUEST['address'],
                'contact_number'    => $_REQUEST['contact_number'],
                'zip_code'          => $_REQUEST['zip_code']
            ]
        );

        if($addResult === true) {
            setFlash('New employee added.');
            $arrEmployee = $this->objEmp->getAllEmployee();
            return $this->renderPage('employee/list', $arrEmployee);

        }
        else {
            setFlash("Error: "  + $addResult);
//                    return "Error: "  + $addResult;
        }

    }
    public function edit($id)
    {
        $this->set();

        $arrEmployee = $this->objEmp->getEmployeeById($id);
        if($arrEmployee) {
            return renderPage('employee/add_edit', ['arrEmployee' => $arrEmployee, 'action' => 'employee/update/' . $id, 'type' => 'Edit']);
        }
        else{
            setFlash('Employee Not Found!');
            return redirect('/404');
        }

    }

    public function update($id)
    {
        $this->set();
        $arrUpdateInfo =  [
            'name'              => $_REQUEST['name'],
            'address'           => $_REQUEST['address'],
            'contact_number'    => $_REQUEST['contact_number'],
            'zip_code'          => $_REQUEST['zip_code'],
            'id'                => $id
        ];
        $update_result = $this->objEmp->updateEmployee($arrUpdateInfo);
        if($update_result === true) {
            setFlash('Employee updated successfully');
            return $this->redirect('/employee');
        }
        else {
            setFlash("Error: " + $update_result);
            return $this->redirect('/employee/edit/' . $id);
        }

    }

    public function destroy($id)
    {
        $this->set();
        $delete_result = $this->objEmp->deleteEmployee($id);
        if($delete_result === true) {
            setFlash('Employee Deleted successfully');
            return redirect('/employee');
        }
        else {
            setFlash("ERROR: " + $delete_result );
            return redirect('/employee');
        }

    }
}
