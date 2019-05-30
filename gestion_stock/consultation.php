<?php
	$title = 'Consultation';
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):
		Application::redir('../login/');
	endif;
	if(Mouvement::pasDelements()): //s'il n'ya pas de mouvements, on peut rien consulter !
		Application::alert("aucun mouvement trouvé!");
		Application::redir('index.php');
	endif;
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
  <script type="text/javascript" src="../include/js/jquery-1.10.1.min.js"></script>
  <link rel="stylesheet" href="../include/js/jquery-ui-1.10.3/themes/base/jquery.ui.all.css">
  <script src="../include/js/jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
  <script src="../include/js/jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
  <script src="../include/js/jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>
  <!--<link rel="stylesheet" href="../include/js/jquery-ui-1.10.3/demos/demos.css">-->
  <script type="text/javascript">
    $('document').ready(function(){
      $('.datefield').datepicker();
    });
  </script>
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
  <div class="">
		<h2>Consultation</h2>
		<br/>

		<!-- Default form grid -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <!-- Grid row -->
  <div class="row">
    <!-- Grid column -->
    <div class="col">
      <!-- Default input -->
      <input type="text" class="form-control datefield" name="deb" required placeholder="Du">
    </div>
    <!-- Grid column -->

    <!-- Grid column -->
    <div class="col">
      <!-- Default input -->
      <input type="text" class="form-control datefield" name="fin" required placeholder="Jusqu'au">
    </div>
    <!-- Grid column -->
 
  <!-- Grid row -->
     <button class="btn btn-default posre" type="submit" name="submit">Consulter</button>
 </div>
</form>

<br />
    <?php
      if(isSet($_POST['submit'])):
        //affichage des resultats
        $deb = $_POST['deb'];
        $fin = $_POST['fin'];
        if(Application::datesValides($deb, $fin)):
			if(!Mouvement::pasDeMouvements($deb, $fin)):
				$mouvements = Mouvement::getMouvements($deb, $fin);
				?>
					<table id="t" class="table container-md table-hover justify-content-center">
						<thead>
						<tr>
							<th scope="col">id</th>
							<th>type</th>
							<th>date</th>
							<?php if(Utilisateur::getUtilisateurConnecte()->estAdmin()): ?>
								<th colspan="2">options</th>
							<?php endif; ?>
						</tr>
						</thead>
						<?php
						foreach ($mouvements as $mouvement) {
							?>
								<tr>
									<th scope="col"><?php echo $mouvement['id']; ?></th>
									<td><?php echo $mouvement['type']; ?></td>
									<td><?php echo Application::toNormalDate($mouvement['date']); ?></td>
									<?php if(Utilisateur::getUtilisateurConnecte()->estAdmin()): ?>
										<td><a href="modifierMouvement.php?id=<?php echo $mouvement['id']; ?>"><img src="../include/img/edit-icon.png" title="modifier" style="height: 24px; width: 24px;" /></a></td>
										<td><a href="supprimerMouvement.php?id=<?php echo $mouvement['id']; ?>" onclick="return(confirm('Supprimer?'))"><img src="../include/img/delete-icon.png" title="supprimer" style="height: 24px; width: 24px;" /></a></td>
									<?php endif; ?>					
								</tr>
							<?php
						}
						?>
					</table>
				<?php
			else:
				echo 'aucun mouvement a afficher';
			endif;
        else:
          echo 'La date de début doit être <strong style="color:red;font-weight:bold;font-size:1.3em;">avant</strong> la date de fin!';
        endif;
      endif;
    ?>
	</div>
	    </div>
          <div class="col-4 col-sm-2">
        <?php require_once '../include/side_bar_gestion_stock.php'; ?>
    </div>
    </div>
  </div>
      <!--<script type="text/javascript" src="../style/mdb4/js/jquery-3.3.1.min.js"></script>-->
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