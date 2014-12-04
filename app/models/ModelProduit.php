
    
	<h1>
		Produit</h1>
		<?php
		require"Model.php";
		require"Db.php";
		Class ModelProduit extends Model {
			public function __construct()
			{
				$this->_db = Db::init();
				$table = "produit";
				//echo $table;
			}				


      public function add($values){
        $reference = $this->_db->exec("INSERT INTO produit (designation, descriptif, quantite, prix, photo, enVente) VALUES $values ");
        echo "bonjour";
    } 



    public function delete($reference){
                $reference = $_db->exec("DELETE FROM produit WHERE id_produit='$reference'");
          } 

}