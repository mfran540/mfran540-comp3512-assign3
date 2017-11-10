<?php

class MessagesGateway extends TableDataGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement()
    {
        return "SELECT EmployeeMessages.MessageDate, EmployeeMessages.Category, Contacts.FirstName, Contacts.LastName, EmployeeMessages.Content
                FROM EmployeeMessages
                INNER JOIN Contacts on EmployeeMessages.ContactID=Contacts.ContactID";
    }
    
    protected function getOrderFields() {
        return 'MessageDate';
    }
    
    protected function getPrimaryKeyName() {
        return "EmployeeMessages.EmployeeID";
    }
}

?>