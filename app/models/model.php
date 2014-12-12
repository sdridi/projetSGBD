<?php

require"Db.php";

class Model 
{
    protected $_db;
    protected $_sql;
    
    public function Model()
    {
        $this->_db = Db::init();
    }
    
    protected function _setSql($sql){
        $this->_sql = $sql;
    }
    
    public function getAll($data = null)
    {
        if (!$this->_sql)
        {
            throw new Exception("No SQL query!");
        }
        
        $sth = $this->_db->prepare($this->_sql);
        $sth->execute($data);
        return $sth->fetchAll();
    }
    
    public function getRow($data = null)
    {
        if (!$this->_sql)
        {
            throw new Exception("No SQL query!");
        }
        $sth = $this->_db->prepare($this->_sql);
        $sth->execute($data);
        return $sth->fetch();
    }

    public function updateM($data=null){
      if (!$this->_sql)
        {
            throw new Exception("No SQL query!");
        }
        
        $sth = $this->_db->prepare($this->_sql);
        $isUpdated = $sth->execute($data);
        if (!$isUpdated){
            throw new Exception("updating failed!");
        }
        return $isUpdated;
    }

    public function deleteM($data=null){
      if (!$this->_sql)
        {
            throw new Exception("No SQL query!");
        }
        
        $sth = $this->_db->prepare($this->_sql);
        $isDeleted = $sth->execute($data);
        if (!$isDeleted){
            throw new Exception("deleting failed!");
        }
        return $isDeleted;
    }

}

?>