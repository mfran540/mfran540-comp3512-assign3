<?php

class AdoptionsAnalyticsGateway extends TableDataGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement()
    {
        return 'SELECT AdoptionBooks.BookID, COUNT(AdoptionBooks.BookID) AS Num, Books.ISBN10, Books.Title, SUM(Quantity) AS Quantity
                FROM AdoptionBooks
                INNER JOIN Books ON AdoptionBooks.BookID = Books.BookID'; 
    }
    
    protected function getOrderFields() {
        return 'Quantity';
    }
    
    protected function getPrimaryKeyName() {
        return "AdoptionDetailID";
    }
    
    //For grouping by specific ID
    protected function getGroupBy() {
        return "AdoptionBooks.BookID";
    }
    
    
}

?>