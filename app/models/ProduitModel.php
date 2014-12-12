<h1>
	Produit</h1>
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
				
				$this->setDesignation($data[1]);
			    $this->setDescriptif($data[2]);
				$this->setQuantite($data[3]);
				$this->setPrix($data[4]);
				$this->setPhoto($data[5]);
				$this->setenVente($data[6]);
				
				}		
		}

		public function add(){
			$sql = "call add_produit(?, ?, ?, ?, ?, ?)";

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
			
		}
		
		public function getProduitsRestant(){
			$sql = "call produit_restant()";
			$this->_setSql($sql);
			$result= $this->getAll();
			
			$arr = array(); 

			for ($i=0; $i < count($result); $i++) { 
				$arr[$i]=intval($result[$i]['id_produit']);

			}	
			return $arr;
			
		
		}

		public function getCataloguesProduit(){   //renvoie les id de tous les catalogues dans lesquels apparait le produit

			$sql="call get_catalogue_produit(?)";

			$this->_setSql($sql);
			$result = $this->getRow(array($this->id_produit));
			var_dump($this->id_produit);

			if (empty($result))
			{
				return false;
			}

			$arr = array(); 
			for ($i=0; $i < count($result); $i++) { 
					$arr[$i]=intval($result[$i]['id_catalogue']);
			}	
			return $arr;
			
		}

		public function getDetailsProduit(){

			$sql="call get_produit(?)";
			$this->_setSql($sql);
			$result = $this->getRow(array($this->id_produit));
			
			if (empty($result))
			{
				return false;
			}
			$arr = array(); 
			$arr[0]=intval($result['id_produit']);
			$arr[1]=$result['designation'];
			$arr[2]=$result['descriptif'];
			$arr[3]=intval($result['quantite']);
			$arr[4]=floatval($result['prix']);
			$arr[5]=$result['photo'];
			$arr[6]=boolval($result['enVente']);
			return $arr;
			
		}
		
		public function update(){  
			$sql="call update_produit(?, ?, ?, ?, ?, ?, ?)";
			$data = array(
				$this->id_produit,
				$this->designation,
				$this->descriptif,
				$this->quantite,
				$this->prix,
				$this->photo,
				$this->enVente
				);
			//var_dump($data);
			$this->_setSql($sql);
			$this->updateM($data);
		}

		public function update_prix($newPrice){
			$sql="call update_produit_prix(?,?)";
			$data = array(
				$this->id_produit,
				$newPrice
				);
			$this->_setSql($sql);
			$this->updateM($data);
		}

		public function delete($id){
			$sql= "call delete_produit(?)";

			$this->_setSql($sql);
			$this->deleteM(array($this->id_produit));
		} 

                  
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
