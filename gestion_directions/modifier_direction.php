<?php
	$title = 'modifierDirection';
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
			$direction = Direction::get($cleId);
			if(!Direction::existe($direction)):
				Application::alert('direction introuvable!');
				Application::redir('afficher_direction.php?n=1');
			endif;
		else:
			Application::alert('la clé doit être numérique!');
			Application::redir('afficher_direction.php?n=1');
		endif;
	else:
		Application::alert('paramétre introuvable!');
		Application::redir('afficher_direction.php?n=1');
	endif;
	$nom = (isset($_SESSION['DirectionNom']) && !empty($_SESSION['DirectionNom']))? $_SESSION['DirectionNom'] : $direction->getNom();
	$nomCourt = (isset($_SESSION['DirectionNomCourt']) && !empty($_SESSION['DirectionNomCourt']))? $_SESSION['DirectionNomCourt'] : $direction->getNomCourt();
	$message = (isset($_SESSION['message']) && !empty($_SESSION['message']))? $_SESSION['message']: '';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $title; ?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link href="../style/fontawesome/css/all.css" rel="stylesheet">
    <link href="../style/mdb4/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../style/mdb4/css/mdb.min.css" rel="stylesheet">
  <link href="../style/custom.style.css" rel="stylesheet">

</head>
<body>
  <?php require '../include/cssmenu_admin2.php'; ?>  
  <div class="contcustom">
  <div class="row ">
    <div class="col-4 col-sm-2">
      <ul class="nav flex-column blue lighten-5 py-4">
  <li class="nav-item ">
  <a class="nav-link text-primary" href="../admin.php">Stockage</a>

  </li>

  <li class="nav-item">
  <a class="nav-link text-primary" href="../admin3.php">Intervention</a>
  </li>
  <li class="nav-item">
  <a class="nav-link dark-grey-text" href="#">Matériel</a>
  </li>
</ul>
    </div>
    <div class="col-12 col-sm-6 col-md-8 text-center justify-content-center">
			
			<div id="site_content">

					<div class="container">
					 <!-- Modal content-->


					<form role="form" method="post" action="mod.php?id=<?php echo $_GET['id']; ?>" class="login">
								<h2>Modifier Direction</h2><br/>

								<div class="form-group row justify-content-center">

								<label for="nom" class="col-sm-2 col-form-label">Nom</label>
									<div class="col-sm-3 ">
		  						    <div class="md-form mt-0">
								<input type="text" class="form-control" name="nom" placeholder="Nom de la direction" required value="<?php echo $nom; ?>" />
								</div>
							</div>
						</div>



							<div class="form-group row justify-content-center">
								<label class="col-sm-2 col-form-label" for="nom_court">Nom court</label> 
								<div class="col-sm-3 ">
		   					    <div class="md-form mt-0">
		      						<input type="text" class="form-control" name="nom_court" placeholder="Nom court de la direction" required value="<?php echo $nomCourt; ?>" />
								</div>
							</div>
						</div>
							<?php //Remarque: si c'est la premiére visite la valeur est tirée de la base sinon, la valeur de l'utilisateur est affiché ?>
							<span><?php echo $message; $_SESSION['message'] = ''; ?></span>
						<button class="btn btn-primary pull-" type="submit" name="modifier_direction"> Modifier</button>
					</form>
	

		</div>
	</div>
      </div>
        <div class="col-4 col-sm-2">
      <?php require_once '../include/side_bar_gammes.php'; ?>
    </div>
  </div>
</div>


    <script type="text/javascript" src="../style/mdb4/js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="../style/mdb4/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="../style/mdb4/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="../style/mdb4/js/mdb.min.js"></script>>
</body>
</html>
<!-- Footer -->

 <footer class="page-footer font-small blue" style="position: fixed;width: 100%">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
    <a href="https://mdbootstrap.com/education/bootstrap/"> Gestion de maintenance des matériels informatiques</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->