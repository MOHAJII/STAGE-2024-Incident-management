<?php
class connect extends PDO
{

    const HOST = "localhost";
    const DB = "gestion_incident";
    const USER = "root";
    const PASSWORD = "";
    public function __construct()
    {
        try {
            parent::__construct("mysql:dbname=" . self::DB . ";host=" . self::HOST, self::USER, self::PASSWORD);
        } catch (PDOException $e) {
            echo $e->getMessage() . " " . $e->getFile() . " " . $e->getLine();
        }
    }
}

?>