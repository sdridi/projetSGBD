<!DOCTYPE html>
<html lang="en">

<?php 
require_once"../models/ProduitModel.php";
//require_once"../models/CatalogueModel.php";



$monCatalogue= new CatalogueModel();
$monProduit= new ProduitModel(116);


//$monProduit->setIdProduit(116);
$monProduit->setDescriptif("bleu");
$tabCat=$monCatalogue->getProduitsCatalogue();

$monProduit->update();
$tabProd=$monProduit->getDetailsProduit();
//$monProduit->setIdProduit('');	

//print_r($tabCat);
var_dump($tabProd);



//$monCatalogue->setNom('divsders');
//$monCatalogue->add();
//$monProduit->delete('calculatrice');

$monProduit->setDesignation('ordinateusdrPortble');
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
