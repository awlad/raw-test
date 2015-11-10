<?php
namespace Module\controllers;
use Module\models\Employee;



class EmployeesController extends BaseController{

    /**
     *
     * @var objEmp
     */
    protected $objEmp;
    protected $strana;


    function  __construct(){
        $this->set();

    }
    /**
     * initialize employee object
     */
    public function set()
    {
        $this->objEmp = new Employee();
        $this->strana = new \Strana\Paginator();
    }

    /**
     * Employee list
     *
     * @author awlad <awladliton@gmail.com>
     * @return mixed
     */
    public function index()
    {
        $arrEmployee = $this->objEmp->getAllEmployee();
        return $this->renderPage("employee/list", $arrEmployee);
    }

    /**
     * Employee Add form
     *
     * @author awlad <awladliton@gmail.com>
     * @return mixed
     */
    public function add()
    {
        return $this->renderPage('employee/form', ['arrEmployee' => [], 'action' => 'employee/create', 'type' => 'Add']);
    }

    /**
     * create new employee
     *
     * @author awlad <awladliton@gmail.com>
     * @return mixed
     */
    public function create()
    {
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
            return redirect('/employees');

        }
        else {
            setFlash("Error: "  + $addResult);
        }

    }

    /**
     *
     * Delete an Employee
     * @author awlad <awladliton@gmail.com>
     * @param $id
     */
    public function destroy($id)
    {
        $delete_result = $this->objEmp->deleteEmployee($id);
        if($delete_result === true) {
            setFlash('Employee Deleted successfully');
            return redirect('/employees');
        }
        else {
            setFlash("ERROR: " + $delete_result );
            return redirect('/employees');
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

        $arrEmployee = $this->objEmp->getEmployeeById($id);
        if($arrEmployee) {
            return renderPage('employee/form', ['arrEmployee' => $arrEmployee, 'action' => 'employee/update/' . $id, 'type' => 'Edit']);
        }
        else{
            setFlash('Employee Not Found!');
            return redirect('/404');
        }

    }

    /**
     * Update Employee
     *
     * @author awlad <awladliton@gmail.com>
     * @param $id
     */
    public function update($id)
    {
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
            return $this->redirect('/employees');
        }
        else {
            setFlash("Error: " + $update_result);
            return $this->redirect('/employee/edit/' . $id);
        }

    }
}
