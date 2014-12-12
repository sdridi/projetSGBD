<h1>
	Produit</h1>
	<?php
	

	require_once"Model.php";
	require_once"CatalogueModel.php";

	Class Commandeextends Model {
		private $id_commande;
		private $id_membre;
		private $dateValidation;
		private $dateLivraison;
		private $adrLivraison;
		private $fraisDePort;
		
		private produits;

		public function CommandeModel()
		{
			parent::Model();
			produits = new ProduitModel();
		}


		public function setIdCommande($id_commande)
		{
			$this->id_commande = $id_commande;
		}
		public function setDateValidation($dateValidation)
		{
			$this->dateValidation = $dateValidation;
		}
		public function setDateLivraison($dateLivraison)
		{
			$this->dateLivraison = $dateLivraison;
		}

		public function setFraisDePort($fraisDePort)
		{
			$this->fraisDePort = $fraisDePort;
		}

		public function set() {
			// pour regrouper tous les set....
		}

		
		public function getCommandesMembre(){     //requiert de faire a l'avance un setIdMembre(...) du membre correspondant avant de l'appeler
			$sql= "SELECT 
						* 
				   FROM 
				   		commande 
				   	WHERE
				   		id_commande = ?"
	   		$result = $this->getRow(array($this->id_membre));
	   		return $result;
			
		}

		public function CommandeValidationAndUpdate($bonReduction = null){
			
		}

		public function getProduitPU(){
			$sql= "call get_commande_produits_promos (this->id_commande int, this->dateValidation)";
			$sth = $this->_db->prepare($sql);
			$sth->execute();
			return $sth->fetch();

		}
		
		
		
		public function delete($id){
		//supprimer le produit de la base
			$sql= "DELETE FROM
						`produit`
				
				  WHERE 
				  		`designation`=?";

			$this->_setSql($sql);
			$this->deleteM(array($id));
		} 



	}
