<h1>
	Produit</h1>
	<?php
	

	require_once"Model.php";
	require_once"CatalogueModel.php";

	Class ProduitModel extends Model {
		private $id_membre;
		private $nom;
		private $prenom;
		private $adresse;
		private $mail;
		private $tel;
		private $mod;
		private $id_ville;

		

		public function MembreModel()
		{
			parent::Model();
		}


		public function setIdMembre($id_membre)
		{
			$this->id_membre = $id_membre;
		}
		public function setNom($nom)
		{
			$this->nom;
		}

		public function setPrenom($prenom)
		{
			$this->prenom = $prenom;
		}

		public function set($quantite)
		{
			$this->quantite = $quantite;
		}

		public function setPrix($prix)
		{
			$this->prix = $prix;
		}

		public function setPhoto($photo)
		{
			$this->photo= $photo;
		}

		public function setEnVente($enVente)
		{
			$this->enVente = $enVente;
		}

		public function set() {
			// pour regrouper tous les set....
		}

		public function add($NomCatalogue){

			$sql = "INSERT INTO produit 
			(designation, descriptif, quantite, prix, photo, enVente)
			VALUES 
			(?, ?, ?, ?, ?, ?)";

			$data = array(
				$this->designation,
				$this->descriptif,
				$this->quantite,
				$this->prix,
				$this->photo,
				$this->enVente
				);

			$sth = $this->_db->prepare($sql);
			$sth->execute($data);

			$id_produit=$this->getIdProduitByDesignation();
			//setIdProduit();
			$this->catalogue->addProduitToCatalogue($NomCatalogue, $id_produit);
			

		} 

		
		public function getProduitByID(){

			$sql="SELECT 
			*
			FROM 
			produit 
			WHERE 
			id_produit= ?";

			$this->_setSql($sql);
			$result = $this->getRow(array($this->id_produit));
			//var_dump($result);
			if (empty($result))
			{
				return false;
			}

			return $result;
		}

		public function getIdProduitByDesignation(){

			$sql="SELECT 
			id_produit
			FROM 
			produit 
			WHERE 
			designation= ?";

			$this->_setSql($sql);
			$des=$this->designation;
			$result = $this->getRow(array($des));
			//var_dump($result);
			if (empty($result))
			{
				return false;
			}
//			var_dump($result);
			return intval($result['id_produit']);
		}

		public function getAttribut($id,$attribut){

			$sql = "SELECT 
			`$attribut` 
			FROM 
			`produit` 
			WHERE 
			id_produit = ?";
			$this->_setSql($sql);
			$result = $this->getRow(array($id));

			if (empty($result))
			{
				return false;
			}

			return $result;

		}

		public function getCatalogueByProduit(){

			$sql="SELECT 
			id_catalogue
			FROM 
				produit NATURAL JOIN reference NATURAL JOIN catalogue 
			where 
			id_produit= ?";

			$this->_setSql($sql);
			$result = $this->getRow(array($this->id_produit));
			//var_dump($result);
			if (empty($result))
			{
				return false;
			}

			return $result;
		}



		public function update($id, $attribut, $newValue){
		//modifier le produit dans la base
		//verification?
			$sql= "UPDATE 
						`produit`
				  SET 
				  		`$attribut`='$newValue' 
				  WHERE 
				  		`id_produit`=?";

			$this->_setSql($sql);
			$this->updateM(array($id));
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
