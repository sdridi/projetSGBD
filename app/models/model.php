<?php

abstract class Model 
{
    protected $_db;     
    protected $_sql;
    protected $table;



    protected function _setSql($sql)
    {
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
    
 public function get($reference, $champ){
        if(!champ){
            throw new Exception("No table query!");
        } 

     foreach( $this->_db->query("SELECT * FROM produit WHERE id_produit=1") as $row){
        print $row['designation'];
     }

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


}