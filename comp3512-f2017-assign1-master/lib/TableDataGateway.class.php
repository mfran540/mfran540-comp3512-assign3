<?php
/*
  Encapsulates common functionality needed by all table gateway objects.
 
  Table Data Gateway is an enterprise data pattern identified by Fowler. This pattern's 
  intent is to encapsulate the full interaction with a database table. It is also 
  referred to by some as the data access object (DAO) pattern.
 
  Inspiration:
         http://martinfowler.com/eaaCatalog/tableDataGateway.html
         http://css.dzone.com/books/practical-php-patterns-table
         https://speakerdeck.com/hhamon/database-design-patterns-with-php-53
 */
 
abstract class TableDataGateway
{
   // contains connection
   protected $connection;
   
   /*
      Constructor is passed a database adapter (example of dependency injection)
   */
   public function __construct($connect) 
   {
      if (is_null($connect) )
         throw new Exception("Connection is null");
         
      $this->connection = $connect;
   }
   
   // ***********************************************************
   // ABSTRACT METHODS
   
   /*
     The name of the table in the database
   */    
   abstract protected function getSelectStatement();

   /*
     A list of fields that define the sort order
   */   
   abstract protected function getOrderFields();
   
   /*
     The name of the primary keys in the database ... this can be overridden by subclasses
   */    
   abstract protected function getPrimaryKeyName();
   
   // ***********************************************************
   // PUBLIC FINDERS 
   //
   // All of these finders return either a single or array of the appropriate DomainObject subclasses
   //
   
   /*
      Returns all the records in the table
   */
   public function findAll($sortFields=null)
   {
      $sql = $this->getSelectStatement();
      // add sort order if required
      if (! is_null($sortFields)) {
         $sql .= ' ORDER BY ' . $sortFields;
      }
      $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
      return $statement->fetchAll();
   } 
   
   /*
      Returns all the records in the table sorted by the specified sort order
   */
   public function findAllSorted($ascending)
   {
      $sql = $this->getSelectStatement() . ' ORDER BY ' .
      $this->getOrderFields();
      if (! $ascending) {
         $sql .= " DESC";
      }
      $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
      return $statement->fetchAll();
   } 
   
   /*
      Returns all the records in the table grouped by the specified 
      $group table column
   */
   public function findAllGrouped()
   {
      $sql = $this->getSelectStatement() . ' GROUP BY ' . $this->getGroupBy();
      $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
      return $statement->fetchAll();
   }
   
   /*
      Returns all the records in the table sorted by the specified sort order,
      the first $limit records, and grouped by subclass getGroupBy()
   */
   public function findAllSortedLimitedGrouped($ascending, $limit)
   {
      $sql = $this->getSelectStatement() . ' GROUP BY ' . $this->getGroupBy();
      $sql .= ' ORDER BY ' . $this->getOrderFields();
      if (! $ascending) {
         $sql .= " DESC";
      }
      $sql .= " LIMIT 0," . $limit;
      $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
      return $statement->fetchAll();
   } 
   
   /*
      Returns all unique city records in the employee table
   */
   public function findAllCities($ascending)
   {
      $sql = $this->getCities();
      $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
      return $statement->fetchAll();
   }
   
   /*
      Returns a record for the specificed ID
   */
  public function findById($id)
   {
      $sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=:id';
      
      $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
      return $statement->fetch();
   } 
   
   /*
      Returns a list of records with the specified lastname
   */
  public function findByLastName($lastname)
   {
      /*$sql = $this->getSelectStatement() . ' WHERE ' . $this->getLastName() . "=:lastname";*/ 
      $sql = $this->getSelectStatement() . ' WHERE ' . $this->getLastName() . " LIKE :lastname";
      
      $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':lastname' => $lastname));
      return $statement->fetchAll();
   } 
   
   /*
      Returns a list of records with the specificed city and lastname
   */   
  public function findByLastNameandCity($lastname,$city)
   {
      $sql = $this->getSelectStatement() . ' WHERE ' . $this->getLastName() . "=:lastname AND ". $this->getCityField() ."=:city";
      
      $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':lastname' => $lastname,':city' => $city));
      return $statement->fetchAll();
   }   

   /*
      Returns a list of records with the specificed city and lastname
   */   
  public function findByCity($city)
   {
      $sql = $this->getSelectStatement() . ' WHERE ' . $this->getCityField() . "=:city";
      
      $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':city' => $city));
      return $statement->fetchAll();
   } 
   
   /*
      Returns a list of records for the specificed ID and Sorts it by specified sort order.
   */
  public function findListByIdSorted($ascending, $id)
   {
      $sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=:id' . ' ORDER BY ' . $this->getOrderFields();
      if (! $ascending) {
         $sql .= " DESC";
      }
      $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
      return $statement->fetchAll();
   }
   
   /*
      Returns a list of records for the specificed ID.
   */
  public function findListById($id)
   {
      $sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=:id';
      
      $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
      return $statement->fetchAll();
   }

   /*
      Returns a list based on specific name
   */
   public function findListByName($id)
   {
      $sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=:id';
      
      $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':id' => $id));
      return $statement->fetchAll();
   }  
   
   /*
      Returns records based on custom $where param
   */
   public function customWhere($where) {
      $sql = $this->getSelectStatement() . ' WHERE ' . $where;
      
      $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
      return $statement->fetchAll();
   }
   

}

?>