<h1>
	Catalogue</h1>
	<?php
	

	require_once"Model.php";


	Class CatalogueModel extends Model {
		private $idCatalogue;
		private $nomCatalogue;
		private $dateMAJ;
		private $catReference;

		

		public function CatalogueModel()
		{
			parent::Model();

		}			

		public function setIdCatalogue($idCatalogue)
		{
			$this->idCatalogue = $idCatalogue;
		}

		public function setNom($nomCatalogue)
		{
			$this->nomCatalogue = $nomCatalogue;
		}

		public function setDateMAJ($dateMAJ)
		{
			$this->dateMAJ = $dateMAJ;
		}


		public function getIdCatalogue()
		{
			return $this->idCatalogue;
		}

		public function getNom($nomCatalogue)
		{
			return $this->nomCatalogue;
		}

		public function getDateMAJ()
		{
			return $this->dateMAJ;
		}

		public function add(){	
			$sql = "call create_catalogue(?)";

			$this->setDateMAJ();
			$data = array($this->nomCatalogue);

			$sth = $this->_db->prepare($sql);
			$sth->execute($data);

		} 


		public function addProduitToCatalogue($id_produit){
			$this->idCatalogue= $this->getIdCatalogueByName();
	
			$sql = "call add_to_catalogue(?, ?)";
			
			$data = array(
				$this->idCatalogue,
				$id_produit
				);

			$sth = $this->_db->prepare($sql);
			$sth->execute($data);
			
		} 
		
		public function removeFromCatalogue($id_produit){

			$sql="call delete_from_catalogue(?, ?)";

			$this->_setSql($sql);
			$result = $this->getRow(array($this->nomCatalogue));
			//var_dump($result);
			$data = array(
				$this->idCatalogue,
				$id_produit
				);

			$sth = $this->_db->prepare($sql);
			$sth->execute($data);
			
		}

		public function getCatalogueById(){

			$sql="SELECT 
			nom
			FROM 
			`catalogue`
			WHERE 
			`id_catalogue`= ?";

			$this->_setSql($sql);
			$result = $this->getRow(array($this->idCatalogue));
		
			if (empty($result))
			{
				return false;
			}

			return $result['nom'];
		}

		public function getProduitsCatalogue(){

			$sql="SELECT 
			id_produit
			FROM 
				catalogue NATURAL JOIN reference NATURAL JOIN produit 
			where 
			id_catalogue= ?";

			$this->_setSql($sql);
			$result = $this->getAll(array($this->idCatalogue));
			//var_dump($result);
			if (empty($result))
			{
				return false;
			}

			$arr = array(); 
			for ($i=0; $i < count($result); $i++) { 
					$arr[$i]=intval($result[$i]['id_produit']);
			}	
			return $arr;
		}


		

		public function updateCatalogue($id, $attribut, $newValue){
		//modifier le produit dans la base
			$sql= "UPDATE 
						`catalogue`
				  SET 
				  		$attribut='$newValue' 
				  WHERE 
				  		`id_catalogue`=?";

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
