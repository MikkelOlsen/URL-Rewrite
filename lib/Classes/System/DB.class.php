<?php

class DB extends \PDO
{
    //Fields
    public $host;
    public $user;
    public $pass;
    private $conn;
    private $query;
    private $debug = false;

    //properties
    public function debug($bool = true)
    {
        $this->debug = $bool;
    }

    private function setQuery(string $sql)
    {
        $this->query = $this->conn->prepare($sql);
    }

    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:host='._DB_HOST_.';dbname='._DB_NAME_.';charset=utf8',_DB_USER_,_DB_PASSWORD_);
        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

    }

    public function query(string $sql, array $params = [], int $returnType = \PDO::FETCH_OBJ)
    {
        $this->setQuery($sql);
        $this->execute($params);
        $this->count = $this->query->rowCount();

        return $this->query->fetchAll($returnType);
    }

    private function execute(array $params = [])
    {
        if($params){
            $this->query->execute($params);
        } else {
            $this->query->execute();
        }
        if($this->debug){
            echo '<pre id="debug_params">',$this->query->debugDumpParams(),'</pre>';
        }
    }

    public function single(string $sql, array $params = []){
        $data = $this->query($sql, $params);
        if(sizeof($data) === 1){
            return $data[0];
        }
    }

    public function first(string $sql, array $params = []){
        return $this->query($sql, $params)[0];
    }

    public function last(string $sql, array $params = []){
        return $this->query($sql, $params)[$this->count - 1];
    }

    public function toList(string $sql, array $params = []){
        return $this->query($sql, $params);
    }

    public function lastId(string $sql, array $params = []){
        $this->query($sql, $params);
        return $this->lastInsertId();
    }
}
