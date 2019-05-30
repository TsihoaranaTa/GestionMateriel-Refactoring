<?php
	$title = 'modifierEtat';
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):	//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if(!Utilisateur::getUtilisateurConnecte()->estAdmin()):
		Application::alert('vous devez être administrateur pour consulter cette page');
		Application::redir('autre.php');
	endif;
	$cleId;
	if(isset($_GET['id'])):	//test s'il ya un paramétre passé à cette page et si ce dernier est valide ou pas
		$cleId = intval($_GET['id']);
		if(is_int($cleId)):
			$etat = Etat::get($cleId);
			if(!Etat::existe($etat)):
				Application::alert('etat introuvable!');
				Application::redir('afficher_etat.php?n=1');
			endif;
		else:
			Application::alert('la clé doit être numérique!');
			Application::redir('afficher_etat.php?n=1');
		endif;
	else:
		Application::alert('paramétre introuvable!');
		Application::redir('afficher_etat.php?n=1');
	endif;
	$nom = (isset($_SESSION['EtatNom']) && !empty($_SESSION['EtatNom']))? $_SESSION['EtatNom'] : $etat->getNom();
	$message = (isset($_SESSION['message']) && !empty($_SESSION['message']))? $_SESSION['message']: '';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $title; ?></title>
	<meta name="description" content="website description" />
	<meta name="keywords" content="website keywords, website keywords" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	 <link href="../style/fontawesome/css/all.css" rel="stylesheet">
  <link href="../style/mdb4/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../style/mdb4/css/mdb.min.css" rel="stylesheet">
  <link href="../style/custom.style.css" rel="stylesheet">
</head>
<body>

	<?php require '../include/cssmenu_admin3.php'; ?>
<div class="contcustom">
  <div class="row ">
    <div class="col-4 col-sm-2">
      <ul class="nav flex-column purple lighten-5 py-4">
  <li class="nav-item ">
  <a class="nav-link text-secondary" href="../admin.php">Stockage</a>

  </li>

  <li class="nav-item">
  <a class="nav-link dark-grey-text" href="#">Intervention</a>
  </li>
  <li class="nav-item">
  <a class="nav-link text-secondary" href="../gestion_materiels/afficher_materiel.php?n=1">Matériel</a>
  </li>
</ul>
    </div>
    <div class="col-12 col-sm-6 col-md-8 text-center d-flex justify-content-center">
	
					<form method="post" action="mod.php?id=<?php echo $_GET['id']; ?>" class="login">
						<fieldset>
							<h2>Modifier état</h2><br/>
										<div class="form-group row justify-content-center">
				<label for="inputEmail3MD " class="col-sm-3 col-form-label">Nom</label>
			<div class="col-sm-7 ">
		      <div class="md-form mt-0">
		        <input type="text" class="form-control" id="inputEmail3MD" name="nom" required value="<?php echo $nom; ?>"/>
		      </div>
		    </div>

			</div>

							<?php //Remarque: si c'est la premiére visite la valeur est tirée de la base sinon, la valeur de l'utilisateur est affiché ?>
							<span><?php echo $message; $_SESSION['message'] = ''; ?></span>
						</fieldset>
								<button class="btn btn-secondary" type="submit" name="modifier_etat" class="btn btn-default">Modifier le statu</button>
					</form>
			
	</div>
        <div class="col-4 col-sm-2">
			<?php require_once '../include/side_bar_etats.php'; ?> 
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

 <footer class="page-footer font-small secondary-color" style="position: fixed;width: 100%">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
    <a href="https://mdbootstrap.com/education/bootstrap/"> Gestion de maintenance des matériels informatiques</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->