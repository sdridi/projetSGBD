	<?php
	

	require_once"Model.php";
	require_once"CatalogueModel.php";

	Class ProduitModel extends Model {
		private $id_produit;
		private $designation;
		private $descriptif;
		private $quantite;
		private $prix;
		private $photo;
		private $enVente;

		private $catalogue;


		public function ProduitModel($ref=0)
		{
			parent::Model();
			$this->catalogue = new CatalogueModel();
			if($ref){
				$this->setIdProduit($ref);
				$data = $this->getDetailsProduit();

				$this->setDesignation($data["designation"]);
			    $this->setDescriptif($data["descriptif"]);
				$this->setQuantite(intval($data["quantite"]));
				$this->setPrix(floatval($data["prix"]));
				$this->setPhoto($data["photo"]);
				$this->setenVente(boolval($data["enVente"]));
				
				}		
		}

		public function add(){
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
		} 


		public function addToCatalogue($NomCatalogue){

			$id_produit=$this->getIdProduitByDesignation();
			$this->catalogue->setNom($NomCatalogue);
			$this->catalogue->addProduitToCatalogue($id_produit);
			//print("add success"); //a supprimer aprés, juste pour tester
			
		}
		
		public function getProduitRestant(){
			$sql="SELECT 
					*
			FROM 
					`Produit`  
			WHERE 
					`quantite` > 0";
			
			$this->_setSql($sql);
			$result= $this->getAll();
			return $result;
		}

		public function getCataloguesProduit(){   //renvoie les id de tous les catalogues dans lesquels apparait le produit

			$sql="SELECT 
			id_catalogue
			FROM 
				produit NATURAL JOIN reference NATURAL JOIN catalogue 
			where 
			id_produit= ?";

			$this->_setSql($sql);
			$result = $this->getRow(array($this->id_produit));

			if (empty($result))
			{
				return false;
			}

			return $result;
		}

		

		public function getDetailsProduit(){

			$sql="SELECT 
			*
			FROM 
				`produit`  
			WHERE 
			`id_produit`= ?";

			$this->_setSql($sql);
			$result = $this->getRow(array($this->id_produit));
			
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
/*
		public function delete($id){
		//supprimer le produit de la base
			$sql= "DELETE FROM
						`produit`
				
				  WHERE 
				  		`designation`=?";

			$this->_setSql($sql);
			$this->deleteM(array($id));
		} 
*/
                  
                  /* *  *  *  *  *  *  * *  *  *  *  *  *  * Getteurs pour les  attributs * * *  *  *  *  *  * * *  *  *  *  *  */

	 	public function getIdProduit()
		{
			return $this->id_produit;
		}
				  
		public function getDesignation()
		{
			return $this->designation;
		}
		public function getDescriptif()
		{
			return $this->descriptif;
		}

		public function getQuantite()
		{
			return $this->quantite;
		}

		public function getPrix()
		{
			return $this->prix;
		}

		public function getPhoto()
		{
			return $this->photo;
		}

		public function getEnVente()
		{
			return $this->enVente;
		}
		            /* *  *  *  *  *  *  * *  *  *  *  *   *  Setteurs pour les attributs * * *  *  *  *  *  * * *  *  *  *  *  */

		public function setIdProduit($id_produit)
		{
			$this->id_produit = $id_produit;
		}
		public function setDesignation($designation)
		{
			$this->designation = $designation;
		}
		public function setDescriptif($descriptif)
		{
			$this->descriptif = $descriptif;
		}

		public function setQuantite($quantite)
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
			return $this->enVente = $enVente;
		}



	}
