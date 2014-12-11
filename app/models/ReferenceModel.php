<h1>
	Reference</h1>
	<?php
	

	require_once"Model.php";
	require"ProduitModel.php";
	require"CatalogueModel.php";


	Class ReferenceModel extends Model {
		var $id_produit;
		var $id_catalogue;
		var $refCatalogue;
		var $refProduit;
		

		public function ReferenceModel()
		{
			parent::Model();
			$refCatalogue = new CatalogueModel();
			$refProduit = new ProduitModel();
			

		}
		
		public function addReference($Catalogue = null, $nomProduit = null){

			$id_catalogue = $refCatalogue.getIdCatalogueByName($nomCatalogue);
			$id_produit = $refProduit.getIdProduitByName($nomProduit);

			$sql = "INSERT INTO reference 
			(id_catalogue, id_produit)
			VALUES 
			(?, ?)";

			$data = array(
				$this->id_catalogue,
				$this->id_produit
				);

			$sth = $this->_db->prepare($sql);
			 $sth->execute($data);
		 
		}
		

		public function getCatalogueByIdProduit($idProduit){

			$sql="SELECT 
			id_catalogue
			FROM 
			reference
			WHERE 
			id_produit= ?";

			$this->_setSql($sql);
			$result = $this->getRow(array($idProduit));
			//var_dump($result);
			if (empty($result))
			{
				return false;
			}

			return $result;
		}

		public function getProduitByIdCatalogue($idCatalogue){

			$sql="SELECT 
			id_produit
			FROM 
			reference
			WHERE 
			id_catalogue= ?";

			$this->_setSql($sql);
			$result = $this->getRow(array($idCatalogue));
			//var_dump($result);
			if (empty($result))
			{
				return false;
			}

			return $result;
		}



	}
