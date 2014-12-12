<h1>
	Produit</h1>
	<?php
	

	require_once"Model.php";
	require_once"CatalogueModel.php";

	Class PanierModel extends Model {
		private $id_membre;
		private $id_produit;
		private $quantite;

		public PanierModel(){
			parent::Model();

		}
		
		public function addToPanier(){
			$sql="call add_to_panier(?, ?, ?)";

			$data = array(
				$this->id_membre,
				$this->id_produit,
				$this->quantite
				);
			$sth = $this->_db->prepare($sql);
			$sth->execute($data);
		}
		
		public function deleteFromPanier(){
			$sql= "call delete_from_panier(?, ?)";
			$data = array(
				$this->id_membre,
				$this->id_produit
				);
			$sth = $this->_db->prepare($sql);
			$sth->execute($data);		
		}

		public function deletePanier(){
			$sql= "call ";
			$data = array(
				$this->id_membre
				);
			$sth = $this->_db->prepare($sql);
			$sth->execute($data);		
		}

		public function changeQuantityProduit($newQuantity){
			$sql= "call update_quantite_panier(?, ?, ?)";

			$data = array(
				$this->id_membre
				$this->id_produit
				$newQuantity
				);	  		
			$sth = $this->_db->prepare($sql);
			$sth->execute($data);		
		}

		public function getPanier(){
			$sql = "call get_panier(?)";
			
			$this->_setSql($sql);
			$result = $this->getRow(array($this->id_membre));
			return $result;
		}




	}
