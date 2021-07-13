<?php
require_once '../conexion.php';
class Tables
{
    public static function ajaxObtenerIdPeriodo($inicio_periodo, $fin_periodo)
    {
        try {
            $query = Conexion::conexion()->prepare("SELECT idperiodos from periodos WHERE inicio=:inicio AND fin=:fin");
            $query->execute(["inicio" => $inicio_periodo, "fin" => $fin_periodo]);
            if ($query->rowCount() > 0) {
                $idPeriodo = $query->fetchColumn();
                Tables::ajaxObtenerIdMatricula($idPeriodo);
            } else {
                echo "No se ecnontro nada";
            }
        } catch (PDOException $e) {
            echo "Error";
        }
    }
    public static function ajaxObtenerIdMatricula($idPeriodo)
    {
        try {
            $query = Conexion::conexion()->prepare("SELECT idMatricula FROM matricula WHERE periodos_idperiodos=:idperiodo");
            $query->execute(["idperiodo" => $idPeriodo]);
            if ($query->rowCount() > 0) {
                $idMatricula = $query->fetchColumn();
                Tables::ajaxObtenerData($idMatricula);
            }
        } catch (PDOException $e) {
        }
    }
    public static function ajaxObtenerData($idMatricula)
    {
        try {
            $query = Conexion::conexion()->prepare("SELECT * FROM m_variables WHERE matricula_idmatricula=:idmatricula");
            $query->execute(["idmatricula" => $idMatricula]);
            if ($query->rowCount() > 0) {
                $variables = Tables::ajaxObtenerVariables();
                Tables::sendResponse($variables, $query->fetchAll());
            }
        } catch (PDOException $e) {
        }
    }
    public static function ajaxObtenerVariables()
    {
        try {
            $query = Conexion::conexion()->prepare("SELECT * FROM variables");
            $query->execute();
            if ($query->rowCount() > 0) {
                return $query->fetchAll();
            }
        } catch (PDOException $e) {
        }
    }
    public static function sendResponse($variables, $data)
    {
        $arrayData = array();
        for ($i = 0; $i < count($data); $i++) {
            array_push($arrayData, ["periodo" => $_POST["infoPeriodo"], "variables" => $variables[$i]["nombre"], "valor" => $data[$i]["valor"], "valor_porcentual" => $data[$i]["porcentaje"]]);
        }
        echo json_encode($arrayData);
    }
}
if (isset($_POST["infoPeriodo"])) {
    $periodo = $_POST["infoPeriodo"];
    $arrayPeriodos = explode('-', $periodo);
    $inicio = $arrayPeriodos[0];
    $fin = $arrayPeriodos[1];

    $tables = new Tables();
    $tables->ajaxObtenerIdPeriodo($inicio, $fin);
}
