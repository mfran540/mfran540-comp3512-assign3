<?php

class ImprintGateway extends TableDataGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement()
    {
        return 'SELECT ImprintID,Imprint FROM Imprints'; 
    }
    
    protected function getOrderFields() {
        return 'Imprint';
    }
    
    protected function getPrimaryKeyName() {
        return "ImprintID";
    }
    
}

?>