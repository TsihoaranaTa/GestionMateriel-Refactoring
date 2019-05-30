<?php
	$title = 'modifierIntervention';
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):	//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if(!Utilisateur::getUtilisateurConnecte()->estAdmin()):
		Application::alert('vous devez être administrateur pour consulter cette page');
		Application::redir('autre.php');
	endif;
	if(	Etat::pasDelements()):	//test pour vérifier qu'il y a un état car une intervention doit être associé à un état
		Application::alert("aucun état trouvé!");
		Application::redir('index.php');
	endif;
	if(isset($_GET['id'])):	//test s'il ya un paramétre passé à cette page et si ce dernier est valide ou pas
		$cleId = intval($_GET['id']);
		if(is_int($cleId)):
			$in = Intervention::get($cleId);
			if(!Intervention::existe($in)):
				Application::alert("Intervention introuvable!");
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
	$intervention = Intervention::get($cleId);
	$nom = $intervention->getNom();
	$idEtat = $intervention->getIdEtat();
	$idMateriel = $intervention->getIdMateriel();
	$ticket = $intervention->getTicket();
	$cout = $intervention->getCout();
	$temps = $intervention->getTemps();
	$idDirection = $intervention->getIdDirection();
	$idDepartement = $intervention->getIdDepartement();
	$idService = $intervention->getIdService();
	$idPersonnel = $intervention->getIdPersonnel();
	$intervenant = $intervention->getIntervenant();

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
					<form method="post" action="mod.php?id=<?php echo $_GET['id']; ?>" class="login">
						<fieldset>
							<h2>Modifier une intervention</h2><br/>
								<input type="hidden" name="intervenant" value="<?php echo $_SESSION['prenom']; ?>"/>
  								<div class="form-row justify-content-center">
    						<!-- Default input -->
    							<div class="form-group col-md-5">
								<label for="nom">Nom</label>
								<input type="text" class="form-control"  name="nom" placeholder="Nom de l'intervention" required value="<?php echo $nom; ?>" />
							</div>
							<div class="form-group col-md-5">
								<label for="ticket">Ticket</label>
								<input type="text" class="form-control" name="ticket" placeholder="Numéro du ticket" required value="<?php echo $ticket; ?>" />
							</div>
						</div>
							  <div class="form-row justify-content-center">
							    <!-- Default input -->
							    <div class="form-group col-md-5">
								<label for="cout">Cout:</label>
								<input type="number"  class="form-control" name="cout" placeholder="Nouveau coût d'intervention" required value="<?php echo $cout; ?>" /><br />
							</div>

							<div class="form-group col-md-5">
								<label for="temps">Date récéption:</label>
								<input type="date"  class="form-control" name="temps" required value="<?php echo $temps; ?>" /><br />
							</div>
						</div>
				<!--************************* Statu ********************************-->	
							  <div class="form-row justify-content-center">
    							<!-- Default input -->
  							    <div class="form-group col-md-5">								
								<label>Ancien Statu:</label>
								<?php
									echo Etat::get($intervention->getIdEtat())->getNom();
								?>
							
							
								<label for="id_etat">Statu:</label>
								<select class="flex-fill browser-default custom-select" name="id_etat" id="select1">
									<?php
									$etats = Etat::getAll();
									$indice1 = -2;
									for($i=0;$i<count($etats);$i++):
										$etat = $etats[$i];
										//récupérer l'indice de la liste
										if($etat->getId() == $idEtat):
											$indice1 = $i;
										endif;
									?>
										<option value="<?php echo $etat->getId(); ?>"><?php echo $etat->getNom() ; ?></option>
									<?php
									endfor;
									?>
								</select> </div>
					<!--************************* Matériel ********************************-->
								   
    								<!-- Default input -->
  								    <div class="form-group col-md-5" >
								<label>Ancien Matériel:</label>
								<?php
									echo Materiel::get($intervention->getIdMateriel())->getType();
								?>
							
							
								<label for="id_materiel">Materiel</label>
								<select class="flex-fill browser-default custom-select" name="id_materiel" id="select2">
									<?php
									$materiels = Materiel::getAll();
									$indice2 = -1;
									for($i=0;$i<count($materiels);$i++):
										$materiel = $materiels[$i];
										//récupérer l'indice de la liste
										if($materiel->getId() == $idMateriel):
											$indice2 = $i;
										endif;
									?>
										<option value="<?php echo $materiel->getId(); ?>"><?php echo $materiel->getType() ; ?></option>
									<?php
									endfor;
									?>
								</select>
							</div>
						</div>
								  <div class="form-row justify-content-center">
								    <!-- Default input -->
								    <div class="form-group col-md-5" >
								<label>Ancienne référence:</label>
								<?php
									echo Materiel::get($intervention->getIdMateriel())->getReference();
								?>
								<label for="id_materiel">Reference:</label>
								<select class="flex-fill browser-default custom-select" name="id_materiel" id="select2">
									<?php
									$materiels = Materiel::getAll();
									$indice2 = -1;
									for($i=0;$i<count($materiels);$i++):
										$materiel = $materiels[$i];
										//récupérer l'indice de la liste
										if($materiel->getId() == $idMateriel):
											$indice2 = $i;
										endif;
									?>
										<option value="<?php echo $materiel->getId(); ?>"><?php echo $materiel->getReference() ; ?></option>
									<?php
									endfor;
									?>
								</select>
							</div>

							<!--************************* Direction ********************************-->
								<div class="form-group col-md-5">
								<label>Ancienne direction:</label>
								<?php
									echo Direction::get($intervention->getIdDirection())->getNom();
								?>

								<label for="id_direction">Direction:</label>
								<select class="flex-fill browser-default custom-select" name="id_direction" id="select3">
									<?php
									$directions = Direction::getAll();
									$indice3 = -1;
									for($i=0;$i<count($directions);$i++):
										$direction = $directions[$i];
										//récupérer l'indice de la liste
										if($direction->getId() == $idDirection):
											$indice3 = $i;
										endif;
									?>
										<option value="<?php echo $direction->getId(); ?>"><?php echo $direction->getNom() ; ?></option>
									<?php
									endfor;
									?>
								</select>
							</div>
						</div>
								<!--************************* Département ********************************-->
								  <div class="form-row justify-content-center">
								    <!-- Default input -->
								    <div class="form-group col-md-5">
								<label>Ancien dep:</label>
								<?php
									echo Departement::get($intervention->getIdDepartement())->getNom();
								?>

								<label for="id_departement">Departement:</label>
								<select class="flex-fill browser-default custom-select" name="id_departement" id="select4">
									<?php
									$departements = Departement::getAll();
									$indice4 = -1;
									for($i=0;$i<count($departements);$i++):
										$departement = $departements[$i];
										//récupérer l'indice de la liste
										if($departement->getId() == $idDepartement):
											$indice4 = $i;
										endif;
									?>
										<option value="<?php echo $departement->getId(); ?>"><?php echo $departement->getNom() ; ?></option>
									<?php
									endfor;
									?>
								</select>
							</div>
								<!--************************* Service ********************************-->
								<div class="form-group col-md-5">
								<label>Ancien service:</label>
								<?php
									echo Service::get($intervention->getIdService())->getNom();
								?>

								<label for="id_service">Service:</label>
								<select class="flex-fill browser-default custom-select" name="id_service" id="select5">
									<?php
									$services = Service::getAll();
									$indice5 = -1;
									for($i=0;$i<count($services);$i++):
										$service = $services[$i];
										//récupérer l'indice de la liste
										if($service->getId() == $idService):
											$indice5 = $i;
										endif;
									?>
										<option value="<?php echo $service->getId(); ?>"><?php echo $service->getNom() ; ?></option>
									<?php
									endfor;
									?>
								</select><!--************************* Personnel ********************************-->
								</div>
							</div>
							<div class="form-row justify-content-center">
							    <!-- Default input -->
							    <div class="form-group col-md-5">
								<label>Ancien pers:</label>
								<?php
									echo Personnel::get($intervention->getIdPersonnel())->getNom();
								?>

								<label for="id_personnel">personnel:</label>
								<select class="flex-fill browser-default custom-select" name="id_personnel" id="select6">
									<?php
									$personnels = Personnel::getAll();
									$indice6 = -1;
									for($i=0;$i<count($personnels);$i++):
										$personnel = $personnels[$i];
										//récupérer l'indice de la liste
										if($personnel->getId() == $idPersonnel):
											$indice6 = $i;
										endif;
									?>
										<option value="<?php echo $personnel->getId(); ?>"><?php echo $personnel->getNom() ; ?></option>
									<?php
									endfor;
									?>
								</select>
								</div>
								

				<!--************************* Affectation indice ********************************-->
								<?php
								if($indice1 != -1):	//affectation de l'indice
								?>
									<script type="text/javascript">
										document.getElementById("select1").selectedIndex = <?php echo $indice1; ?>;
									</script>
						<?php
						endif;
						?>
								<?php
										if($indice2 != -2):	//affectation de l'indice
										?>
											<script type="text/javascript">
												document.getElementById("select2").selectedIndex = <?php echo $indice2; ?>;
											</script>
								<?php
								endif;
								?>

								<?php
										if($indice3 != -3):	//affectation de l'indice
										?>
											<script type="text/javascript">
												document.getElementById("select3").selectedIndex = <?php echo $indice3; ?>;
											</script>
								<?php
								endif;
								?>
							</div>

							<span><?php echo $message; $_SESSION['message'] = ''; ?></span>
						</fieldset>
						<br/>
						  <button name="modifier_intervention" type="submit" class="btn btn-secondary">Modifier l'intervention</button>
					</form>
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
<!-- Footer -->

 <footer class="page-footer font-small secondary-color" style="position: fixed;width: 100%">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
    <a href="https://mdbootstrap.com/education/bootstrap/"> Gestion de maintenance des matériels informatiques</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->