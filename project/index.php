<?php
session_start();
/**
 *  Archivo que inicia todo el
 */

/**
 * Función que realiza la autocarga de clases y archivos
 * @param string $className 
 */
function __autoload($className)
{
    $file = dirname(__FILE__) . '/../class/' . $className . '.php';

    if (!file_exists($file)) {
        $file = dirname(__FILE__) . '/controller/' . $className . '.php';
        if (!file_exists($file)) {
            $file = dirname(__FILE__) . '/config/' . $className . '.php';
            if (file_exists($file)) {
                require_once $file;
            }
        } else {
            require_once $file;
        }
    } else {
        require_once $file;
    }
}

// index.php?site=maria
$controller = new SiteController();
$controller->index();