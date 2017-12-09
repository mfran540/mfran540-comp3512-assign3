<?php

class BooksGateway extends TableDataGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement()
    {
        return 'SELECT ISBN10, ISBN13, Title, CopyrightYear, Subcategories.SubcategoryName, Subcategories.SubcategoryID, Imprints.Imprint,Imprints.ImprintID, 
                Statuses.Status, BindingTypes.BindingType, TrimSize, PageCountsEditorialEst, Books.Description
            FROM Books
            INNER JOIN Subcategories ON Books.SubcategoryID=Subcategories.SubcategoryID
            INNER JOIN Imprints ON Books.ImprintID=Imprints.ImprintID
            INNER JOIN Statuses ON Books.ProductionStatusID=Statuses.StatusID
            INNER JOIN BindingTypes ON Books.BindingTypeID=BindingTypes.BindingTypeID'; 
    }
    
    protected function getBookSelectStatement(){
        return 'SELECT Books.BookID, Books.ISBN10, Books.Title, Books.CopyrightYear, Books.SubcategoryID, Books.ImprintID, Subcategories.SubcategoryName, Imprints.Imprint
                FROM Books
                JOIN Imprints ON Books.ImprintID=Imprints.ImprintID
                JOIN Subcategories ON Books.SubcategoryID=Subcategories.SubcategoryID
                ';
    }
    
    protected function getSubcatKeyName(){
        return 'Books.SubcategoryID';
    }
    
    protected function getImprintKeyName(){
        return 'Books.ImprintID';
    }
    
    protected function getOrderFields() {
        return 'Books.Title';
    }
    
    protected function getPrimaryKeyName() {
        return "Books.ISBN10";
    }
    
}

?>