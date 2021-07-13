<?php
require_once 'config/config.php';
class Conexion{
    private $host;
    private $user;
    private $password;
    private $dbname;
    private $charset;
    public function __construct(){
        $this->host = HOST;
        $this->user = USER_DB;
        $this->password = PASSWORD_DB;
        $this->dbname = DBNAME;
        $this->charset = CHARSET;
    }

    public static function conexion(){
        try{
            $conn = "mysql:host=".HOST.";dbname=". DBNAME.";charset=".CHARSET;
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false];
            $pdo = new PDO($conn,USER_DB,PASSWORD_DB,$options);
            return $pdo;
        }catch(PDOException $e){
            echo "Error en la conexion" . $e->getMessage();
        }
    }
}