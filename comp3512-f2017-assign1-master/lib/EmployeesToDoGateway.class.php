<?php

class EmployeesToDoGateway extends TableDataGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement()
    {
        return "select * from EmployeeToDo "; //We will need to add the table fields instead of *
    }
    
    protected function getOrderFields() {
        return 'DateBy';
    }
    
    protected function getPrimaryKeyName() {
        return "EmployeeID";
    }
}

?>