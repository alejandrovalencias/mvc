<?php
/**
 * Clase Config.php
 */

/**
 * Clase que contiene los parámetros de configuración del sistema
 * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
 * @version 1
 */
class Config
{

    /**
     *
     * @var string Ruta del proyecto en el servidor
     */
    public $serverPath;

    /**
     *
     * @var string Usuario para la utenticación básica http
     */
    public $user;

    /**
     *  /**
     *
     * @var string Contraseña para la utenticación básica http
     */
    public $password;

    /**
     *
     * @var string
     */
    public $xsdFileList;

    /**
     *
     * @var array
     */
    public $errors;
    /**
     *
     * @var Config instancia actual del objeto
     */
    private static $_instancia;

    /**
     * Constructor de la clase
     *
     * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
     * @version 1
     * @return \Config
     * @access private
     */
    private function __construct()
    {
        $this->user = 'user';
        $this->password = 'pass';
        $this->serverPath = '';
        $this->errors = array(
            0 => "Error: Campo requerido <br />",
            1 => "Error: La ruta del servidor ingresada no existe  <br />"

        );
    }

    /**
     * Función que permite el uso del patron singleton y solo permite una instancia del objeto
     * @return Config
     */
    public static function getInstance()
    {
        if (!self::$_instancia instanceof self) {
            self::$_instancia = new self;
        }
        return self::$_instancia;
    }
}