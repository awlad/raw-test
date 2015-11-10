<?php


/**
 * Load a layout
 *
 * @author awlad<awladliton@gmail.com>
 * @param string $layout
 * @return string
 */
function layout($layout = 'default.php')
{
    ob_start();
    include ROOT_DIR . 'views/layout/' .$layout;
    $html = ob_get_clean();
    return $html;
}

/**
 * Load a view
 *
 * @author awlad<awladliton@gmail.com>
 * @param string $_pageName
 * @param string $ext
 * @param array $data
 * @return string
 */
function renderPage($_pageName, array $data = array(), $ext = '.php', $layout = 'default.php', $title="SMS")
{
    extract($data);
    ob_start();
    include ROOT_DIR . 'views/' .$_pageName . $ext;
    $html = ob_get_clean();
    $title .= "| Supplier Management System";
    return str_replace(['{{{=yields_contents=}}}','{{{=yields_title=}}}'], [$html, $title], layout($layout));
}


/**
 * Load a single file
 *
 * @author awlad<awladliton@gmail.com>
 * @param $file
 * @param bool $return
 * @return string
 */
function asset($file, $return = false)
{
    $url = '//' . $_SERVER['HTTP_HOST'] . '/'. $file;
    if ($return === false) {
        echo $url;
    }

    return $url;
}

/**
 * Load all files from this directory
 *
 * @author awlad<awladliton@gmail.com>
 * @param $dirs
 * @param $string
 * @return string
 */
function assets($dirs, $string)
{
    $html = '';
    $originalDirs = ASSETS_DIR . $dirs;
    if ( file_exists($originalDirs) ) {
        $files = scandir($originalDirs);
        unset($files[0]); //remove .
        unset($files[1]); //remove ..
        foreach ($files as $file) {
            $file = 'assets/' . $dirs . '/' . $file;
            if ( is_dir($file) ) continue;
            $html .= str_ireplace('{link}', asset($file, true), $string);
        }
    }
    return $html;
}

/**
 * Load all java scripts
 *
 * @author awlad<awladliton@gmail.com>
 * @param $dirs
 * @return string
 */
function javaScripts($dirs)
{
    echo assets($dirs, '<script src="{link}"></script>');
}
/**
 * Load all css files
 *
 * @author awlad<awladliton@gmail.com>
 * @param $dirs
 * @return string
 */
function stylesheets($dirs)
{
    echo assets($dirs, '<link rel="stylesheet" href="{link}">');
}

/**
 * Generate a url
 *
 * @author awlad<awladliton@gmail.com>
 * @param $url
 */
function generate_url($url)
{
    echo '//' . $_SERVER['HTTP_HOST'] . '/'. $url;
}

/**
 * Redirect to a uri
 *
 * @author awlad<awladliton@gmail.com>
 * @param string $uri
 */
function redirect($uri = '/')
{
    header('Location: ' . $uri);
    exit;
}

/**
 * Flash a message to user or set a message for future use
 *
 * @author awlad<awladliton@gmail.com>
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

/**
 * get Flash message if present
 * @author awlad<awladliton@gmail.com>
 * @return bool
 */
function getFlash() {
    return isset($_SESSION['flash.message']) ? $_SESSION['flash.message'] : false;
}


/**
 * show flash message
 *
 * @author awlad<awladliton@gmail.com>
 * @params string $message
 * @params string $type
 *
 * @return string
 */

function getMessage($message, $type = 'success') {
    echo '<div class="alert alert-'.$type.'" role="alert">' . $message . '</div>';
}

/**
 * get value for inout field
 *
 * @author awlad<awladliton@gmail.com>
 * @param $arrData
 * @param string $key@author awlad<awladliton@gmail.com>
 */
function getFieldValue($arrData, $key="s") {
    if(is_array($arrData) && array_key_exists($key, $arrData)) {
        echo $arrData[$key];
    }
    else {
        echo '';
    }
}

/**
 * Get text for button e.g edit employee|salary
 * @author awlad<awladliton@gmail.com>
 * @param string $strType
 * @param string $btnType
 */
function getButtonText($strType = 'Add', $btnType = 'employee' ){
    echo $strType . ' ' . $btnType;
}

/**
 * get class for main menu
 *
 * @author awlad<awladliton@gmail.com>
 * @param $strUrl
 * @return string
 */
function getClass($strUrl) {

    echo $strUrl == $_SERVER['REQUEST_URI'] ? 'active' : '';
}
