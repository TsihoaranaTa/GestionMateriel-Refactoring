<?php
	$title = 'modifierProduit';
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):	//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if(!Utilisateur::getUtilisateurConnecte()->estAdmin()):
		Application::alert('vous devez être administrateur pour consulter cette page');
		Application::redir('autre.php');
	endif;
	if(Produit::pasDelements()):	//test pour vérifier qu'il y a des produits à modifier
		Application::alert("aucun produit trouvé!");
		Application::redir('index.php');
	endif;
	$cleId;
	if(isset($_GET['id'])):	//test s'il ya un paramétre passé à cette page et si ce dernier est valide ou pas
		$cleId = intval($_GET['id']);
		if(is_int($cleId)):
			$p = Produit::get($cleId);
			if(!Produit::existe($p)):
				Application::alert("Produit introuvable!");
				Application::redir('index.php');
			endif;
		else:
			Application::alert("la clé doit être numérique!");
			Application::redir('index.php');
		endif;
	else:
		Application::alert("paramétre introuvable!");
		Application::redir('index.php');
	endif;
	$produit = Produit::get($cleId);
	$designation = (isset($_SESSION['ProduitDesignation']) && !empty($_SESSION['ProduitDesignation']))? $_SESSION['ProduitDesignation']: $produit->getDesignation();
	//$quantite = (isset($_SESSION['GadgetQuantite']) && !empty($_SESSION['GadgetQuantite']))? $_SESSION['GadgetQuantite']: $gadget->getQuantite();
	$reference = (isset($_SESSION['ProduitReference']) && !empty($_SESSION['ProduitReference']))? $_SESSION['ProduitReference']: $produit->getReference();
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
       <div class="col-12 col-sm-6 col-md-8 text-center justify-content-center">
  <form method="post" action="mod.php?id=<?php echo $_GET['id']; ?>" class="login ">
  		<fieldset>
			<h2>Modifier produit</h2>
			<br/>  
			<div class="form-group row justify-content-center">
				<label for="inputEmail3MD " class="col-sm-2 col-form-label">Désignation</label>
			<div class="col-sm-3 ">
		      <div class="md-form mt-0">
		        <input type="text" name="designation" class="form-control" id="inputEmail3MD" required value="<?php echo $designation; ?>"/>
		      </div>
		    </div>

			</div>

						<div class="form-group justify-content-center row ">
				<label for="inputEmail3MD" class="col-sm-2 col-form-label">Réference</label>
			<div class="col-sm-3">
		      <div class="md-form mt-0">
		        <input type="text" name="reference" class="form-control" id="inputEmail3MD" required value="<?php echo $reference; ?>" />
		      </div>
		    </div>
			</div>
			<!--
			<div>
				<label for="quantite">Quantité:</label>
				<input type="number" min="0" name="quantite" placeholder="Quantité du produit" required value="<?php //echo $quantite; ?>"/>
			</div>
			-->
			<span><?php echo $message; $_SESSION['message'] = ''; ?></span>
  		</fieldset>
		<button class="btn btn-default" type="submit" name="modifier_produit" class="btn btn-default">Modifier</button>
  </form>
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