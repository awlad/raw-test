<?php
namespace Module\controllers;

abstract class BaseController {

    public function renderPage($_pageName, array $data = array(), $ext = '.php', $layout = 'default.php', $title="SMS")
    {
        extract($data);
        ob_start();
        include ROOT_DIR . 'views/' .$_pageName . $ext;
        $html = ob_get_clean();
        $title .= "| Supplier Management System";
        return str_replace(['{{{=yields_contents=}}}','{{{=yields_title=}}}'], [$html, $title], layout($layout));
    }

    public function redirect($uri ='/')
    {
        header('Location: ' . $uri);
        exit;
    }

    /**
     * Flash a message to user or set a message for future use
     *
     * @param null $message
     * @return null
     */
    function setFlash($message = null)
    {
        $flash = $message;
        if ($message === null && isset($_SESSION['flash.message'])) {
            $flash = $_SESSION['flash.message'];
            unset($_SESSION['flash.message']);
        } else {
            $_SESSION['flash.message'] = $message;
        }

        return $flash;
    }

}