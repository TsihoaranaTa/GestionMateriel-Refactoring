<?php
	$title = 'modifierMateriel';
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):	//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if(!Utilisateur::getUtilisateurConnecte()->estAdmin()):
		Application::alert('vous devez être administrateur pour consulter cette page');
		Application::redir('autre.php');
	endif;
	if(Materiel::pasDelements()):	//test pour vérifier qu'il y a des matériels à modifier
		Application::alert("aucun matériel trouvé!");
		Application::redir('index.php');
	endif;
	$cleId;
	if(isset($_GET['id'])):	//test s'il ya un paramétre passé à cette page et si ce dernier est valide ou pas
		$cleId = intval($_GET['id']);
		if(is_int($cleId)):
			$mat = Materiel::get($cleId);
			if(!Materiel::existe($mat)):
				Application::alert("matériel introuvable!");
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
	$materiel = Materiel::get($cleId);

	$type = (isset($_SESSION['MaterielType']) && !empty($_SESSION['MaterielType']))? $_SESSION['MaterielType']: $materiel->getType();

	$idDepartement = (isset($_SESSION['MaterielIdDepartement']) && !empty($_SESSION['MaterielIdDepartement']))? $_SESSION['MaterielIdDepartement']: $materiel->getIdDepartement();

	$idDirection = (isset($_SESSION['MaterielIdDirection']) && !empty($_SESSION['MaterielIdDirection']))? $_SESSION['MaterielIdDirection']: $materiel->getIdDirection();

	$idService = (isset($_SESSION['MaterielIdService']) && !empty($_SESSION['MaterielIdService']))? $_SESSION['MaterielIdService']: $materiel->getIdService();

	$idPersonnel = (isset($_SESSION['MaterielIdPersonnel']) && !empty($_SESSION['MaterielIdPersonnel']))? $_SESSION['MaterielIdPersonnel']: $materiel->getIdPersonnel();

	$reference = (isset($_SESSION['MaterielReference']) && !empty($_SESSION['MaterielReference']))? $_SESSION['MaterielReference']: $materiel->getReference();

	$date = (isset($_SESSION['MaterielDate']) && !empty($_SESSION['MaterielDate']))? $_SESSION['MaterielDate']: $materiel->getDate();
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
		<h2>Modifier le matériel</h2>
  <!--<form method="post" action="mod.php?id=<?php echo $_GET['id']; ?>" class="login">
  		<fieldset>
			
			
			<div>
				<label for="type">Type:</label>
				<input type="text" name="type" placeholder="Nom du matériel" required value="<?php echo $type; ?>"/>
			</div>
			<div>
				<label for="date">Date réception:</label>
				<input type="date" name="date" required value="<?php echo $date; ?>"/>
			</div>-->
			<!--<div>
				<label for="id_departement"></label>
				Ancien département: <?php echo Departement::get($materiel->getIdDepartement())->getNom(); ?>
			</div>
			<div>
				<label for="select">Departement:</label>
				<select name="id_departement" id="select">
					<?php
						$departements = Departement::getAll();
						$indice = -1;
						for($i=0;$i<count($departements);$i++):
							$departement = $departements[$i];
							//récupérer l'indice de la liste
							if($departement->getId() == $idDepartement):
								$indice = $i;
							endif;
							?>
								<option value="<?php echo $departement->getId(); ?>"><?php echo $departement->getNom(); ?></option>
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
			</div>-->
			<!--<div>
				<label for="id_direction">Direction:</label>
				<select name="id_direction" id="select2">
					<?php
						$directions = Direction::getAll();
						$indice2 = -1;
						for($i=0;$i<count($directions);$i++):
							$direction = $directions[$i];
							//récupérer l'indice de la liste
							if($direction->getId() == $idDirection):
								$indice2 = $i;
							endif;
							?>
								<option value="<?php echo $direction->getId(); ?>"><?php echo $direction->getNom(); ?></option>
							<?php		
						endfor;
					?>
				</select>
				<?php
					if($indice2 != -1):	//affectation de l'indice
						?>
							<script type="text/javascript">
								document.getElementById("select2").selectedIndex = <?php echo $indice2; ?>;
							</script>
						<?php
					endif;
				?>
			</div>-->


			<!--<div>
				<label for="id_service">Service:</label>
				<select name="id_service" id="select3">
					<?php
						$services = Service::getAll();
						$indice3 = -1;
						for($i=0;$i<count($services);$i++):
							$service = $services[$i];
							//récupérer l'indice de la liste
							if($service->getId() == $idService):
								$indice3 = $i;
							endif;
							?>
								<option value="<?php echo $service->getId(); ?>"><?php echo $service->getNom(); ?></option>
							<?php		
						endfor;
					?>
				</select>
				<?php
					if($indice2 != -1):	//affectation de l'indice
						?>
							<script type="text/javascript">
								document.getElementById("select3").selectedIndex = <?php echo $indice3; ?>;
							</script>
						<?php
					endif;
				?>
			</div>-->

			<!--<div>
				<label for="id_personnel">Personnel:</label>
				<select name="id_personnel" id="select4">
					<?php
						$personnels = Personnel::getAll();
						$indice4 = -1;
						for($i=0;$i<count($personnels);$i++):
							$personnel = $personnels[$i];
							//récupérer l'indice de la liste
							if($personnel->getId() == $idPersonnel):
								$indice4 = $i;
							endif;
							?>
								<option value="<?php echo $personnel->getId(); ?>"><?php echo $personnel->getNom(); ?></option>
							<?php		
						endfor;
					?>
				</select>
				<?php
					if($indice2 != -1):	//affectation de l'indice
						?>
							<script type="text/javascript">
								document.getElementById("select3").selectedIndex = <?php echo $indice3; ?>;
							</script>
						<?php
					endif;
				?>
			</div>-->
			
			<!--<div>
				<label for="reference">Références:</label>
				<textarea name="reference"><?php echo $reference; ?></textarea>
			</div>
			<span><?php echo $message; $_SESSION['message'] = ''; ?></span>
  		</fieldset>
		<input type="submit" name="modifier_materiel" value="Modifier materiel" />
  </form>-->



  <!--debuuuuutttttttt-->
 <form method="post" action="mod.php?id=<?php echo $_GET['id']; ?>" class="login">
  <!-- Grid row -->
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
  
  <!-- Default input -->

  <!-- Grid row -->
  <div class="form-row justify-content-center">

    <!-- Default input -->
    <div class="form-group col-md-5">
	<label for="select">Departement: </label>
	     <span style="color:silver;" ><label for="id_departement"></label>
				(Ancien: <?php echo Departement::get($materiel->getIdDepartement())->getNom(); ?>)</span>
<select class="flex-fill browser-default custom-select" name="id_departement" id="select">
					<?php
						$departements = Departement::getAll();
						$indice = -1;
						for($i=0;$i<count($departements);$i++):
							$departement = $departements[$i];
							//récupérer l'indice de la liste
							if($departement->getId() == $idDepartement):
								$indice = $i;
							endif;
							?>
								<option value="<?php echo $departement->getId(); ?>"><?php echo $departement->getNom(); ?></option>
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

        <div class="form-group col-md-5" >
		<label for="id_direction">Direction</label>
				<select class="flex-fill browser-default custom-select"name="id_direction" id="select2">
					<?php
						$directions = Direction::getAll();
						$indice2 = -1;
						for($i=0;$i<count($directions);$i++):
							$direction = $directions[$i];
							//récupérer l'indice de la liste
							if($direction->getId() == $idDirection):
								$indice2 = $i;
							endif;
							?>
								<option value="<?php echo $direction->getId(); ?>"><?php echo $direction->getNom(); ?></option>
							<?php		
						endfor;
					?>
				</select>
				<?php
					if($indice2 != -1):	//affectation de l'indice
						?>
							<script type="text/javascript">
								document.getElementById("select2").selectedIndex = <?php echo $indice2; ?>;
							</script>
						<?php
					endif;
				?>
    </div>
  </div>

  <div class="form-row justify-content-center">
    <!-- Default input -->

    <!-- Default input -->
    <div class="form-group col-md-5" >
			<label for="id_service">Service</label>
					<select class="flex-fill browser-default custom-select"name="id_service" id="select3">
					<?php
						$services = Service::getAll();
						$indice3 = -1;
						for($i=0;$i<count($services);$i++):
							$service = $services[$i];
							//récupérer l'indice de la liste
							if($service->getId() == $idService):
								$indice3 = $i;
							endif;
							?>
								<option value="<?php echo $service->getId(); ?>"><?php echo $service->getNom(); ?></option>
							<?php		
						endfor;
					?>
				</select>
				<?php
					if($indice2 != -1):	//affectation de l'indice
						?>
							<script type="text/javascript">
								document.getElementById("select3").selectedIndex = <?php echo $indice3; ?>;
							</script>
						<?php
					endif;
				?>
    </div>
        <div class="form-group col-md-5" >
			<label for="id_personnel">Personnel</label>
				<select class="flex-fill browser-default custom-select"name="id_personnel" id="select4">
					<?php
						$personnels = Personnel::getAll();
						$indice4 = -1;
						for($i=0;$i<count($personnels);$i++):
							$personnel = $personnels[$i];
							//récupérer l'indice de la liste
							if($personnel->getId() == $idPersonnel):
								$indice4 = $i;
							endif;
							?>
								<option value="<?php echo $personnel->getId(); ?>"><?php echo $personnel->getNom(); ?></option>
							<?php		
						endfor;
					?>
				</select>
				<?php
					if($indice2 != -1):	//affectation de l'indice
						?>
							<script type="text/javascript">
								document.getElementById("select3").selectedIndex = <?php echo $indice3; ?>;
							</script>
						<?php
					endif;
				?>
    </div>
  </div>

    <div class="form-row justify-content-center">
    <!-- Default input -->

    <!-- Default input -->
    <div class="form-group col-md-5" >
		<label for="reference">Références</label>
      <input type="text" class="form-control" id="inputEmail4" name="reference" required value="<?php echo $reference; ?>"/>
    </div>
  </div>

  
  <!-- Grid row -->
  	<span><?php echo $message; $_SESSION['message'] = ''; ?></span>
  <button name="modifier_materiel" type="submit" class="btn btn-primary">Modifier le matériel</button>
</form>
  <!--fin-->
	</div>
    </div>
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