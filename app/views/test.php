<!DOCTYPE html>
<html lang="en">

<?php 
require_once"../models/ProduitModel.php";
//require_once"../models/CatalogueModel.php";



$monCatalogue= new CatalogueModel();
$monProduit= new ProduitModel();

$tabProd=$monProduit->getProduitRestant();
$monCatalogue->setIdCatalogue(22);
$tabCat=$monCatalogue->getProduitsCatalogue();
var_dump($tabCat);

/*
//$monCatalogue->setNom('divsders');
//$monCatalogue->add();
//$monProduit->delete('calculatrice');
*/
$monProduit->setDesignation('ordinateurPortble');
$monProduit->setDescriptif('vert');
$monProduit->setQuantite('456');	
$monProduit->setPrix('145');
$monProduit->setPhoto('chaise');
$monProduit->setEnVente(true);


//$monProduit->add();
//$monProduit->addToCatalogue('divers');


//$id=$monProduit->getIdProduitByDesignation();

//var_dump($id);

       //$prod= $monProduit->getProduitById(5);
//$monProduit->update(5, "designation", "nouvelleDesignation");
//echo $prod;
//$prod= $monProduit->getAttribut(5,"designation");




?>
