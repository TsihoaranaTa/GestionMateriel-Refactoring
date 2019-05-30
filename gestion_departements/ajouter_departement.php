<?php
	$title = 'ajouterDepartement';
	require_once '../include/include.php';
	if (!Utilisateur::utilisateurConnecte()):	//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if (Direction::pasDelements()):	//test pour vérifier qu'il y a des directions car un département doit être associé à une direction
		Application::alert("aucune direction trouvé!");
		Application::redir('index.php');
	endif;
	$nom = (isset($_SESSION['DepartementNom']) && !empty($_SESSION['DepartementNom']))? $_SESSION['DepartementNom'] : '';
	$idDirection = (isset($_SESSION['DepartementIdDirection']) && !empty($_SESSION['DepartementIdDirection']))? $_SESSION['DepartementIdDirection'] : '';
	$message = (isset($_SESSION['message']) && !empty($_SESSION['message']))? $_SESSION['message']: '';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $title; ?></title>
	<meta name="description" content="website description" />
	<meta name="keywords" content="website keywords, website keywords" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <link href="../style/mdb4/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style/fontawesome/css/all.css" rel="stylesheet">
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
    <div class="col-12 col-sm-6 col-md-8 text-center d-flex justify-content-center">
	<div id="main">
		<div id="header">
			<div id="site_content">
				<div id="content">
					<form method="post" action="add.php" class="login">
						<fieldset>
							<h2>Ajouter un nouveau département</h2>
							<br/>
							<div class="form-group ">
								<label for="nom">Nom:</label>
								<input class="form-control" type="text" name="nom" placeholder="Nom du département" required value="<?php echo $nom; ?>" /><br />
							</div>
							<div class="form-group ">
								<label for="id_direction">Direction rattaché </label>
								<select class="flex-fill browser-default custom-select" name="id_direction" id="select">
									<?php
									$directions = Direction::getAll();
									if($directions != Direction::$NO_DIRECTION) {
										foreach($directions as $direction):
											?>
												<option value="<?php echo $direction->getId(); ?>"><?php echo $direction->getNom() . ' (' . $direction->getNomCourt() . ')'; ?></option>
											<?php
										endforeach;
									}
									?>
								</select>
							</div>
							<span><?php echo $message; $_SESSION['message'] = ''; ?></span>
						</fieldset>
						<br/>
							  <button name="add_departement" type="submit" class="btn btn-primary">Ajouter</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	      </div>
        <div class="col-4 col-sm-2">
      <?php require_once '../include/side_bar_departements.php'; ?>
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