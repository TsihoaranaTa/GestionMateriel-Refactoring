<?php
	$title = 'ajouterIntervention';
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):	//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if(Etat::pasDelements()):	//test pour vérifier qu'il y a des départements car un matériel doit être associé à un département
		Application::alert("aucun statu trouvé!");
		Application::redir('index.php');
	endif;

	$nom = (isset($_SESSION['InterventionNom']) && !empty($_SESSION['InterventionNom']))? $_SESSION['InterventionNom'] : '';

	$ticket = (isset($_SESSION['InterventionTicket']) && !empty($_SESSION['InterventionTicket']))? $_SESSION['InterventionTicket'] : '';

	$cout = (isset($_SESSION['InterventionCout']) && !empty($_SESSION['InterventionCout']))? $_SESSION['InterventionCout'] : '';

	$temps = (isset($_SESSION['InterventionTemps']) && !empty($_SESSION['InterventionTemps']))? $_SESSION['InterventionTemps'] : '';

	$idEtat = (isset($_SESSION['InterventionIdEtat']) && !empty($_SESSION['InterventionIdEtat']))? $_SESSION['InterventionIdEtat'] : '';

	$idMateriel = (isset($_SESSION['InterventionIdMateriel']) && !empty($_SESSION['InterventionIdMateriel']))? $_SESSION['InterventionIdMateriel'] : '';

	$idDirection = (isset($_SESSION['InterventionIdDirection']) && !empty($_SESSION['InterventionIdDirection']))? $_SESSION['InterventionIdDirection'] : '';
	
	$idDepartement = (isset($_SESSION['InterventionIdDepartement']) && !empty($_SESSION['InterventionIdDepartement']))? $_SESSION['InterventionIdDepartement'] : '';

	$idService = (isset($_SESSION['InterventionIdService']) && !empty($_SESSION['InterventionIdService']))? $_SESSION['InterventionIdService'] : '';
	
	$idPersonnel = (isset($_SESSION['InterventionIdPersonnel']) && !empty($_SESSION['InterventionIdPersonnel']))? $_SESSION['InterventionIdPersonnel'] : '';
	$intervenant = (isset($_SESSION['InterventionIntervenant']) && !empty($_SESSION['InterventionIntervenant']))? $_SESSION['InterventionIntervenant'] : '';

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
  <link href="../style/custom.style.css" rel="stylesheet">
   <link href="../style/fontawesome/css/all.css" rel="stylesheet">
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
    <div class="col-12 col-sm-6 col-md-8 text-center justify-content-center">
  <div id="main">
    <div id="header">

    <div id="site_content">

	<div id="content">
		<h2>Créer une intervention</h2><br/>
	  <!--<form method="post" action="add.php" class="login">
	  		<fieldset>
	  			<h2>Créer une intervention</h2>-->
	    <!-- ***************************** Source panne **************************************** -->
	  			<!--<div>
	  				<label for="nom">Source:</label>
	  				<input type="text" name="nom" placeholder="Source de panne" required value="<?php echo $nom; ?>"/><br />
	  			</div>
	  			<div>
	  				<label for="ticket">Numéro du ticket:</label>
	  				<input type="text" name="ticket" placeholder="Insérer numéro du ticket" required value="<?php echo $ticket; ?>"/><br />
	  			</div>
	  			<div>
	  				<label for="cout">Coût:</label>
	  				<input type="number" name="cout" placeholder="Cout d'intervention" required value="<?php echo $cout; ?>"/><br />
	  			</div>
	  			<div>
	  				<label for="temps">Date de récéption:</label>
	  				<input type="date" name="temps" required value="<?php echo $temps; ?>"/><br />
	  			</div>

	     ***************************** Statu **************************************** -->
	  			<!--<div>
	  				<label for="id_etat">Etat:</label>
					<select name="id_etat" id="select">
					<?php
						$indexList = array();	//id->indice
						$etats = Etat::getAll();
						for($i=0;$i<count($etats);$i++):
							$etat = $etats[$i];
							$indexList[$etat->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $etat->getId(); ?>"><?php echo $etat->getNom(); ?></option>
							<?php
						endfor;
					?>
					</select>
	  			</div>
	  	 ***************************** Matériel **************************************** -->
	  			<!--<div>
	  				<label for="id_materiel">Materiel:</label>
					<select name="id_materiel" id="select2">
					<?php
						$indexList2 = array();	//id->indice
						$materiels = Materiel::getAll();
						for($i=0;$i<count($materiels);$i++):
							$materiel = $materiels[$i];
							$indexList2[$materiel->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $materiel->getId(); ?>"><?php echo $materiel->getType()?></option>
							<?php
						endfor;
					?>
					</select>
	  			</div>
	  			<div>
	  				<label for="id_materiel">Reference:</label>
					<select name="id_materiel" id="select2">
					<?php
						$indexList2 = array();	//id->indice
						$materiels = Materiel::getAll();
						for($i=0;$i<count($materiels);$i++):
							$materiel = $materiels[$i];
							$indexList2[$materiel->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $materiel->getId(); ?>"><?php echo $materiel->getReference()?></option>
							<?php
						endfor;
					?>
					</select>
	  			</div>

	  			 ***************************** Direction **************************************** 
	  			<div>
	  				<label for="id_direction">Direction:</label>
					<select name="id_direction" id="select3">
					<?php
						$indexList3 = array();	//id->indice
						$directions = Direction::getAll();
						for($i=0;$i<count($directions);$i++):
							$direction = $directions[$i];
							$indexList3[$direction->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $direction->getId(); ?>"><?php echo $direction->getNom()?></option>
							<?php
						endfor;
					?>
					</select>
	  			</div>

	  				***************************** Département **************************************** 
	  			<div>
	  				<label for="id_departement">Département:</label>
					<select name="id_departement" id="select4">
					<?php
						$indexList4 = array();	//id->indice
						$departements = Departement::getAll();
						for($i=0;$i<count($departements);$i++):
							$departement = $departements[$i];
							$indexList4[$departement->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $departement->getId(); ?>"><?php echo $departement->getNom()?></option>
							<?php
						endfor;
					?>
					</select>
	  			</div>

	  			 ***************************** Service **************************************** 
	  			<div>
	  				<label for="id_service">Service:</label>
					<select name="id_service" id="select5">
					<?php
						$indexList5 = array();	//id->indice
						$services = Service::getAll();
						for($i=0;$i<count($services);$i++):
							$service = $services[$i];
							$indexList5[$service->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $service->getId(); ?>"><?php echo $service->getNom()?></option>
							<?php
						endfor;
					?>
					</select>
	  			</div>

	  			 ***************************** Personnel **************************************** 
	  			<div>
	  				<label for="id_personnel">Personnel:</label>
					<select name="id_personnel" id="select6">
					<?php
						$indexList6 = array();	//id->indice
						$personnels = Personnel::getAll();
						for($i=0;$i<count($personnels);$i++):
							$personnel = $personnels[$i];
							$indexList6[$personnel->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $personnel->getId(); ?>"><?php echo $personnel->getNom()?></option>
							<?php
						endfor;
					?>
					</select>
	  			</div>
	  			 Pièce de rechange **************************************** 
	  				<a href="../Application/gestion_stock/sortie.php">pièce de rechange</a>


	  			<div>
	  		***************************** Affectation d'indice ************************************* 	
	  			<span><?php echo $message; $_SESSION['message'] = ''; ?></span>
	  		</fieldset>
			<?php
				if(!empty($idEtat) && !empty($idMateriel)):	//affectation de l'indice
					?>
						<script type="text/javascript">
							document.getElementById("select").selectedIndex = <?php echo $indexList[$idEtat]; ?>;
						</script>
					<?php
				endif;
			?>
			<input type="submit" name="add_intervention" value="Ajouter une intervention" />
	  </form>-->





	  <!-- Extended default form grid -->
<form method="post" action="add.php" class="login justify-content-center">
	<input type="hidden" name="intervenant" value="<?php echo $_SESSION['prenom']; ?>"/>
  <!-- Grid row -->
  <div class="form-row justify-content-center">
    <!-- Default input -->
    <div class="form-group col-md-5">
      <label for="nom">Source</label>
      <input type="text" class="form-control" id="inputEmail4" name="nom" placeholder="Source de panne" required value="<?php echo $nom; ?>"/>
    </div>
    <!-- Default input -->
    <div class="form-group col-md-5">
      <label for="ticket">Numéro du ticket </label>
      <input type="text" class="form-control" id="inputPassword4" name="ticket" placeholder="Insérer numéro du ticket" required value="<?php echo $ticket; ?>"/>
    </div>
  </div>
  
  <!-- Default input -->

  <!-- Grid row -->
  <div class="form-row justify-content-center">
    <!-- Default input -->
    <div class="form-group col-md-5">
      <label for="cout">Coût</label>
      <input type="text" class="form-control" id="inputCity" name="cout" placeholder="Cout d'intervention" required value="<?php echo $cout; ?>"/>
    </div>
    <!-- Default input -->
    <div class="form-group col-md-5">
      <label for="temps">Date de récéption</label>
      <input type="date" class="form-control" id="inputZip" name="temps" required value="<?php echo $temps; ?>"/>
    </div>
  </div>

  <div class="form-row justify-content-center">
    <!-- Default input -->
    <div class="form-group col-md-5" >
		<label for="id_etat">Etat</label>
					<select class="flex-fill browser-default custom-select" name="id_etat" id="select">
					<?php
						$indexList = array();	//id->indice
						$etats = Etat::getAll();
						for($i=0;$i<count($etats);$i++):
							$etat = $etats[$i];
							$indexList[$etat->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $etat->getId(); ?>"><?php echo $etat->getNom(); ?></option>
							<?php
						endfor;
					?>
					</select>
    </div>
    <!-- Default input -->
    <div class="form-group col-md-5" >
		<label for="id_materiel">Materiel</label>
					<select class="flex-fill browser-default custom-select" name="id_materiel" id="select2">
					<?php
						$indexList2 = array();	//id->indice
						$materiels = Materiel::getAll();
						for($i=0;$i<count($materiels);$i++):
							$materiel = $materiels[$i];
							$indexList2[$materiel->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $materiel->getId(); ?>"><?php echo $materiel->getType()?></option>
							<?php
						endfor;
					?>
					</select>
    </div>
  </div>

    <div class="form-row justify-content-center">
    <!-- Default input -->
    <div class="form-group col-md-5" >
		<label for="id_materiel">Reference</label>
					<select class="flex-fill browser-default custom-select"name="id_materiel" id="select2">
					<?php
						$indexList2 = array();	//id->indice
						$materiels = Materiel::getAll();
						for($i=0;$i<count($materiels);$i++):
							$materiel = $materiels[$i];
							$indexList2[$materiel->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $materiel->getId(); ?>"><?php echo $materiel->getReference()?></option>
							<?php
						endfor;
					?>
					</select>
    </div>
    <!-- Default input -->
    <div class="form-group col-md-5" >
		<label for="id_direction">Direction</label>
					<select class="flex-fill browser-default custom-select"name="id_direction" id="select3">
					<?php
						$indexList3 = array();	//id->indice
						$directions = Direction::getAll();
						for($i=0;$i<count($directions);$i++):
							$direction = $directions[$i];
							$indexList3[$direction->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $direction->getId(); ?>"><?php echo $direction->getNom()?></option>
							<?php
						endfor;
					?>
					</select>
    </div>
  </div>


  <div class="form-row justify-content-center">
    <!-- Default input -->
    <div class="form-group col-md-5" >
	  				<label for="id_departement">Département</label>
					<select class="flex-fill browser-default custom-select"name="id_departement" id="select4">
					<?php
						$indexList4 = array();	//id->indice
						$departements = Departement::getAll();
						for($i=0;$i<count($departements);$i++):
							$departement = $departements[$i];
							$indexList4[$departement->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $departement->getId(); ?>"><?php echo $departement->getNom()?></option>
							<?php
						endfor;
					?>
					</select>
    </div>
    <!-- Default input -->
    <div class="form-group col-md-5" >
		<label for="id_service">Service</label>
					<select class="flex-fill browser-default custom-select"name="id_service" id="select5">
					<?php
						$indexList5 = array();	//id->indice
						$services = Service::getAll();
						for($i=0;$i<count($services);$i++):
							$service = $services[$i];
							$indexList5[$service->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $service->getId(); ?>"><?php echo $service->getNom()?></option>
							<?php
						endfor;
					?>
					</select>
    </div>
  </div>
    <div class="form-row justify-content-center">
    <!-- Default input -->
    <div class="form-group col-md-5 " >
<label for="id_personnel">Personnel</label>
					<select class="flex-fill browser-default custom-select"name="id_personnel" id="select4">
					<?php
						$indexList6 = array();	//id->indice
						$personnels = Personnel::getAll();
						for($i=0;$i<count($personnels);$i++):
							$personnel = $personnels[$i];
							$indexList6[$personnel->getId()] = $i;	//sauvegarde de l'indice
							?>
								<option value="<?php echo $personnel->getId(); ?>"><?php echo $personnel->getNom()?></option>
							<?php
						endfor;
					?>
					</select>
    </div>
    <!-- Default input -->
    <div class="form-group col-md-5" >
	  				<a class="flex-fill browser-default" href="../Application/gestion_stock/sortie.php">pièce de rechange</a>


	  			<div>
	  		<!-- ***************************** Affectation d'indice ************************************* -->	
	  			<span><?php echo $message; $_SESSION['message'] = ''; ?></span>
	  		</fieldset>
			<?php
				if(!empty($idEtat) && !empty($idMateriel)):	//affectation de l'indice
					?>
						<script type="text/javascript">
							document.getElementById("select").selectedIndex = <?php echo $indexList[$idEtat]; ?>;
						</script>
					<?php
				endif;
			?>
		</div>
    </div>
  </div>
  <!-- Grid row -->
  <button name="add_intervention" type="submit" class="btn btn-secondary">Ajouter</button>
</form>
<!-- Extended default form grid -->
	</div>
    </div>
  
   
  </div>
  </div>
  		</div>
        <div class="col-4 col-sm-2">
			<?php require_once '../include/side_bar_interventions.php'; ?>    
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
</br>
<!-- Footer -->

 <footer class="page-footer font-small secondary-color" style="width: 100%">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
    <a href="https://mdbootstrap.com/education/bootstrap/"> Gestion de maintenance des matériels informatiques</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->