<h1>
	Produit</h1>
	<?php
	

	require_once"Model.php";
	require_once"CatalogueModel.php";

	Class MembreModel extends Model {
		private $id_membre;
		private $nom;
		private $prenom;
		private $adresse;
		private $mail;
		private $tel;
		private $mdp;
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

		public function setAdresse($adresse)
		{
			$this->adresse = $adresse;
		}

		public function setMail($mail)
		{
			$this->mail = $mail;
		}

		public function setTel($tel)
		{
			$this->tel= $tel;
		}

		public function setMDP($mdp)
		{
			$this->mdp = $mdp;
		}

		public function setIdVille($id_ville)
		{
			$this->id_ville = $id_ville;
		}

		public function set() {
			// pour regrouper tous les set....
		}


		public function add($NomCatalogue){

			$sql = "INSERT INTO membre 
			(nom, prenom, adresse, mail, tel, mdp, id_ville)
			VALUES 
			(?, ?, ?, ?, ?, ?, ?)";

			$data = array(
				$this->nom,
				$this->prenom,
				$this->adresse,
				$this->mail,
				$this->tel,
				$this->mdp,
				$this->id_ville
				);

			$sth = $this->_db->prepare($sql);
			$sth->execute($data);
		} 

		
		

		public function {
			$sql=" SELECT  if(exists(select id_admin from admin where username = username_admin
	       	  		 	   	       and mdp = mdp_admin),
		   id_admin, 0) as isValid
	       from admin where username = username_admin;";
			$sth = $this->_db->prepare($sql);
			$sth->execute($data);

		}

		public function getAttribut($id,$attribut){

			$sql = "SELECT 
			`$attribut` 
			FROM 
			`membre` 
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

		



		public function updateMembre($id, $attribut, $newValue){
		//modifier le produit dans la base
		//verification?
			$sql= "UPDATE 
						`membre`
				  SET 
				  		`$attribut`='$newValue' 
				  WHERE 
				  		`id_membre`=?";

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
