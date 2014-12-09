
    
	<h1>
		Produit</h1>
		<?php
		require"Model.php";
		require"Db.php";
		
		
		
		Class ModelProduit extends Model {
		
		$id_produit;
		$designation;
		$descriptif;
		$quantite;
		$prix;
		$photo;
		$enVente;

		public function __construct()
			{
				$this->_db = Db::init();
				//construire un produit sans initialiser les attributs
			}
			public function __construct($ref)
			{
				$this->_db = Db::init();
				$this->get();
			}			

      public function get(){
		//verification?
		////recuperer tout les champs du produit dans la base et remplir les attributs avec
    }
	
			
      public function add(){
		//rajouter le produit à la base
		//verification?
    } 

      public function update(){
		//modifier le produit dans la base
		//verification?
    }

    public function delete(){
		//supprimer le produit de la base
          } 
}