<?php
	require_once '../include/include.php';
  $table = Personnel::getTableName();
  $title = 'recherche - ' . $table;
	if(!Utilisateur::utilisateurConnecte()):	//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if(Personnel::pasDelements()):	//test pour vérifier qu'il y a des personnels dans la base
		Application::alert("aucun personnel trouvé!");
		Application::redir('index.php');
	endif;
  $options = Personnel::loadOptions();
  $afficherResultat = false;
  $last_selected_index = 0; //par défaut on pointe sur la premiére option
  $texte = '';
  $critere = 0;
  if(isset($_POST['btn_submit'])):
    $texte = $_POST['texte'];
    $critere = $_POST['critere'];
    $last_selected_index = $options[$critere];  //récupération de l'indice du choix séléctionné
    if($critere == 'nom' ||$critere == 'id' || $critere == 'id_direction' || $critere == 'id_departement'|| $critere == 'id_service'):
      if(preg_match("~^-?[0-9]+$~i", $texte)):
        //valeur valide
        $afficherResultat = true;
      else:
        //Erreur!
        Application::alert($critere . ' doit être numérique!');
      endif;
    else:
      $afficherResultat = true;
    endif;
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
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <h2>Recherche <?php echo $table; ?></h2>
      <br/>
      <div class="form-row justify-content-center">
      <div class="form-group col-md-5">
      <input type="text" class="form-control sm-14" name="texte" required placeholder="Recherche" value="<?php echo $texte; ?>">
          </div>
  <div class="form-group col-md-4">
      <select class="flex-fill browser-default custom-select col-sm-14" name="critere" id="liste_criteres">
        <?php
          foreach ($options as $key => $value) {
            ?>
              <option><?php echo $key; ?></option>
            <?php
          }
        ?>
      </select>
       </div>
      <div class="form-group col-md-1">
      <button type="submit" name="btn_submit" value="Rechercher" class="flex-fill btn btn-primary posre">Rechercher</button> 
      </div>
    </div>
    </form><br />
	<?php /* code javascript qui permet de séléctionner la derniére option choisie */ ?>
		<script type="text/javascript">
			var liste_criteres = document.getElementById('liste_criteres');
			liste_criteres.selectedIndex = <?php echo $last_selected_index ?>;
		</script>
  <?php
    if($afficherResultat):
      //affichage des résultats s'ils existent!
      if($critere == 'nom' ||$critere == 'id' || $critere == 'id_direction' || $critere == 'id_departement'|| $critere == 'id_service'):
        $res = DB_Manager::select($table, "$critere = '$texte'");
      else:
        $res = DB_Manager::select($table, "$critere LIKE '%$texte%'");
      endif;
      if($res == DB_Manager::$NO_RESULTS): //s'il n'ya pas de résultats
        print('pas de résultats!');
      else:
        $style = 'style="background-color:#92acff;"';
        ?>
          <table class="table table-hover justify-content-center ">
            <thead>
            <tr>
              <?php
                foreach ($options as $key => $value) {
                  ?>
                    <th <?php if($critere == $key) { echo $style; } ?>><?php echo $key; ?></th>
                  <?php
                }
              ?>
              <?php if(Utilisateur::getUtilisateurConnecte()->estAdmin()): ?>
              	<th colspan="2">Options</th>
              <?php endif; ?>
            </tr>
            </thead>
            <?php
              foreach ($res as $record) {
                ?><tr><?php
                foreach ($options as $key => $value) {
                  ?>
                    <td <?php if($critere == $key) { echo $style; } ?>><?php echo $record[$key]; ?></td>
                  <?php
                }
                ?>
                <?php if(Utilisateur::getUtilisateurConnecte()->estAdmin()): ?>
                	<td><a href="modifier_personnel.php?id=<?php echo $record['id']; ?>"><img src="../include/img/edit-icon.png" title="modifier" style="height: 24px; width: 24px;" /></a></td>
                	<td><a href="supprimer_personnel.php?id=<?php echo $record['id']; ?>" onclick="return(confirm('Supprimer?'))"><img src="../include/img/delete-icon.png" title="supprimer" style="height: 24px; width: 24px;" /></a></td>
                <?php endif; ?>
                </tr>
                <?php
              }
            ?>
          </table>
                    <button type="submit" onClick="window.print()" name="btn_submit" value="Rechercher" class="flex-fill btn btn-primary">Imprimer cette page</button> 
        <?php
      endif;
    endif;
  ?>
	</div>
    </div>
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