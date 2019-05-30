<?php
	$title = 'ajouterPersonnel';
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):	//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;

	$nom = (isset($_SESSION['PersonnelNom']) && !empty($_SESSION['PersonnelNom']))? $_SESSION['PersonnelNom'] : '';
	$idDirection = (isset($_SESSION['PersonnelIdDirection']) && !empty($_SESSION['PersonnelIdDirection']))? $_SESSION['PersonnelIdDirection'] : '';
	$idDepartement = (isset($_SESSION['PersonnelIdDepartement']) && !empty($_SESSION['PersonnelIdDepartement']))? $_SESSION['PersonnelIdDepartement'] : '';
	$idService = (isset($_SESSION['PersonnelIdService']) && !empty($_SESSION['PersonnelIdService']))? $_SESSION['PersonnelIdService'] : '';
	
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
  <div id="main">
    <div id="header">
    <div id="site_content">
	<div id="content">
	  <form method="post" action="add.php" class="login">
	  		<fieldset>
	  			<h2>Ajouter un nouveau personnel</h2><br/>
	 			<div class="form-row justify-content-center">
	  			<div class="form-group col-md-5">
	  				<label for="nom">Nom et prénom</label>
	  				<input type="text" class="form-control" name="nom" placeholder="nom" required value="<?php echo $nom; ?>"/><br />
	  			</div>
	  			<div class="form-group col-md-5">
	  				<label for="id_direction">Direction</label>
					<select class="flex-fill browser-default custom-select" name="id_direction" id="select">
					<?php
						$indexList = array();	//id->indice
						$directions = Direction::getAll();
						for($i=0;$i<count($directions);$i++):
							$direction = $directions[$i];
							$indexList[$direction->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $direction->getId(); ?>"><?php echo $direction->getNom(); ?></option>
							<?php
						endfor;
					?>
					</select>
	  			</div>
	  		</div>
	  			<div class="form-row justify-content-center">
	  			<div class="form-group col-md-5">
	  				<label for="id_departement">Département</label>
					<select class="flex-fill browser-default custom-select" name="id_departement" id="select2">
					<?php
						$indexList2 = array();	//id->indice
						$departements = Departement::getAll();
						for($i=0;$i<count($departements);$i++):
							$departement = $departements[$i];
							$indexList2[$departement->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $departement->getId(); ?>"><?php echo $departement->getNom(); ?></option>
							<?php
						endfor;
					?>
					</select>
	  			</div>

	  			<div class="form-group col-md-5">
	  				<label for="id_service">Service</label>
					<select class="flex-fill browser-default custom-select" name="id_service" id="select3">
					<?php
						$indexList3 = array();	//id->indice
						$services = Service::getAll();
						for($i=0;$i<count($services);$i++):
							$service = $services[$i];
							$indexList3[$service->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $service->getId(); ?>"><?php echo $service->getNom(); ?></option>
							<?php
						endfor;
					?>
					</select>
	  			</div>
	  		</div>
	  			<span><?php echo $message; $_SESSION['message'] = ''; ?></span>
	  		</fieldset>
			<?php
				if(!empty($idDirection) && !empty($idDepartement) && !empty($idService)):	//affectation de l'indice
					?>
						<script type="text/javascript">
							document.getElementById("select").selectedIndex = <?php echo $indexList[$idDirection]; ?>;
							document.getElementById("select2").selectedIndex = <?php echo $indexList2[$idDepartement]; ?>;
							document.getElementById("select3").selectedIndex = <?php echo $indexList3[$idService]; ?>;
						</script>
					<?php
				endif;
			?>
					  <button name="add_personnel" type="submit" class="btn btn-primary">Ajouter</button>
	  </form>
	</div>
    </div>
    <p>&nbsp;</p>
  </div>
  </div>
    </div>
        <div class="col-4 col-sm-2">
      <?php require_once '../include/side_bar_personnels.php'; ?>
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