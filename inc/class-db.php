<?php

class Db
{
    //	Dados de ligação à base de dados
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const NAME = "paginacao";

    private static $dbHandle = null;

    // Disallow calling the class via new DBConn
    private function __construct() {}

    // Disallow cloning the class
    private function __clone() {}

    static public function getConnection()
    {
        if (self::$dbHandle === null)
        {
            // Ainda não existe ligação PDO: criar uma nova
            try
            {
                self::$dbHandle = new PDO('mysql:host=' . self::SERVER . ';dbname=' . self::NAME . ';charset=utf8', self::USER, self::PASSWORD, array(
                    PDO::ATTR_PERSISTENT => true
                ));
                self::$dbHandle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                echo "<h1>Erro fatal</h1>";
                echo  __FILE__ . " -> " . static::class . " / " . __METHOD__ . "(): " . $e->getMessage();
                die();
            }
        }

        return self::$dbHandle;
    }
}