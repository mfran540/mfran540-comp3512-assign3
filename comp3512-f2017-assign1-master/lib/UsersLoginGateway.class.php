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
            //echo $epassword;
            $epassword = md5($epassword);
            //echo ' ' . $epassword;
            
            
            if($epassword == $result['Password'])
            {
                return true;
               // echo "it works";
            }
            else {
                                
                return false; 
                
            }
            
            //$statement2 = DatabaseHelper::runQuery($this->connection, $sql.' AND Password =' . $epassword , Array(':username' => $username));
            //$result2 = $statement2->fetchAll();
        /*    if ($result2['UserName'] == $username )
        { 
          return true;
          
        }
            else {return false;}
      
   }

    else {return false;}
   */
    }
}
}
?>