<?php
require_once 'conexion.php';
class Administrador
{
    function obtPeriodos()
    {
        try {
            $query = Conexion::conexion()->prepare("SELECT * FROM periodos");
            $query->execute();
            if ($query->rowCount() > 0) {
                echo json_encode($query->fetchAll(PDO::FETCH_ASSOC));
            }
        } catch (PDOException $e) {
        }
    }
    function periodoEvaluado($id)
    {
        try {
            $query = Conexion::conexion()->prepare("UPDATE periodos set evaluado=1 WHERE idperiodos=:id");
            $query->execute(["id" => $id]);
        } catch (PDOException $e) {
        }
    }
    function setMatricula($id)
    {
        try {
            $query = Conexion::conexion()->prepare("INSERT INTO matricula VALUES(0,:idperiodo)");
            $query->execute(["idperiodo" => $id]);
            if ($query->rowCount() > 0) {
                $query = Conexion::conexion()->prepare("SELECT idmatricula FROM matricula ORDER BY idmatricula desc limit 1");
                $query->execute();
                if ($query->rowCount() > 0) {
                    $query2 = Conexion::conexion()->prepare("SELECT COUNT(*) FROM variables");
                    $query2->execute();
                    $this->setValuesVariables($query->fetchColumn(), $query2->fetchColumn());
                }
            } else {
                $repuesta = array("confirmacion" => false);
                echo json_encode($repuesta);
            }
        } catch (PDOException $e) {
        }
    }
    function setValuesVariables($idMatricula, $countVariables)
    {
        try {
            $idMatricula = $idMatricula;
            $bander = true;
            $valuesMatriculas = array(0 => $_POST["total_inicio"], 1 => $_POST["num_agregadas"], 2 => $_POST["num_segregadas"], 3 => $_POST["num_deserciones"], 4 => $_POST["num_promovidos"], 5 => $_POST["num_no_promovidos"], 6 => $_POST["matricula_efectiva"]);
            $valuesMatriculasPorcentaje = array(0 => $_POST["porcentaje_inicio"], 1 => $_POST["porcentaje_agregada"], 2 => $_POST["porcentaje_segregadas"], 3 => $_POST["porcentaje_deserciones"], 4 => $_POST["porcentaje_promovidos"], 5 => $_POST["porcentaje_no_promovidos"], 6 => $_POST["porcentaje_efectiva"]);
            for ($i = 0; $i < $countVariables; $i++) {
                $query = Conexion::conexion()->prepare("INSERT INTO m_variables VALUES(0,:valor,:porcentaje,:idVariable,:id_matricula)");
                $query->execute(["valor" => $valuesMatriculas[$i], "porcentaje" => $valuesMatriculasPorcentaje[$i], "idVariable" => ($i + 1), "id_matricula" => $idMatricula]);
                if ($query->rowCount() == 0) {
                    $bander = false;
                    break;
                }
            }
            $repuesta = array("verificacion" => $bander);
            echo json_encode($repuesta);
        } catch (PDOException $e) {
        }
    }
}
if (isset($_POST["obtener_periodos"])) {
    $administrador = new Administrador();
    $administrador->obtPeriodos();
}
if (isset($_POST["idPeriodo"])) {
    $periodo = $_POST["idPeriodo"];
    $administrador = new Administrador();
    $administrador->periodoEvaluado($periodo);
    $administrador->setMatricula($periodo);
}
