<?php
class Database{
    private $host=DB_HOST;
    private $user=DB_USER;
    private $password=DB_PASSWORD;
    private $db_name=DB_NAME;
    private $pdo;
    private $stmt;
    function __construct(){
        $dns="mysql:host=".$this->host.";dbname=".$this->db_name;
        try {
            
            $string="mysql:host=".DBHOST.";dbname=".DBNAME;
            $this->pdo=new PDO($dns,$this->user,$this->password);
           
        } catch (PDOException $e) {
            die ("there is an issue".$e->getMessage());
            die;
        }

    }
    public function __destruct(){
        if ($this->stmt !==null) {

            $this->stmt =null;
        }
        if ($this->pdo !==null) {
            $this->pdo =null;
        }
    } 
    public function query($sql){
        $this->stmt=$this->pdo->prepare($sql);
    }
    public function bind($param,$value,$type=null){
        if(is_null($type)){
            switch (true) {
                case is_int($values):
                    $type=Pdo::PARAM_INT;
                    break;
                case is_bool($values):
                    $type=Pdo::PARAM_BOOL;
                    break;
                case is_null($values):
                    $type=Pdo::PARAM_NULL;
                    break;
                
                default:
                    $type=Pdo::PARAM_STR;
                    
            }
        }
        $this->stmt->bindvalue($param,$value,$type);
    }
    public function execute(){
        $this->stmt->execute();
    }
    public function fetchAll(){
        $this->stmt->execute();
        $results=$this->stmt->fetchAll();
        return $results;

    }
    public function fetch(){
        $this->stmt->execute();
        $results=$this->stmt->fetch();
        return $results;

    }
    public function rowCount(){
        return $this->stmt->rowCount();
    }
}

?>