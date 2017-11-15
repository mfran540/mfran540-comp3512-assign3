<?php

class EmployeesGateway extends TableDataGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement()
    {
        return "SELECT EmployeeID, FirstName, LastName, Address, City,
                Region, Country, Postal, Email FROM Employees ";
    }
    
    protected function getOrderFields() {
        return 'LastName';
    }
    
    protected function getPrimaryKeyName() {
        return "EmployeeID";
    }
    
    protected function getLastName() {
        return "LastName";
    }
    
    protected function getCityField(){
        return "City";
    }
    protected function getCities(){
        return "SELECT DISTINCT ".$this->getCityField()." FROM Employees ORDER BY City";
    }
}

?>