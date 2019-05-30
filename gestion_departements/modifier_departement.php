<?php
	$title = 'modifierDepartement';
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):	//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if(!Utilisateur::getUtilisateurConnecte()->estAdmin()):
		Application::alert('vous devez être administrateur pour consulter cette page');
		Application::redir('autre.php');
	endif;
	if(Direction::pasDelements()):	//test pour vérifier qu'il y a des directions car un departement doit être associé à une direction
		Application::alert("aucune direction trouvé!");
		Application::redir('index.php');
	endif;
	if(isset($_GET['id'])):	//test s'il ya un paramétre passé à cette page et si ce dernier est valide ou pas
		$cleId = intval($_GET['id']);
		if(is_int($cleId)):
			$dep = Departement::get($cleId);
			if(!Departement::existe($dep)):
				Application::alert("departement introuvable!");
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
	$departement = Departement::get($cleId);
	$nom = $departement->getNom();
	$idDirection = $departement->getIdDirection();
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
  <!-- Material Design Bootstrap -->
  <link href="../style/mdb4/css/mdb.min.css" rel="stylesheet">
  <link href="../style/fontawesome/css/all.css" rel="stylesheet">
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
    <div class="col-12 col-sm-6 col-md-8 d-flex text-center justify-content-center">
	<div id="main">
		<div id="header">
			<div id="site_content">
				<div id="content">
					<form method="post" action="mod.php?id=<?php echo $_GET['id']; ?>" class="login">
						<fieldset>
							<h2>Modifier département</h2>
							<br/>
							<div class="form-group">
								<label for="nom">Nom:</label>
								<input type="text" class="form-control" name="nom" placeholder="Nom du département" required value="<?php echo $nom; ?>" /><br />
							</div>
							<div class="form-group ">
								<label>Ancienne direction:</label>
								<?php
									echo Direction::get($departement->getIdDirection())->getNom() . ' (' . Direction::get($departement->getIdDirection())->getNomCourt() . ')';
								?>
							</div>
							<div class="form-group ">
								<label for="id_direction">Direction rataché:</label>
								<select class="flex-fill browser-default custom-select" name="id_direction" id="select">
									<?php
									$directions = Direction::getAll();
									$indice = -1;
									for($i=0;$i<count($directions);$i++):
										$direction = $directions[$i];
										//récupérer l'indice de la liste
										if($direction->getId() == $idDirection):
											$indice = $i;
										endif;
									?>
										<option value="<?php echo $direction->getId(); ?>"><?php echo $direction->getNom() . ' (' . $direction->getNomCourt() . ')'; ?></option>
									<?php
									endfor;
									?>
								</select>
								<?php
								if($indice != -1):	//affectation de l'indice
								?>
									<script type="text/javascript">
										document.getElementById("select").selectedIndex = <?php echo $indice; ?>;
									</script>
						<?php
						endif;
						?>
							</div>
							<span><?php echo $message; $_SESSION['message'] = ''; ?></span>
						</fieldset>
						<br/>
											  <button name="modifier_departement" type="submit" class="btn btn-primary">Modifier le département</button>
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