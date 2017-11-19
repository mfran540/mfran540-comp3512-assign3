<?php

class AuthorsGateway extends TableDataGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement()
    {
        return 'SELECT FirstName, LastName, Books.ISBN10, Books.BookID
            FROM Authors
            INNER JOIN BookAuthors ON Authors.AuthorID=BookAuthors.AuthorID
            INNER JOIN Books ON BookAuthors.BookID=Books.BookID'; 
    }
    
    protected function getOrderFields() {
        return 'BookAuthors.Order';
    }
    
    protected function getPrimaryKeyName() {
        return "Books.ISBN10";
    }
    
}

?>