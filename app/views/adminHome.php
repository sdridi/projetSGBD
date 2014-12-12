<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../assets/css/shop-item.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <?php include("navBar.php"); ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <?php include("menu.php"); ?>
        
<div class="col-md-9">
                
        <form method="post" action="../views/index.php?p=ControllerProduit&action=add">
            <p>
			Add New Product
                 <br />
                <label>Designation</label> : <input type="text" name="designation" required/>
                <br />
                <label>Descriptif</label> : <input type="text" name="Descriptif" />
                <br />
                <label>Photo</label> : <input type="text" name="photo" />
                <br />
                <label>Quantité</label> : <input type="number" name="quantite" required/>
                <br />
                <label>Prix</label> : <input type="number" name="prix" required/>
                <br />
                <label>EnVente</label> : <input type="checkBox" name="enVente" />
                <br />
                <br />
                <label>Catalogue</label> : <select   name="catalogue" />
						
							<?php include("selectCata.php"); ?>
							</select>
                <br />                
                <input type="submit" value="Add" />
            </p>
        </form>

		
		<form method="post" action="../views/index.php?p=ControllerProduit&action=searchAdmin">
            <p>
			Search Product
                 <br />
                <label>Designation</label> : <input type="text" name="designation" required/>
                <br />
                <input type="submit" value="Search" />
            </p>
        </form>
		
		<form method="post" action="../views/index.php?p=ControllerProduit&action=addCata">
            <p>
			Add Catalogue
                 <br />
                <label>Designation</label> : <input type="text" name="designation" required/>
                <br />
                <input type="submit" value="Add" />
            </p>
        </form>
    </div>      
    </div>
    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>

</body>

</html>
