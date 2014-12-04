<!DOCTYPE html>
<html lang="en">

<?php require"../models/ModelProduit.php";
         $monProduit= new ModelProduit;

        //$monProduit->add("('chaussure', 'lpfj', '12', '142', 'dzz', 'true')");
        $prod= $monProduit->get(1,"designation");
        echo $prod;
        ?>
