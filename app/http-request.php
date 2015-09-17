<?php
use Module\Core\Employee;
use Module\Core\Salary;

$request_handler = \Module\App::requestHandler();

/**
 * display home page using get method
 *
 */
$request_handler->respond(['GET', 'POST'], '/', function($request) {
    switch($request->method()) {
        case 'GET':
            return renderPage('welcome/welcome');
            break;
        case 'POST':
            break;
    }
});


/**
 * display add employee form using get method
 * add employee data using post method
 *
 */
$request_handler->respond(['GET', 'POST'], '/employee/add', function($request) {
    switch($request->method()) {
        case 'GET':
            return renderPage('employee/add_edit', ['action' => 'employee/add', 'type' => 'Add']);
            break;
        case 'POST':
            try{
                $objEmployee = new Employee();
                $addEmployee = $objEmployee->addEmployee(
                    [
                        'name'      => $request->name,
                        'address'   => $request->address,
                        'mobile'    => $request->mobile,
                        'zip'       => $request->zip,
                        'salary'    => (int) $request->salary,
                    ]
                );

                if($addEmployee === true) {
                    setFlash('Employee added successfully');
                    $arrEmployee = $objEmployee->getAllEmployee();
                    if($arrEmployee) {
                        return renderPage('employee/list', $data = $arrEmployee);
                    }
                }

            }
            catch(Exception $ex) {
                setFlash($ex->getMessage());
            }
            break;
    }
});

/**
 * show employee list using get method
 *
 */
$request_handler->respond(['GET', 'POST'], '/employee/list', function($request) {
    switch($request->method()) {
        case 'GET':
            $objEmployee = new Employee();
            $arrEmployee = $objEmployee->getAllEmployee();
            if($arrEmployee) {
                return renderPage('employee/list', $data = $arrEmployee);
            }
            break;
        case 'POST':
            break;
    }
});


/**
 * show employee edit form using get method
 * update employee information by post method
 *
 */
$request_handler->respond(['GET', 'POST'], '/employee/edit/[:id]', function($request) {
    switch($request->method()) {
        case 'GET':
            $objEmployee = new Employee();
            $arrEmployee = $objEmployee->getEmployeeById($request->id);
            if($arrEmployee) {
                return renderPage('employee/add_edit', ['arrEmployee' => $arrEmployee, 'action' => 'employee/edit/' . $request->id, 'type' => 'Edit']);
            }
            break;
        case 'POST':
            $arrUpdateInfo =  [
                'name'      => $request->name,
                'address'   => $request->address,
                'mobile'    => $request->mobile,
                'zip'       => $request->zip,
                'salary'    => (int) $request->salary,
            ];
            $objEmployee = new Employee();
            $blnUpdate = $objEmployee->updateEmployee($request->id, $arrUpdateInfo);
            if($blnUpdate === true) {
                setFlash('Employee updated successfully');
                return redirect('/employee/list');
            }
            break;
    }
});

/**
 *
 * delete employee by get method using employee id
 */
$request_handler->respond(['GET', 'POST'], '/employee/delete/[:id]', function($request) {
    switch($request->method()) {
        case 'GET':
            $objEmployee = new Employee();
            $blnDelete = $objEmployee->deleteEmployee($request->id);
            if($blnDelete) {
                setFlash('Employee Deleted successfully');
                return redirect('/employee/list');            }
            break;
        case 'POST':
            break;
    }
});

/**
 * display add salary form using get method
 * add salary data using post method
 *
 */
$request_handler->respond(['GET', 'POST'], '/salary/add/[:id]', function($request) {
    switch($request->method()) {
        case 'GET':
            return renderPage('salary/add', ['id' => $request->id]);
            break;
        case 'POST':
            try{
                $objSalary = new Salary();
                $addSalary = $objSalary->addSalary(
                    [
                        'employee_id'   => (int) $request->employee_id,
                        'basic_salary'  => (int) $request->basic_salary,
                        'house_rent'    => (int) $request->house_rent,
                        'allowance'     => (int) $request->allowance,
                        'income_tax'    => (int) $request->income_tax,
                        'net_salary'    => (int) $request->net_salary,
                        'grade'         =>  $request->grade,
                    ]
                );

                if($addSalary === true) {
                    setFlash('Employee salary added successfully');
                    return redirect('/employee/list');
                }

            }
            catch(Exception $ex) {
                setFlash($ex->getMessage());
            }
            break;
    }
});

$request_handler->dispatch();