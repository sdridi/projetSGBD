<?php
require_once("Controller.php");
require_once("../models/produitModel.php");
class ControllerProduit extends Controller{
function index()
{
		$d['catalogue'] = array('NbCatalogue' => 0,'NbProduit' =>0,'TabProduit' =>0);
		$this->set($d);
		$this->render("../views/index");
}

function add()
{
		$newProduit = new produitModel();
		
		$newProduit->setDesignation($_GET('designation'));
		if(isset($_GET('descriptif'))
		{
			$newProduit->setDescriptif = $_GET('descriptif');
		}
		$newProduit->setQuantite = $_GET('quantite');
		$newProduit->setPrix = $_GET('prix');
		$newProduit->setEnVente = $_GET('enVente');
		if(isset($_GET())
		{
			$newProduit->setPhoto($_GET('photo'));
		}
		
		$newProduit->add();
		
		
}

function addCata()
{
	$cat = new CatalogueModel();
	$cat->setNom($_GET('designation'));
	echo $cat
	$this->render("../views/adminHome")
}	

function product($ref)
{	
		$p = new ProduitModel($ref);
		$d['produit']= array('produit' => $p,);
		$this->set($d);
		$this->render("../views/pageProduit");
}

function searchAdmin()
{
	$search = $_POST('designation');
	
	$this->render("../views/searchAdmin")
}

function catalogue($ref)
{
		$cat = new CatalogueModel();
		$cat->setIdCatalogue($ref);
		$pid = array();
		$pid = $cat->getProduitsCatalogue();
		
		$p = array(); 
		for($i=0; $i < count($pid); $i++)
			{
				p[$i]= new produitModel($pid[$i]);
			}
		$d['catalogue']= array('idCatalogue' => $ref,'tabProduit' => $p,);
		$this->set($d);
		$this->render("../views/pageProduit");
}

function menu($ref)
{
		
		$d['menu']= array('ActualCat' => $ref,'catList' => $catL,)
		$this->set($d);
		$this->render("../views/menu");
}

}
?>