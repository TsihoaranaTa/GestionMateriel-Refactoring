<?php
	require_once '../include/include.php';
	$nb_interventions = Intervention::nb();	//on sauvegarde dans une variable pour ne pas consulter la base une deuxiéme fois
	if (!Utilisateur::utilisateurConnecte())://si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if (Intervention::pasDelements()):	//test pour vérifier qu'il y a des départements à afficher
		Application::alert("aucune intervention trouvé!");
		Application::redir('index.php');
	endif;
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo "afficher_intervention ($nb_interventions)"; ?></title>
	<meta name="description" content="website description" />
	<meta name="keywords" content="website keywords, website keywords" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link href="../style/fontawesome/css/all.css" rel="stylesheet">
  <link href="../style/mdb4/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../style/mdb4/css/mdb.min.css" rel="stylesheet">
  <link href="../style/custom.style.css" rel="stylesheet">
	<script type="text/javascript" src="../include/js/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="../include/js/jquery.colorize-1.7.0.js"></script>
	<script type="text/javascript">
		$('document').ready(function(){
			$('table').colorize();
		});
	</script>
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
  <a class="nav-link dark-grey-text" href="../admin3.php">Intervention</a>
  </li>
  <li class="nav-item">
  <a class="nav-link text-secondary" href="../gestion_materiels/afficher_materiel.php?n=1">Matériel</a>
  </li>
</ul>
    </div>
    <div class="col-12 col-sm-6 col-md-10 text-center justify-content-center">
	<div id="main">
		<div id="header">
				<div class="">
					<h2>Liste des interventions</h2><br/>
					<?php
						$table = Intervention::getTableName();	//nom de la table à consulter
						Sort::initOrderLog($table);		//initialiser les ordres
						Sort::initCols($table);			//initialiser les colonnes
						$error = false;				//flag d'erreur
						$msg_erreur = '';			//message d'erreur
						if(Sort::parametresExistent()):
							$paramsExistent = true;	//les paramétres existent
							if(Sort::parametresValides()):
								if(preg_match("~^-?[0-9]+$~i", $_GET['n'])):
									$n = (int) $_GET['n'];				//paramétre passé à la page
									$nb_lignes = Intervention::nb();	//nombre totale de lignes
									$nlpp = Application::Lpp();							//nombre de lignes par page
									$derniere_page = ceil($nb_lignes / $nlpp);
									if(!$nb_lignes):	//aucun résultat à afficher
										$error = true;
										$msg_erreur = 'aucun resultat trouvé!';
									else:
										if($n >= 1 && $n <= $derniere_page):	//test sur la valeur de la clé passé
											//OK
											$x = $nlpp * ($n - 1);	//nombre de pages à sauter
											$sql = "SELECT * from $table ORDER BY " . $_GET['col'] . " " . $_GET['ordre'] . " LIMIT $x, $nlpp";
											$res = DB_Manager::query($sql);
											Sort::MAJordre();
										else:
											$error = true;
											$msg_erreur = 'indice de page invalide!';
										endif;	//if($n >= 1 && $n <= $derniere_page)
									endif;
								else:
									$error = true;
									$msg_erreur = 'paramétre érroné, ça doit être une valeur numérique >= 1';
								endif;	//if(preg_match("~^-?[0-9]+$~i", $_GET['n'])):
							else:
								$error = true;
								$msg_erreur = 'parametres invalides!';
							endif;	//if(parametresValides()):
						else:
							//les paramétres col et order n'existent pas, test si le paramétre n existe et est valide
							if(isset($_GET['n'])):
								if(preg_match("~^-?[0-9]+$~i", $_GET['n'])):
									$n = (int) $_GET['n'];				//paramétre passé à la page
									$nb_lignes = Intervention::nb();	//nombre totale de lignes
									$nlpp = Application::Lpp();							//nombre de lignes par page
									$derniere_page = ceil($nb_lignes / $nlpp);
									if(!$nb_lignes):	//aucun résultat à afficher
										$error = true;
										$msg_erreur = 'aucun resultat trouvé!';
									else:
										if($n >= 1 && $n <= $derniere_page):	//test sur la valeur de la clé passé
											//OK
											$x = $nlpp * ($n - 1);	//nombre de pages à sauter
											$sql = "SELECT * from $table LIMIT $x, $nlpp";	//car les autres paramétres sont omises
											$res = DB_Manager::query($sql);
										else:
											$error = true;
											$msg_erreur = 'indice de page invalide!';
										endif;	//if($n >= 1 && $n <= $derniere_page)
									endif;
								else:
									$error = true;
									$msg_erreur = 'paramétre érroné, ça doit être une valeur numérique >= 1';
								endif;	//if(preg_match("~^-?[0-9]+$~i", $_GET['n'])):
							else:
								$error = true;
								$msg_erreur = 'le paramétre n n\'existe pas!';
							endif;
						endif;	//if(parametresExistent()):
						if(!$error):
					?>
							<table class="table table-sm table-hover justify-content-center">
								<thead>
								<tr>
									<!-- ****************** Intervention *************************** -->
									
									<th><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=id&ordre=<?php echo Sort::$orderLog['id']; ?>&n=<?php echo $_GET['n']; ?>">id <?php Sort::printArrow('id'); ?> </a></th>
									<th><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=nom&ordre=<?php echo Sort::$orderLog['nom']; ?>&n=<?php echo $_GET['n']; ?>">commentaire <?php Sort::printArrow('nom'); ?> </a></th>
									<th><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=ticket&ordre=<?php echo Sort::$orderLog['ticket']; ?>&n=<?php echo $_GET['n']; ?>"> ticket <?php Sort::printArrow('ticket'); ?> </a></th>
									<th><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=cout&ordre=<?php echo Sort::$orderLog['cout']; ?>&n=<?php echo $_GET['n']; ?>"> cout <?php Sort::printArrow('cout'); ?> </a></th>
									<th><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=temps&ordre=<?php echo Sort::$orderLog['temps']; ?>&n=<?php echo $_GET['n']; ?>"> date <?php Sort::printArrow('temps'); ?> </a></th>

							<!-- ****************** Statu *************************** -->
									<th><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=id_etat&ordre=<?php echo Sort::$orderLog['id_etat']; ?>&n=<?php echo $_GET['n']; ?>">Statu <?php Sort::printArrow('id_etat'); ?> </a></th>

							

							<!-- ****************** Matériel *************************** -->

									<th><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=id_materiel&ordre=<?php echo Sort::$orderLog['id_materiel']; ?>&n=<?php echo $_GET['n']; ?>">materiel <?php Sort::printArrow('id_materiel'); ?> </a></th>

									<th><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=id_materiel&ordre=<?php echo Sort::$orderLog['id_materiel']; ?>&n=<?php echo $_GET['n']; ?>">Reference <?php Sort::printArrow('id_materiel'); ?> </a></th>

									<!-- ****************** Direction *************************** -->

									<th><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=id_direction&ordre=<?php echo Sort::$orderLog['id_direction']; ?>&n=<?php echo $_GET['n']; ?>">direction <?php Sort::printArrow('id_direction'); ?> </a></th>

									<!-- ****************** Département *************************** -->

									<th><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=id_departement&ordre=<?php echo Sort::$orderLog['id_departement']; ?>&n=<?php echo $_GET['n']; ?>">département <?php Sort::printArrow('id_departement'); ?> </a></th>

									<!-- ****************** Service *************************** -->

									<th><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=id_service&ordre=<?php echo Sort::$orderLog['id_service']; ?>&n=<?php echo $_GET['n']; ?>">service <?php Sort::printArrow('id_service'); ?> </a></th>

									<!-- ****************** Personnel *************************** -->

									<th><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=id_personnel&ordre=<?php echo Sort::$orderLog['id_personnel']; ?>&n=<?php echo $_GET['n']; ?>">personnel <?php Sort::printArrow('id_personnel'); ?> </a></th>

									<!-- ****************** Par *************************** -->

									<th>Par</th>

									
									<?php if(Utilisateur::getUtilisateurConnecte()->estAdmin()): ?>
										<th colspan="2">Options</th>
									<?php endif; ?>
								</tr>
							</thead>
								<?php
								foreach($res as $record):
								?>
								<tr>
							<!-- ****************** Intervention *************************** -->
									<td><?php echo $record['id']; ?></td>
									<td><?php echo $record['nom']; ?></td>
									<td><?php echo $record['ticket']; ?></td>
									<td><?php echo $record['cout']; ?></td>
									<td><?php echo $record['temps']; ?></td>

							<!-- ****************** Statu *************************** -->
									
									<td <?php if(Etat::get($record['id_etat'])->getId() == 1) { ?> style="background-color: #ff4444;color: white;" <?php }elseif(Etat::get($record['id_etat'])->getId() == 2) { ?> style="background-color: #33b5e5;color: white;" <?php } elseif(Etat::get($record['id_etat'])->getId() > 3) { ?> style="background-color: #4B515D;color: white;" <?php } ?>>
										<?php echo Etat::get($record['id_etat'])->getNom();?>
									</td>
							


							<!-- ****************** Matériel *************************** -->
									<td>
										<?php
											echo Materiel::get($record['id_materiel'])->getType();
										?>
									</td>
									<td>
										<?php
											echo Materiel::get($record['id_materiel'])->getReference();
										?>
									</td>

									<!-- ****************** Direction *************************** -->
									<td>
										<?php
											echo Direction::get($record['id_direction'])->getNom();
										?>
									</td>

									<!-- ****************** Département *************************** -->
									<td>
										<?php
											echo Departement::get($record['id_departement'])->getNom();
										?>
									</td>

									<!-- ****************** Service *************************** -->
									<td>
										<?php
											echo Service::get($record['id_service'])->getNom();
										?>
									</td>

									<!-- ****************** Personnel *************************** -->
									<td>
										<?php
											echo Personnel::get($record['id_personnel'])->getNom();
										?>
									</td>

									<!-- ****************** Par *************************** -->
									<td><?php echo $record['intervenant']; ?></td>


							<!-- ****************** Actions *************************** -->
									<?php if(Utilisateur::getUtilisateurConnecte()->estAdmin()): ?>

									<td><?php if($_SESSION['prenom'] == $record['intervenant']) { ?>
										<a href="modifier_intervention.php?id=<?php echo $record['id']; ?>">
											<button class="btn btn-sm posre btn-secondary">Intervenir</button>
										</a>
									</td>
									<td>
										<a href="fiche_intervention.php?id=<?php echo $record['id']; ?>&amp;nom=<?php echo $record['nom']; ?>&amp;ticket=<?php echo $record['ticket']; ?>&amp;cout=<?php echo $record['cout']; ?>&amp;temps=<?php echo $record['temps']; ?>&amp;id_etat=<?php echo Etat::get($record['id_etat'])->getNom(); ?>&amp;id_materiel=<?php echo Materiel::get($record['id_materiel'])->getType(); ?>&amp;id_materiel=<?php echo Materiel::get($record['id_materiel'])->getReference(); ?>&amp;id_direction=<?php echo Direction::get($record['id_direction'])->getNom(); ?>&amp;id_departement=<?php echo Departement::get($record['id_departement'])->getNom(); ?>&amp;id_service=<?php echo Service::get($record['id_service'])->getNom(); ?>&amp;id_personnel=<?php echo Personnel::get($record['id_personnel'])->getNom(); ?>">
											<i class="fas fa-print" style="color:#3F729B; font-size: 25px;"></i>
										</a> 
									</td>

									<td>
										<a href="supprimer_intervention.php?id=<?php echo $record['id']; ?>" onclick="return(confirm('Supprimer?'))">
											<i class="fas fa-trash-alt" style="color:#ff4444; font-size: 25px;"></i>
										</a><?php } else{ ?> </td><td></td><td> <?php }  ?>
									</td>
									<?php endif; ?>
								</tr>
								<?php
								endforeach;
								?>
							</table>
							<?php
							//Remarque: le test if($nb_lignes > $nlpp) est fait pour vérifier le cas où il existe
							//exactement un multiple de $nlpp de lignes à afficher
							if($n == $derniere_page):	//derniére page
								if($nb_lignes > $nlpp):
							?>
									<a href="<?php echo $_SERVER['PHP_SELF']; ?>?n=<?php echo ($n - 1); ?>">&lt;</a><?php /* page précédente */ ?>
							<?php
								endif;
							elseif($n == 1):	//premiére page
								if($nb_lignes > $nlpp):
							?>
									<a href="<?php echo $_SERVER['PHP_SELF']; ?>?n=<?php echo ($n + 1); ?>">&gt;</a><?php /* page suivante */ ?>
										<?php
								endif;
							else:
								?>
								<a href="<?php echo $_SERVER['PHP_SELF']; ?>?n=<?php echo ($n - 1); ?>">&lt;</a><?php /* page précédante */ ?>&nbsp;&nbsp;
								<a href="<?php echo $_SERVER['PHP_SELF']; ?>?n=<?php echo ($n + 1); ?>">&gt;</a><?php /* page suivante */ ?>
								<?php
							endif;
						else:
							echo 'Erreur: ' . $msg_erreur;
						endif; //if(!$error):
							?>
						<br /><br />
				</div>
			</div>
		</div>
	</div> 
	<br/>
        <!--<div class="col-4 col-sm-2">-->
			<!--<?php //require_once '../include/side_bar_interventions.php'; ?>-->    
		<!--</div>-->
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




