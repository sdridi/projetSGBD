
    
	<h1>
		Produit</h1>
		<?php
		require"Model.php";
		require"Db.php";
		Class modelProduit extends Model {
			public function __construct()
			{
				$this->_db = Db::init();
				$table = "produit";
			}				


      public function add($values){
        $reference = $this->_db->exec("INSERT INTO produit (designation, descriptif, quantite, prix, photo, enVente) VALUES ('chaussure', 'lpfj', '12', '142', 'dzz', '1') ");

    } 

     


    public function delete($reference){
                $reference = $_db->exec("DELETE FROM produit WHERE id_produit='$reference'");
          } 

}