<?php

use Pux\RouteExecutor;
$mux = new Pux\Mux;

class ProductController {
    public function listAction() {
        return  'product list';
    }
    public function itemAction($id) {
        return "product $id";
    }
}
$mux = new Pux\Mux;
//var_dump($mux);
$mux->get('/employee', ['Module\controllers\EmployeesController','index']);
$mux->get('/employee/add', ['Module\controllers\EmployeesController','add']);
$mux->post('/employee/create', ['Module\controllers\EmployeesController','create']);
$mux->get('/employee/edit/:id', ['Module\controllers\EmployeesController','edit'],['require' => [ 'id' => '\d+']]);
$mux->post('/employee/update/:id', ['Module\controllers\EmployeesController','update'],['require' => [ 'id' => '\d+']]);
$mux->get('/employee/remove/:id', ['Module\controllers\EmployeesController','destroy'], ['require' => [ 'id' => '\d+']]);
$mux->get('/product/:id', ['ProductController','itemAction'] , [
    'require' => [ 'id' => '\d+', ],
    'default' => [ 'id' => '1', ]
]);
$route = $mux->dispatch($_SERVER["REQUEST_URI"]);
if ($route){
    echo RouteExecutor::execute($route);
}
else {
 echo renderPage('errors/404');
}



