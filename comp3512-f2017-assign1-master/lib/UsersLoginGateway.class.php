<?php

class UsersLoginGateway extends TableDataGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement()
    {
        return "SELECT UserID, UserName, Password, Salt, State,
                DateJoined, DateLastModified FROM UsersLogin";
    }
    
    /*protected function getOrderFields() {
        return 'LastName';
    }*/
    
    protected function getPrimaryKeyName() {
        return "UserID";
    }
}
?>