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
    
    //SQL for accessing a single university
    public function getSingleUniversity () {
        return "SELECT * FROM Universities";   
    }
    
    //SQL for accessing the custom list of adopted universities
    protected function adoptedUniversities()
    {
        return 'SELECT Universities.Name, Universities.UniversityID, Books.ISBN10
        FROM Universities
        INNER JOIN Adoptions ON Universities.UniversityID = Adoptions.UniversityID
        INNER JOIN AdoptionBooks ON Adoptions.AdoptionID = AdoptionBooks.AdoptionID
        INNER JOIN Books ON AdoptionBooks.BookID = Books.BookID '; 
    }
    protected function getUniOrder() {
        return 'Name ';
    }
    protected function getUniPrimaryKey() {
        return 'Books.ISBN10 ';
    }
    
    //Returns a list of universities by specified ID
    public function findListByName($id)
    {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getStateName() . '=:id';
      
        $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
        return $statement->fetchAll();
    }  
    
    //Finds a specific university based on passed in ID
    public function findUniversityById($id)
    {
        $sql = $this->getSingleUniversity() . ' WHERE ' . $this->getPrimaryKeyName() . '=:id';
      
        $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
        return $statement->fetch();
   }
    
}

?>