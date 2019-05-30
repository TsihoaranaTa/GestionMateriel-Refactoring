<?php
	$title = 'ajouterMateriel';
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):	//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if(Departement::pasDelements()):	//test pour vérifier qu'il y a des départements car un matériel doit être associé à un département
		Application::alert("aucun département trouvé!");
		Application::redir('index.php');
	endif;

	$type = (isset($_SESSION['MaterielType']) && !empty($_SESSION['MaterielType']))? $_SESSION['MaterielType'] : '';
	$idDepartement = (isset($_SESSION['MaterielIdDepartement']) && !empty($_SESSION['MaterielIdDepartement']))? $_SESSION['MaterielIdDepartement'] : '';
	$idDirection = (isset($_SESSION['MaterielIdDirection']) && !empty($_SESSION['MaterielIdDirection']))? $_SESSION['MaterielIdDirection'] : '';

	$idService = (isset($_SESSION['MaterielIdService']) && !empty($_SESSION['MaterielIdService']))? $_SESSION['MaterielIdService'] : '';
	$idPersonnel = (isset($_SESSION['MaterielIdPersonnel']) && !empty($_SESSION['MaterielIdPersonnel']))? $_SESSION['MaterielIdPersonnel'] : '';

	$reference = (isset($_SESSION['MaterielReference']) && !empty($_SESSION['MaterielReference']))? $_SESSION['MaterielReference'] : '';

	$date = (isset($_SESSION['MaterielDate']) && !empty($_SESSION['MaterielDate']))? $_SESSION['MaterielDate'] : '';

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
	  			<h2>Ajouter un matériel</h2>
	  
  <div class="form-row justify-content-center">
    <!-- Default input -->
    <div class="form-group col-md-5">
   		<label for="type">Type</label>
      <input type="text" class="form-control" id="inputEmail4" name="type" placeholder="Nom du matériel" required value="<?php echo $type; ?>"/>
    </div>
    <!-- Default input -->
    <div class="form-group col-md-5">
      <label for="date">Date réception</label>
      <input type="date" class="form-control" id="inputPassword4" name="date" required value="<?php echo $date; ?>"/>
    </div>
  </div>
		<div class="form-row justify-content-center">
	  			<div class="form-group col-md-5" >
	  				<label for="id_direction">Direction:</label>
					<select class="flex-fill browser-default custom-select"name="id_direction" id="select2">
					<?php
						$indexList2 = array();	//id->indice
						$directions = Direction::getAll();
						for($i=0;$i<count($directions);$i++):
							$direction = $directions[$i];
							$indexList2[$direction->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $direction->getId(); ?>"><?php echo $direction->getNom() . ' (' . $direction->getNomCourt() . ')'; ?></option>
							<?php
						endfor;
					?>
					</select>
	  			</div>

	  			<div class="form-group col-md-5" >
	  				<label for="id_departement">Departement:</label>
					<select class="flex-fill browser-default custom-select"name="id_departement" id="select">
					<?php
						$indexList = array();	//id->indice
						$departements = Departement::getAll();
						for($i=0;$i<count($departements);$i++):
							$departement = $departements[$i];
							$indexList[$departement->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $departement->getId(); ?>"><?php echo $departement->getNom(); ?></option>
							<?php
						endfor;
					?>
					</select>
	  			</div>
</div>
		 <div class="form-row justify-content-center">
	  			<div class="form-group col-md-5" >
	  				<label for="id_service">Service:</label>
					<select class="flex-fill browser-default custom-select"name="id_service" id="select">
					<?php
						$indexList = array();	//id->indice
						$services = Service::getAll();
						for($i=0;$i<count($services);$i++):
							$service = $services[$i];
							$indexList[$service->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $service->getId(); ?>"><?php echo $service->getNom(); ?></option>
							<?php
						endfor;
					?>
					</select>
	  			</div>

	  			<div class="form-group col-md-5" >
	  				<label for="id_personnel">Personnel:</label>
					<select class="flex-fill browser-default custom-select"name="id_personnel" id="select">
					<?php
						$indexList = array();	//id->indice
						$personnels = Personnel::getAll();
						for($i=0;$i<count($personnels);$i++):
							$personnel = $personnels[$i];
							$indexList[$personnel->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $personnel->getId(); ?>"><?php echo $personnel->getNom(); ?></option>
							<?php
						endfor;
					?>
					</select>
	  			</div>
	  		</div>
	  		 <div class="form-row justify-content-center">
	  			<div class="form-group col-md-5">
	  				<label for="reference">Reference:</label>
	  				<input  class="form-control"  type="text" required name="reference"><?php echo (isset($reference))?$reference:''; ?><br />
	  			</div>
	  		</div>
	  			<span><?php echo $message; $_SESSION['message'] = ''; ?></span>
	  		</fieldset>
			<?php
				if(!empty($idDepartement) && !empty($idDirection)):	//affectation de l'indice
					?>
						<script type="text/javascript">
							document.getElementById("select").selectedIndex = <?php echo $indexList[$idDepartement]; ?>;
							document.getElementById("select2").selectedIndex = <?php echo $indexList2[$idDirection]; ?>;
						</script>
					<?php
				endif;
			?>
			  <button name="add_materiel"  type="submit" class="btn btn-primary">Ajouter le matériel</button>
	  </form>
	</div>
    </div>
  
    <p>&nbsp;</p>
  </div>
  </div>
  </div>
        <div class="col-4 col-sm-2">
      <?php require_once '../include/side_bar_materiel.php'; ?>
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