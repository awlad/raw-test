<?php
/**
 * Routing functionality
 * @author awlad <awladliton@gmail.com>
 */
use Pux\RouteExecutor;
$mux = new Pux\Mux;


$mux = new Pux\Mux;


##################################Welcome Section ##############################
#################################################################################

$mux->get('', ['Module\controllers\WelcomeController','home']);
$mux->get('\404', ['Module\controllers\WelcomeController','not_found']);

##################################Employee Section ##############################
#################################################################################
$mux->get('/employees', ['Module\controllers\EmployeesController','index']);
$mux->get('/employee/add', ['Module\controllers\EmployeesController','add']);
$mux->post('/employee/create', ['Module\controllers\EmployeesController','create']);
$mux->get('/employee/edit/:id', ['Module\controllers\EmployeesController','edit'],['require' => [ 'id' => '\d+']]);
$mux->post('/employee/update/:id', ['Module\controllers\EmployeesController','update'],['require' => [ 'id' => '\d+']]);
$mux->get('/employee/remove/:id', ['Module\controllers\EmployeesController','destroy'], ['require' => [ 'id' => '\d+']]);


##################################End Employee Section ##############################
#####################################################################################


##################################SalaryController Section ##############################
#################################################################################
$mux->get('/salaries', ['Module\controllers\SalaryController','index']);
$mux->get('/salary/add/:id', ['Module\controllers\SalaryController','add'], ['require' => [ 'id' => '\d+']]);
$mux->post('/salary/create/:id', ['Module\controllers\SalaryController','create']);
$mux->get('/salary/edit/:id', ['Module\controllers\SalaryController','edit'],['require' => [ 'id' => '\d+']]);
$mux->post('/salary/update/:id', ['Module\controllers\SalaryController','update'],['require' => [ 'id' => '\d+']]);
$mux->get('/salary/remove/:id', ['Module\controllers\SalaryController','destroy'], ['require' => [ 'id' => '\d+']]);


##################################End salary Section ##############################
#####################################################################################


#dispatch result
$route = $mux->dispatch(rtrim($_SERVER["REQUEST_URI"], '/'));
//$strUri = strlen($_SERVER["REQUEST_URI"]) > 1 ?  rtrim($_SERVER["REQUEST_URI"], '/') : '/home';
//$route = $mux->dispatch($strUri);
if ($route){
    echo RouteExecutor::execute($route);
}
else {
 echo renderPage('errors/404');
}



