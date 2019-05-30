<?php
	require_once '../include/include.php';
	$nb_departements = Departement::nb();	//on sauvegarde dans une variable pour ne pas consulter la base une deuxiéme fois
	if (!Utilisateur::utilisateurConnecte())://si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if (Departement::pasDelements()):	//test pour vérifier qu'il y a des départements à afficher
		Application::alert("aucun département trouvé!");
		Application::redir('index.php');
	endif;
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo "afficher_departement ($nb_departements)"; ?></title>
	<meta name="description" content="website description" />
	<meta name="keywords" content="website keywords, website keywords" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="../style/mdb4/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../style/mdb4/css/mdb.min.css" rel="stylesheet">
  <link href="../style/custom.style.css" rel="stylesheet">
  <link href="../style/fontawesome/css/all.css" rel="stylesheet">
	<script type="text/javascript" src="../include/js/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="../include/js/jquery.colorize-1.7.0.js"></script>
	<script type="text/javascript">
		$('document').ready(function(){
			$('table').colorize();
		});
	</script>
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
					<h2>Gestion de département</h2>
						<br/>
					<?php
						$table = Departement::getTableName();	//nom de la table à consulter
						Sort::initOrderLog($table);		//initialiser les ordres
						Sort::initCols($table);			//initialiser les colonnes
						$error = false;				//flag d'erreur
						$msg_erreur = '';			//message d'erreur
						if(Sort::parametresExistent()):
							$paramsExistent = true;	//les paramétres existent
							if(Sort::parametresValides()):
								if(preg_match("~^-?[0-9]+$~i", $_GET['n'])):
									$n = (int) $_GET['n'];				//paramétre passé à la page
									$nb_lignes = Departement::nb();	//nombre totale de lignes
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
									$nb_lignes = Departement::nb();	//nombre totale de lignes
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
							<table class="table container-md table-hover justify-content-center">
								<thead>
								<tr>
									<th><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=id&ordre=<?php echo Sort::$orderLog['id']; ?>&n=<?php echo $_GET['n']; ?>">id <?php Sort::printArrow('id'); ?> </a></th>
									<th><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=id_gamme&ordre=<?php echo Sort::$orderLog['id_direction']; ?>&n=<?php echo $_GET['n']; ?>">id_direction <?php Sort::printArrow('id_direction'); ?> </a></th>
									<th><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=id_direction&ordre=<?php echo Sort::$orderLog['id_direction']; ?>&n=<?php echo $_GET['n']; ?>">nom_direction <?php Sort::printArrow('id_direction'); ?> </a></th>
									<th><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=nom&ordre=<?php echo Sort::$orderLog['nom']; ?>&n=<?php echo $_GET['n']; ?>">nom <?php Sort::printArrow('nom'); ?> </a></th>
									<?php if(Utilisateur::getUtilisateurConnecte()->estAdmin()): ?>
										<th colspan="2">Options</th>
									<?php endif; ?>
								</tr>
								</thead>
								<?php
								foreach($res as $record):
								?>
								<tr>
									<td><?php echo $record['id']; ?></td>
									<td><?php echo $record['id_direction']; ?></td>
									<td>
										<?php
											echo Direction::get($record['id_direction'])->getNom();
										?>
									</td>
									<td><?php echo $record['nom']; ?></td>
									<?php if(Utilisateur::getUtilisateurConnecte()->estAdmin()): ?>
									<td>
										<a href="modifier_departement.php?id=<?php echo $record['id']; ?>">
											<i class="fas fa-pen" style="color: #3F729B; font-size: 25px;"></i>
										</a>
									</td>
									<td>
										<a href="supprimer_departement.php?id=<?php echo $record['id']; ?>" onclick="return(confirm('Supprimer?'))">
											<i class="fas fa-trash-alt" style="color:#ff4444; font-size: 25px;"></i>
										</a>
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
						<a href="../include/telecharger_liste.php?table=departements" target="_blank">
							<img src="../include/img/download.png" style="height: 25px; width: 25px;" title="télécharger" />
						</a>
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