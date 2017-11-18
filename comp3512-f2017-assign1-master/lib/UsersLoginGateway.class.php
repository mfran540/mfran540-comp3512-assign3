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
    
    protected function getOrderFields() {
        return 'LastName';
    }
    
    protected function getPrimaryKeyName() {
        return "UserName";
    }
    
    protected function getPassword() {
        return "Password";
    }
    
    //Check if username and password are correct
    public function userExists($username,$password) {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName(). '=:username ';
      
        $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':username' => $username));
        $result =  $statement->fetch();
      
        if($result != null){
            $salt = $result['Salt'];
            $epassword = $password.$salt;
            $epassword = md5($epassword);
            
            if($epassword == $result['Password'])
            {
                $_SESSION['userId'] = $result['UserID'];
                return true;
            }
            else {              
                return false;
            }
        }//End if
    }//End function
}

?>