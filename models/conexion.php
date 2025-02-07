<?php
class Conexion
{

    static public function conexion()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "facturacion";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            return $conn;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }
}
