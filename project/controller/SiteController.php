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
     * @access public
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

    public function insert()
    {
        $value = 26;
        $date = date('Y-m-d');

        $sql = "INSERT INTO meta (met_fecCreacion,met_valor) VALUES (:date ,:value)";

        $objConection = new Conection();
        $objConection->query($sql);
        $objConection->bind(':date', $date);
        $objConection->bind(':value', $value);
        if ($objConection->execute() == 1) {
            return true;
        }
        return false;
    }

    public function update()
    {
        $value = 250;
        $date = date('Y-m-d h:i:s');
        $intId = 141;

        $sql = "UPDATE meta
                 SET met_fecCreacion=:date, met_valor=:value
                 WHERE met_id=:id";

        $objConection = new Conection();
        $objConection->query($sql);
        $objConection->bind(':date', $date);
        $objConection->bind(':value', $value);
        $objConection->bind(':id', $intId);
        if ($objConection->execute() == 1) {
            return true;
        }
        return false;
    }

}