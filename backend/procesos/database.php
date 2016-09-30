
<?php
class Database
{
    /*EN esta clase se conecta a la base de datos*/
    private static $connection;

    private static function connect() 
    {
        $server = 'localhost';
        $database = 'expo';
        $username = 'almira';
        $password = 'edwinalmira';
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8");
        self::$connection = null;
        try
        {
            self::$connection = new PDO("mysql:host=".$server."; dbname=".$database, $username, $password, $options);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception)
        {
            die($exception->getMessage());
        }
    }

    /*Sirve para cuando se desconecta las conexiones de la base de datos*/
    private static function desconnect()
    {
        self::$connection = null;
    }

    /*Ejecuta a traves del PHP codigo SQL en MYSQL*/
    public static function executeRow($query, $values)
    {
        self::connect();
        $statement = self::$connection->prepare($query);
        $statement->execute($values);
        self::desconnect();
    }

    /*Sirve para tener un registro de la base*/
    public static function getRow($query, $values)
    {
        self::connect();
        $statement = self::$connection->prepare($query);
        $statement->execute($values);
        self::desconnect();
        return $statement->fetch(PDO::FETCH_BOTH);
    }

    /*Sirve para tener varios registros de la base de datos*/
    public static function getRows($query, $values)
    {
        self::connect();
        $statement = self::$connection->prepare($query);
        $statement->execute($values);
        self::desconnect();
        return $statement->fetchAll(PDO::FETCH_BOTH);
    }
}


?>