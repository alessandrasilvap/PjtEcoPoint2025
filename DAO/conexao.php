<?php

class Conexao{
    private static $instancia;
    
    private function __construct(){}
    
    public static function getConexao() {
        if (!isset(self::$instancia)) {
            $dbname = "ecopoint";
            $host = "localhost";
            $user = "root";
            $senha = "";

            try {

                self::$instancia = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $user, $senha);

            } catch (Exception $e) {
                echo 'O Erro é: ' . $e;
            }
        }
        return self::$instancia;
    }
}

?>