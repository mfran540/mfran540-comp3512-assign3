<?php

class StatesGateway extends TableDataGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement()
    {
        return 'SELECT StateName, StateId, StateAbbr FROM States';
    }
    
    protected function getOrderFields() {
        return 'StateName';
    }
    
    protected function getPrimaryKeyName() {
        return "StateID";
    }

}

?>