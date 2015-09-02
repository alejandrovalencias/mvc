<?php
/**
 * Clase Controller.php
 */

/**
 * @author Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
 * @version 1
 */
class Controller
{
    /**
     *
     * @var Config configuración del sistema
     */
    public $config;

    /**
     * Constructor de la clase
     *
     * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
     * @version   1
     * @return \Controller
     * @access public
     */
    public function __construct()
    {
        $this->config = Config::getInstance();
//       $this->basicAuthentication();
    }

    /**
     * Funcion desctructora
     * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
     * @version 1
     * @return void
     * @access public
     *
     */
    public function __destruct()
    {

    }

    /**
     * Función que despliega la vista
     *
     * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
     * @return void
     * @access public
     * @param string $file
     * @param array $params
     */
    public function render($file, $params = array())
    {
        $form = '';
        try {
            //obtiene la vista
            require(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $file);
            //despliega la vista en pantalla
        } catch (Exception $e) {
            $form = $e->getMessage();
        }
    }

    /**
     * Función que valida autenticación básica para no permitir ejecutar el script a usuario no
     * autorizados.
     * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
     * @version 1
     * @return void
     * @access public
     */
    public function basicAuthentication()
    {
        $login = $this->config->user;
        $pass = $this->config->password;

        if (($_SERVER['PHP_AUTH_PW'] != $pass || $_SERVER['PHP_AUTH_USER'] != $login) || !$_SERVER['PHP_AUTH_USER']) {
            header('WWW-Authenticate: Basic realm="Test auth"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Auth failed';
            exit;
        }
    }
}