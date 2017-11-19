<?php

class SubcatGateway extends TableDataGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement()
    {
        return 'SELECT SubcategoryID,SubcategoryName FROM Subcategories'; 
    }
    
    protected function getOrderFields() {
        return 'SubcategoryName';
    }
    
    protected function getPrimaryKeyName() {
        return "SubcategoryID";
    }
    
}

?>