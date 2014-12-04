	<h1>
		Produit</h1>
		<?php
		Class ProduitModel extends Model {
			private PDO $bdd;

			

			public function Produit(PDO $bdd){	 
				$this->bdd=$bdd;
			}

			public function get_Designation( $reference){
				$reference = $bdd->query("SELECT designation FROM produit WHERE id_produit='$reference'");
				return $reference;
			} 

			public function get_Description( $reference){
				$description = $bdd->query("SELECT description FROM produit WHERE id_produit='$reference'");
				return $description;
			} 

			public function get_Quantite( $reference){
				$quantite = $bdd->query("SELECT quantite FROM produit WHERE id_produit='$reference'");
				return $quantite;
			} 

			public function get_Prix( $reference){
				$prix = $bdd->query("SELECT prix FROM produit WHERE id_produit='$reference'");
				return $prix;
			} 

			public function get_Photo( $reference){
				$photo = $bdd->query("SELECT photo FROM produit WHERE id_produit='$reference'");
				return $photo;
			} 

			public function get_enVente( $reference){
				$enVente = $bdd->query("SELECT enVente FROM produit WHERE id_produit='$reference'");
				return $enVente;
			} 


			public function add($values){
				$reference = $bdd->exec("INSERT INTO produit VALUES('$values') ");

			} 

			public function delete($reference){
				$reference = $bdd->exec("DELETE FROM produit WHERE id_produit='$reference'");
			} 






				
}