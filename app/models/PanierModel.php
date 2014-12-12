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
			$sql="INSERT INTO 
			panier(id_membre, id_produit, quantite) 
			VALUES (?, ?, ?)";

			$data = array(
				$this->id_membre,
				$this->id_produit,
				$this->quantite
				);
			$sth = $this->_db->prepare($sql);
			$sth->execute($data);
		}
		
		public function deleteFromPanier(){
			$sql= "DELETE FROM 
					panier
				   WHERE id_produit = ?, id_membre = ?";
			$data = array(
				$this->id_produit,
				$this->id_membre
				);
			$sth = $this->_db->prepare($sql);
			$sth->execute($data);		
		}

		public function deletePanier(){
			$sql= "DELETE FROM 
					panier
				   WHERE id_membre = ?";
			$data = array(
				$this->id_membre
				);
			$sth = $this->_db->prepare($sql);
			$sth->execute($data);		
		}

		public function changeQuantityProduit($newQantity){
			$sql= "UPDATE 
						`panier`
				  SET 
				  		`quantite`='$newQuantity' 
				  WHERE 
				  		`id_produit`=?";

			$data = array(
				$this->id_produit
				);	  		
			$sth = $this->_db->prepare($sql);
			$sth->execute($data);		
		}

		public function getPanier(){
			$sql = "SELECT 
			id_produit, quantite 
			FROM 
			`panier` 
			WHERE 
			id_membre = ?";
			
			$this->_setSql($sql);
			$result = $this->getRow(array($this->id_membre));
			return $result;
		}




	}
