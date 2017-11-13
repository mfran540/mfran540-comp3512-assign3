<?php

class UniversitiesGateway extends TableDataGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement()
    {
        return 'SELECT * FROM Universities 
                INNER JOIN States ON Universities.State=States.StateName'; 
    }
    
    protected function getOrderFields() {
        return 'Name LIMIT 0, 20';
    }
    
    protected function getPrimaryKeyName() {
        return "UniversityID";
    }
    public function getStateName() {
        return "State";
    }
    public function getSingleUniversity () {
        return "SELECT * FROM Universities";   
    }
    public function findListByName($id)
    {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getStateName() . '=:id';
      
        $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
        return $statement->fetchAll();
    }  
    public function findUniversityById($id)
    {
        $sql = $this->getSingleUniversity() . ' WHERE ' . $this->getPrimaryKeyName() . '=:id';
      
        $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
        return $statement->fetch();
   }
    
}

?>