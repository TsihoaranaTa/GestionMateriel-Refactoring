<?php
	require_once '../include/include.php';
	$nb_produits = Produit::nb();	//on sauvegarde dans une variable pour ne pas consulter la base une deuxiéme fois
	if(!Utilisateur::utilisateurConnecte()):	//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if(Produit::pasDelements()):	//test pour vérifier qu'il y a des produits à afficher
		Application::alert("aucun produit trouvé!");
		Application::redir('index.php');
	endif;
?>
<!DOCTYPE HTML>
<html>
<head>
  <title><?php echo "afficher_produit ($nb_produits)"; ?></title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <!-- Bootstrap core CSS -->
  <link href="../style/mdb4/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../style/mdb4/css/mdb.min.css" rel="stylesheet">
  <link href="../style/custom.style.css" rel="stylesheet">
  <link href="../style/fontawesome/css/all.css" rel="stylesheet">
</head>

<body>
<?php require '../include/cssmenu.php'; ?>

<div class="contcustom">
  <div class="row ">
    <div class="col-4 col-sm-2">
      <ul class="nav flex-column green lighten-5 py-4">
  <li class="nav-item ">
  <a class="nav-link dark-grey-text" href="#">Stockage</a>

  </li>

  <li class="nav-item">
  <a class="nav-link text-default" href="../admin3.php">Intervention</a>
  </li>
  <li class="nav-item">
  <a class="nav-link text-default" href="../admin2.php">Matériel</a>
  </li>
</ul>
    </div>
    <div class="col-12 col-sm-6 col-md-8 text-center d-flex justify-content-center">
    	<div class="row d-flex justify-content-center">

		<h2>Gestion de Stock</h2>

		<?php
			$table = Produit::getTableName();	//nom de la table à consulterr
			Sort::initOrderLog($table);		//initialiser les ordres
			Sort::initCols($table);			//initialiser les colonnes
			$error = false;				//flag d'erreur
			$msg_erreur = '';			//message d'erreur
			if(Sort::parametresExistent()):
				$paramsExistent = true;	//les paramétres existent
				if(Sort::parametresValides()):
					if(preg_match("~^-?[0-9]+$~i", $_GET['n'])):
						$n = (int) $_GET['n'];				//paramétre passé à la page
						$nb_lignes = $nb_gadgets;	//nombre totale de lignes
						$nlpp = Application::Lpp();							//nombre de lignes par page
						$derniere_page = ceil($nb_lignes / $nlpp);
						if(!$nb_lignes):	//aucun résultat à afficher
							$error = true;
							$msg_erreur = 'aucun resultat trouvee!';
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
						$nb_lignes = Produit::nb();	//nombre totale de lignes
						$nlpp = Application::Lpp();							//nombre de lignes par page
						$derniere_page = ceil($nb_lignes / $nlpp);
						if(!$nb_lignes):	//aucun résultat à afficher
							$error = true;
							$msg_erreur = 'aucun resultat trouvee!';
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
				<table class="table container-md table-hover justify-content-center" >
					<thead>
					<tr>
						<th scope="col"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=id&ordre=<?php echo Sort::$orderLog['id']; ?>&n=<?php echo $_GET['n']; ?>">id <?php Sort::printArrow('id'); ?></a></th>
						<th scope="col"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=designation&ordre=<?php echo Sort::$orderLog['designation']; ?>&n=<?php echo $_GET['n']; ?>">designation <?php Sort::printArrow('designation'); ?></a></th>
						<th scope="col"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=quantite&ordre=<?php echo Sort::$orderLog['quantite']; ?>&n=<?php echo $_GET['n']; ?>">quantite <?php Sort::printArrow('quantite'); ?></a></th>
						<th scope="col"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?col=reference&ordre=<?php echo Sort::$orderLog['reference']; ?>&n=<?php echo $_GET['n']; ?>">reference <?php Sort::printArrow('reference'); ?></a></th>
						<?php if(Utilisateur::getUtilisateurConnecte()->estAdmin()): ?>
							<th colspan="2">Options</th>
						<?php endif; ?>
					</tr>
					</thead>
					<tbody>
					<?php
						foreach($res as $record):
							?>
								<tr>
									<th scope="row"><?php echo $record['id']; ?></th>
									<td><?php echo $record['designation']; ?></td>
									<td <?php if($record['quantite'] <= 2){ ?> style="color:#ff4444;" <?php } ?>><?php echo $record['quantite']; ?></td>
									<td><?php echo $record['reference']; ?></td>
									<?php if(Utilisateur::getUtilisateurConnecte()->estAdmin()): ?>
										<td><a href="modifier_produit.php?id=<?php echo $record['id']; ?>"><i class="fas fa-pen" style="color: #3F729B; font-size: 25px;"></i></a></td>
										<td><a href="supprimer_produit.php?id=<?php echo $record['id']; ?>" onclick="return(confirm('Supprimer?'))"><i class="fas fa-trash-alt" style="color:#ff4444; font-size: 25px;"></i></a></td>
									<?php endif; ?>
								</tr>
							<?php
						endforeach;
					?>
					</tbody>
				</table>
				<?php
					//Remarque: le test if($nb_lignes > $nlpp) est fait pour vérifier le cas où il existe exactement un multiple de $nlpp de lignes à afficher
					if($n == $derniere_page):	//derniére page
						if($nb_lignes > $nlpp):
							?>
								<a href="<?php echo $_SERVER['PHP_SELF']; ?>?n=<?php echo ($n - 1); ?>">&lt;</a>	<?php /* page précédante */ ?>
							<?php
						endif;
					elseif($n == 1):	//premiére page
						if($nb_lignes > $nlpp):
							?>
								<a href="<?php echo $_SERVER['PHP_SELF']; ?>?n=<?php echo ($n + 1); ?>">&gt;</a>	<?php /* page suivante */ ?>
							<?php
						endif;
					else:
						?>
							<a href="<?php echo $_SERVER['PHP_SELF']; ?>?n=<?php echo ($n - 1); ?>">&lt;</a>	<?php /* page précédente */ ?> &nbsp;&nbsp;
							<a href="<?php echo $_SERVER['PHP_SELF']; ?>?n=<?php echo ($n + 1); ?>">&gt;</a>	<?php /* page suivante */ ?>
						<?php
					endif;
			else:
				echo 'Erreur: ' . $msg_erreur;
			endif; //if(!$error):
		?>
		<br /><br /><a href="../include/telecharger_liste.php?table=produits" target="_blank"><img src="../include/img/download.png" style="height:25px;width:25px;" title="télécharger"/></a>

    </div>
</div>
        <div class="col-4 col-sm-2">
           <?php require_once '../include/side_bar_gadgets.php'; ?>
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

 <footer class="page-footer font-small default-color" style="position: fixed;width: 100%">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
    <a href="https://mdbootstrap.com/education/bootstrap/"> Gestion de maintenance des matériels informatiques</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->
