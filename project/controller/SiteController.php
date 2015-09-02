<?php

/**
 * Class SiteController.php
 */
class SiteController extends Controller
{

    /**
     * Constructor de la clase
     *
     * @author  Sergio Alejandro Valencia López <alejandrov.net@gmail.com>
     * @version 1
     * @copyright alejandrov.net
     * @return \SiteController
    @access public
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $arrResult = [];
        $bolQuery = false;
        $error = [];

        if (isset($_POST['txtDocument'])) {
            if (!empty($_POST['txtDocument'])) {
                $bolQuery = true;
                $objConection = new Conection();

                $sql = 'SELECT  usu_id
                            ,usu_nombres
                            ,usu_apellidos
                            ,usu_email
                    FROM usuario
                    WHERE usu_id =:usu_id';
                error_reporting(E_ERROR | E_WARNING | E_PARSE);
                $objConection->query($sql);
                $objConection->bind(':usu_id', $_POST['txtDocument']);
                $arrResult = (array)$objConection->single();

                if (isset($arrResult[0]) && (string)$arrResult[0] === '') {
                    $arrResult = [];
                }
            } else {
                $error[] = $this->config->errors[0];
            }
        }

        $this->render(
            'example.php', ['data' => $arrResult
                , 'query' => $bolQuery
                , 'error' => $error]
        );
    }

}