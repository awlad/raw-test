<?php
use Module\Core\Employee;
use Module\Core\Salary;

$request_handler = \Module\App::requestHandler();


/**
 * home page
 *
 */
$request_handler->respond('GET', '/', function() {
    return renderPage('welcome/welcome');
});

/**
 * 404
 */
$request_handler->respond('GET', '/404', function() {
    return renderPage('errors/404', ['error' => 404]);
});



####################################################################################
########################## EMPLOYEE SECTION  #######################################
####################################################################################

/**
 * display add employee form using get method
 * add employee data using post method
 *
 */
$request_handler->respond(['GET', 'POST'], '/employee/add', function($request) {
    switch($request->method()) {
        case 'GET':
            return renderPage('employee/add_edit', ['arrEmployee' => [], 'action' => 'employee/add', 'type' => 'Add']);
            break;
        case 'POST':
            try{
                $objEmployee = new Employee();
                $addResult = $objEmployee->addEmployee(
                    [
                        'name'              => $request->name,
                        'address'           => $request->address,
                        'contact_number'    => $request->contact_number,
                        'zip_code'          => $request->zip_code,
                        'salary'            => $request->salary,
                    ]
                );

                if($addResult === true) {
                    setFlash('New employee added.');
                    $arrEmployee = $objEmployee->getAllEmployee();

                    return renderPage('employee/list', $data = $arrEmployee);

                }
                else {
                    setFlash("Error: "  + $addResult);
//                    return "Error: "  + $addResult;
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
            return renderPage('employee/list', $data = $arrEmployee);
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
            else{
                setFlash('Employee Not Found!');
                return redirect('/404');
            }
            break;
        case 'POST':
            $arrUpdateInfo =  [
                'name'              => $request->name,
                'address'           => $request->address,
                'contact_number'    => $request->contact_number,
                'zip_code'          => $request->zip_code,
                'salary'            => $request->salary,
                'id'                => $request->id
            ];
            $objEmployee = new Employee();
            $update_result = $objEmployee->updateEmployee($arrUpdateInfo);
            if($update_result === true) {
                setFlash('Employee updated successfully');
                return redirect('/employee/list');
            }
            else {
                setFlash("Error: " + $update_result);
                return redirect('/employee/edit/' . $request->id);
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
            $delete_result = $objEmployee->deleteEmployee(5000);

            if($delete_result === true) {
                setFlash('Employee Deleted successfully');
                return redirect('/employee/list');
            }
            else {
                setFlash("ERROR: " + $delete_result );
                return redirect('/employee/list');
            }
            break;
        case 'POST':
            break;
    }
});

####################################################################################
########################## END EMPLOYEE SECTION  ###################################
####################################################################################



####################################################################################
########################## SALARY SECTION  #########################################
####################################################################################

/**
 * List salary
 */
$request_handler->respond(['GET', 'POST'], '/salary/list', function($request) {
    switch($request->method()) {
        case 'GET':
            $objSalary = new Salary();
            $arrSalary = $objSalary->getAllSalary();

            return renderPage('salary/list', $data = $arrSalary);
            break;
        case 'POST':
            break;
    }
});


/**
 * add salary
 *
 */
$request_handler->respond(['GET', 'POST'], '/salary/add/[:id]', function($request) {
    switch($request->method()) {
        case 'GET':
            $objSalary = new Salary();
            $arrSalary = $objSalary->getSalaryByEmployee($request->id);
            if($arrSalary) {
                return redirect('/salary/edit/'. $request->id);
            }
            else {
                return renderPage('salary/add', ['arrSalary' => [], 'type' => 'Add', 'id' => $request->id]);
            }
            break;
        case 'POST':
            try{
                $objSalary = new Salary();
                $addSalary = $objSalary->addSalary(
                    [
                        'employee_id'   => (int) $request->employee_id,
                        'basic_salary'  =>  $request->basic_salary,
                        'house_rent'    =>  $request->house_rent,
                        'allowance'     =>  $request->allowance,
                        'income_tax'    =>  $request->income_tax,
                        'net_salary'    =>  $request->net_salary,
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

/**
 * edit salary
 */
$request_handler->respond(['GET', 'POST'], '/salary/edit/[:id]', function($request) {
    switch($request->method()) {
        case 'GET':
            $objSalary = new Salary();
            $arrSalary = $objSalary->getSalaryByEmployee($request->id);
            if($arrSalary) {
                return renderPage('salary/add', ['arrSalary' => $arrSalary, 'action' => 'salary/edit/' . $request->id, 'type' => 'Edit', 'id' => $request->id]);
            }
            else{
                setFlash('Salary Not Found!');
                return redirect('/404');
            }
            break;
        case 'POST':
            $arrUpdateInfo =  [
                'basic_salary'   => $request->basic_salary,
                'house_rent'     => $request->house_rent,
                'allowance'      => $request->allowance,
                'income_tax'     => $request->income_tax,
                'net_salary'     => $request->net_salary,
                'grade'          => $request->grade,
                'employee_id'    => (int)$request->employee_id
            ];
            $objSalary = new Salary();
            $update_result = $objSalary->updateSalary($arrUpdateInfo);
            if($update_result === true) {
                setFlash('salary updated successfully');
                return redirect('/salary/list');
            }
            else {
                setFlash("Error: " . $update_result);
                return redirect('/salary/edit/' . $request->id);
            }
            break;
    }
});

####################################################################################
########################## END SALARY SECTION  #####################################
####################################################################################


$request_handler->onHttpError(function ($code, $router) {
    if ($code >= 400 && $code < 500) {
        $router->response()->body(
            'Oh no, a bad error happened that caused a '. $code
        );
    } elseif ($code >= 500 && $code <= 599) {
        error_log('uhhh, something bad happened');
    }
});

$request_handler->dispatch();
