	<h1>
		Produit</h1>
		<?php
		Class Produit {
			private PDO $bdd;

			public function Membre(PDO $bdd){	 
				$this->bdd=$bdd;
			}

			public function get_Nom( $reference){
				$reference = $bdd->query("SELECT designation FROM produit WHERE id_produit='$reference'");
				return $reference;
			} 

			public function get_Prenom( $reference){
				$description = $bdd->query("SELECT description FROM produit WHERE id_produit='$reference'");
				return $description;
			} 

			public function get_Adresse( $reference){
				$quantite = $bdd->query("SELECT quantite FROM produit WHERE id_produit='$reference'");
				return $quantite;
			} 

			public function get_mail( $reference){
				$prix = $bdd->query("SELECT prix FROM produit WHERE id_produit='$reference'");
				return $prix;
			} 

			public function get_Tel( $reference){
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