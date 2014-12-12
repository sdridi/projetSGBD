<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sign up</title>

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
                
        <form method="post" action="../views/index.php?p=ControllerMember&action=addProcess">
            <p>
                 <br />
                <label>First name</label> : <input type="text" name="firstname" required/>
                <br />
                <label>Last name</label> : <input type="text" name="lastname" required/>
                <br />
                <label>Adress</label> : <input type="text" name="adress" required/>
                <br />
                <label>City</label> : <input type="text" name="city" required/>
                <br />
                <label>Postal code</label> : <input type="text" name="pcode" required/>
                <br />
                <label>Email</label> : <input type="email" name="email" required/>
                <br />
                <label>Tel</label> : <input type="number" name="tel" required/>
                <br />
                <label>Password</label> : <input type="password" name="pass" required/>
                <br />
                <label>RepeatPassword</label> : <input type="password" name="repass" required/>
                <br />
                <input type="submit" value="Sign Up" />
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
