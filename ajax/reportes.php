<?php
require_once '../conexion.php';
class Reportes
{
    public static function ajaxObtenerIdPeriodo($inicio_periodo, $fin_periodo)
    {
        try {
            $query = Conexion::conexion()->prepare("SELECT idperiodos from periodos WHERE inicio=:inicio AND fin=:fin");
            $query->execute(["inicio" => $inicio_periodo, "fin" => $fin_periodo]);
            if ($query->rowCount() > 0) {
                $idPeriodo = $query->fetchColumn();
                Reportes::ajaxObtenerIdMatricula($idPeriodo);
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
                Reportes::ajaxObtenerData($idMatricula);
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
                $variables = Reportes::ajaxObtenerVariables();
                Reportes::sendResponse($variables, $query->fetchAll());
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
            array_push($arrayData, ["periodo" => $_GET["infoPeriodos"], "variables" => $variables[$i]["nombre"], "valor" => $data[$i]["valor"], "valor_porcentual" => $data[$i]["porcentaje"]]);
        }
        Reportes::generateReport($arrayData);
    }
    public static function generateReport($arrayData){
        $total = count($arrayData);
        $salida = "";
        $salida .= '<table>
        <thead>
            <tr>
                <th  colspan="3" style="background-color: #337ab7; color: white; height:45px;">' . utf8_decode("Reporte historial matrículas") .'</th>
            </tr>
            <tr>
                <th style="background-color: #337ab7; color: white; width: 400px; height:45px;">Variable</th>
                <th style="background-color: #337ab7; color: white; width: 400px; height:45px;"># Estudiantes</th>
                <th style="background-color: #337ab7; color: white; width: 400px; height:45px;">Porcentaje</th>
            </tr>
        </thead>
        <tbody>
        ';
        for($i= 0; $i < $total; $i++){
            $salida .= "<tr style='text-align:center; height: 40px;'>
            <td>" . utf8_decode($arrayData[$i]["variables"]) ."</td>
            <td>" . $arrayData[$i]["valor"] ."</td>";
            if($arrayData[$i]["valor_porcentual"] != 0){
                $salida .= "<td>" . ($arrayData[$i]["valor_porcentual"] . " " . "%") . "</td></tr>";
            }else{
                $salida .= "<td>" . $arrayData[$i]["valor_porcentual"]. "</td></tr>";
            }
        }
        $salida .= "</tbody></table>";
        header("Content-type: application/xls; charset=UTF-8");
        header("Content-Disposition: attachment; filename=reporte_matriculas_".time().".xls");
        // header("Pragma: no-cache");
        // header("Expires: 0");
        echo $salida;
    }
}
if(isset($_GET["infoPeriodos"])){
    $periodos = $_GET["infoPeriodos"];
    $arrPeriodos = explode('-',$periodos);
    $inicio = $arrPeriodos[0];
    $fin = $arrPeriodos[1];

    Reportes::ajaxObtenerIdPeriodo($inicio,$fin);
}
