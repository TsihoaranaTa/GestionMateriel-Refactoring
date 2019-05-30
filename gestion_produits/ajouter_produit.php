<?php
	$title = 'ajouterProduit';
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):
		//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;

	$designation = (isset($_SESSION['ProduitDesignation']) && !empty($_SESSION['ProduitDesignation']))? $_SESSION['ProduitDesignation'] : '';

	$reference = (isset($_SESSION['ProduitReference']) && !empty($_SESSION['ProduitReference']))? $_SESSION['ProduitReference'] : '';
	$message = (isset($_SESSION['message']) && !empty($_SESSION['message']))? $_SESSION['message']: '';
?>
<!DOCTYPE HTML>
<html>
<head>
  <title><?php echo $title; ?></title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <!-- Bootstrap core CSS -->
  <link href="../style/mdb4/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../style/mdb4/css/mdb.min.css" rel="stylesheet">
  <link href="../style/custom.style.css" rel="stylesheet">
   <link href="../style/fontawesome/css/all.css" rel="stylesheet">
</head>
<body>
	<?php require '../include/cssmenu.php'; ?>
<div class="contcustom">
  <div class="row ">
    <div class="col-4 col-sm-2">
      <ul class="nav flex-column green lighten-5 py-4">
  <li class="nav-item ">
  <a class="nav-link dark-grey-text" href="#">Stockage</a>

  </li>

  <li class="nav-item">
  <a class="nav-link text-default" href="../admin3.php">Intervention</a>
  </li>
  <li class="nav-item">
  <a class="nav-link text-default" href="../admin2.php">Matériel</a>
  </li>
</ul>
    </div>
       <div class="col-12 col-sm-6 col-md-8 text-center d-flex justify-content-center">
        <div id="main">
    <div id="header">
    <div id="site_content">
	<div id="content">

<!--Formulaire d'ajout d'un produit -->

	  <form method="post" action="add.php" class="login">
	  		<fieldset>
	  			<h2>Ajouter un nouveau produit</h2>

	  			<div class="md-form ">
	  				  <input type="text" name="designation" id="form1" class="form-control" required value="<?php echo $designation; ?>">
  					<label for="form1">Désignation</label>
	  			</div>

	  			<div class="md-form ">
	  				<input type="text" name="reference" id="form1" class="form-control" required ><?php echo (isset($reference))?$reference:''; ?>
	  					<label for="form1">Référence</label><br />
	  			</div>
	  			<span><?php echo $message; $_SESSION['message'] = ''; ?></span>
	  		</fieldset>
			<button class="btn btn-default" type="submit" name="add_produit">Ajouter</button>
			<!--<input type="submit" name="add_produit" value="Ajouter le produit" />-->
	  </form>
	</div>
    </div>

    <p>&nbsp;</p>
  </div>
  </div>
</div>
          <div class="col-4 col-sm-2">
           <?php require_once '../include/side_bar_gadgets.php'; ?>
    </div>
    </div>
  </div>

    <script type="text/javascript" src="../style/mdb4/js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="../style/mdb4/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="../style/mdb4/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="../style/mdb4/js/mdb.min.js"></script>
</body>
</html>
<!-- Footer -->

 <footer class="page-footer font-small default-color" style="position: fixed;width: 100%">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
    <a href="https://mdbootstrap.com/education/bootstrap/"> Gestion de maintenance des matériels informatiques</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
