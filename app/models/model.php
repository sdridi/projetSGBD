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

    // public function getAll($data = null)
    // {
    //     if (!$this->_sql)
    //     {
    //         throw new Exception("No SQL query!");
    //     }

    //     $sth = $this->_db->prepare($this->_sql);
    //     $sth->execute($data);
    //     return $sth->fetchAll();
    // }
    
 public function get($reference, $champ){
        if(!champ){
            throw new Exception("No table query!");
        } 
        if($champ == "all")
        {
            $sth = $this->_db->prepare($this->_sql);
            $sth->execute($data);
            return $sth->fetchAll();       
        }
        else
        {
            foreach( $this->_db->query("SELECT * FROM produit WHERE id_produit=1") as $row){
            print $row[$champ];
        }
     }

    }
  
    public function set($reference, $champ, $newChamp){
        if(!champ){
          throw new Exception("No table query!");  
        }
        $var = "commerce.";
        $var = $var."produit";
        echo $this->table;
         $this->_db->exec("UPDATE $var SET $champ = '$newChamp' WHERE id_produit=1");
        // print $row['designation'];
    
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