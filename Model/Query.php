<?php
    class Query
    {
        public $conn ;
        public $proc ;
        public $statement ;
        public $parameters ;
        public $result ;
        private $rowsCount ;
        private $database_name = 'tawssil' ;

        function __construct($statement,$parameters=array()){
            $db = "mysql:dbname=$this->database_name; host=127.0.0.1";
            try
            {
                $this->conn= new PDO($db,"root","admin");
            }
            catch(PDOException $ex)
            {
                echo("erreur de connexion :". $ex->getMessage());
                exit();
            }

            $this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            
            $this->statement = $statement ;
            $this->parameters = $parameters ;
            
        }

        public function addProc($proc){
            $this->conn->exec('SET character_set_client="utf8",character_set_connection="utf8",character_set_results="utf8";');
            $this->conn->exec($proc) ;
        }

        public function setStatement($statement){
            $this->statement = $statement ;
        }

        public function getAffectedRowsCount(){
            return $this->rowsCount ;
        }

        public function setParameter($i,$parameter){
            $this->parameters[$i] = $parameter ;
        }

        public function setParameters($parameters){
            $this->parameters = $parameters ;
        }

        public function addParameter($parameter){
            array_push($this->parameters,$parameter) ;
        }

        public function execute_query($mode){

            $this->conn->exec('SET character_set_client="utf8",character_set_connection="utf8",character_set_results="utf8";');
            
            $sql = $this->conn->prepare($this->statement);

            foreach($this->parameters as $p)
            {
                $paramName = $p[0];
                $paramValue = $p[1]; // Use a temporary variable
                $paramType = $p[2];
                $sql->bindParam($paramName, $paramValue, $paramType);
            }
            $sql->execute();
            //var_dump($this->conn->errorInfo());
            $this->rowsCount = $sql->rowCount();
            if( in_array(explode(' ',trim($this->statement))[0],['INSERT','UPDATE','DELETE'] )  )
                $this->result =  $this->conn->lastInsertId() ;
            else{
                $this->result = $sql->fetchAll($mode) ;
            }
            //var_dump($this->result) ;
            return $this->result ;
        }
    }

?>