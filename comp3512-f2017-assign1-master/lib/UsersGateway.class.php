<?php

class UsersGateway extends TableDataGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement()
    {
        return "SELECT UserID, FirstName, LastName, Address, City,
                Region, Country, Postal, Phone, Email FROM Users";
    }

    protected function getInsertStatement()
    {
        return "INSERT INTO Users (UserID, FirstName, LastName, Address, City,
                Region, Country, Postal, Phone, Email)";
    }    
    
    protected function getOrderFields() {
        return 'LastName';
    }
    
    protected function getPrimaryKeyName() {
        return "UserID";
    }
}
?>