<h1>
	Produit</h1>
	<?php
	

	require"Model.php";
	require"Db.php";



	Class ModelProduit extends Model {
		var $id_produit;
		var $designation;
		var $descriptif;
		var $quantite;
		var $prix;
		var $photo;
		var $enVente;

		public function ModelProduit()
		{
			parent::Model();
			//$this->_db = Db::init();
				//construire un produit sans initialiser les attributs
		}
		// public function __construct($ref)
		// {
		// 	$this->_db = Db::init();
		// 	$this->get();
		// }			

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
			$this->enVente = $enVente;
		}

		public function set() {

		}

		public function add(){
		//rajouter le produit à la base
		//verification?
			// if (!$this->designation && !$this->descriptif && !$this->quantite && !$this->prix && !$this->photo && !$this->enVente && )
			// {
			// 	throw new Exception("No data entry!");
			// }	
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

		
		public function get($id){

			$sql="SELECT 
			*
			FROM 
			produit 
			WHERE 
			id_produit= ?";

			$this->_setSql($sql);
			$result = $this->getRow(array($id));
			//var_dump($result);
			if (empty($result))
			{
				return false;
			}

			return $result;
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

		public function delete($id){
		//supprimer le produit de la base
			$sql= "DELETE FROM
						`produit`
				
				  WHERE 
				  		`id_produit`=?";

			$this->_setSql($sql);
			$this->deleteM(array($id));
		} 


	}
