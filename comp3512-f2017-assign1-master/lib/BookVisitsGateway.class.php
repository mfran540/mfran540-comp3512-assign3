<?php

class BookVisitsGateway extends TableDataGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement()
    {
        return 'SELECT VisitID, BookVisits.BookID, BookVisits.CountryCode, Countries.CountryName,
                    COUNT(BookVisits.CountryCode) AS Visits
                FROM BookVisits 
                INNER JOIN Countries ON BookVisits.CountryCode = Countries.CountryCode'; 
    }
    
    protected function getOrderFields() {
        return 'Visits';
    }
    
    protected function getPrimaryKeyName() {
        return "VisitID";
    }
    
    //For grouping by specific ID
    protected function getGroupBy() {
        return "BookVisits.CountryCode";
    }
    
    
}

?>