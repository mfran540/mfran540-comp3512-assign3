<?php

class EmployeesToDoGateway extends TableDataGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement()
    {
        return "select ToDoID, EmployeeID, Status, Priority, DateBy, Description from EmployeeToDo "; 
    }
    
    protected function getOrderFields() {
        return 'DateBy';
    }
    
    protected function getPrimaryKeyName() {
        return "EmployeeID";
    }
}

?>