<?php
class Database
{
    private $dbHost = DB_HOST;
    private $dbUser = DB_USER;
    private $dbPass = DB_PASS;
    private $dbName = DB_NAME;

    private $statement;
    private $dbHandler;
    private $error;

    public function __construct()
    {
        $conn = 'mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try {
            $this->dbHandler = new PDO($conn, $this->dbUser, $this->dbPass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    //prepare queries
    public function query($sql)
    {
        $this->statement = $this->dbHandler->prepare($sql);
    }

    //Execute the prepared statement with parameters
    public function execute($param)
    {
        return $this->statement->execute($param);
    }

    //Return an array
    public function resultSet()
    {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    //Return a specific row as an ARRAY
    public function single()
    {
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    //Get's the row count
    public function rowCount()
    {
        return $this->statement->rowCount();
    }
}
