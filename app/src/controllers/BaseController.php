<?php
namespace Module\controllers;

abstract class BaseController {

    public function renderPage($_pageName, array $data = array(), $ext = '.php', $layout = 'default.php')
    {
        extract($data);
        ob_start();
        include ROOT_DIR . 'views/' .$_pageName . $ext;
        $html = ob_get_clean();
        return str_replace('{{=yields=}}', $html, layout($layout));
    }

    public function redirect($uri ='/')
    {
        header('Location: ' . $uri);
        exit;
    }
}