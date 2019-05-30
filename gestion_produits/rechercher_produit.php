 <?php
	require_once '../include/include.php';
  $table = Produit::getTableName();
  $title = 'recherche - ' . $table;
	if(!Utilisateur::utilisateurConnecte()):	//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if(Produit::pasDelements()):	//test pour vérifier qu'il y a des produits dans la base
		Application::alert("aucun produit trouvé!");
		Application::redir('index.php');
	endif;
  $options = Produit::loadOptions();
  $afficherResultat = false;
  $last_selected_index = 0; //par défaut on pointe sur la premiére option
  $texte = '';
  $critere = 0;
  if(isset($_POST['btn_submit'])):
    $texte = $_POST['texte'];
    $critere = $_POST['critere'];
    $last_selected_index = $options[$critere];  //récupération de l'indice du choix séléctionné
    if($critere == 'id' || $critere == 'quantite'):
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
  <!-- Bootstrap core CSS -->
  <link href="../style/mdb4/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../style/mdb4/css/mdb.min.css" rel="stylesheet">
  <link href="../style/custom.style.css" rel="stylesheet">
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
  <div class="main">



<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"><h2> recherche <?php echo $table; ?></h2>
  <!-- Grid row -->
  <br/>
  <div class="d-flex p-2 col-example justify-content-center">
    <!-- Grid column -->
    <div class="col-auto flex-fill ">
      <!-- Material input -->
      <div class="form">
          
        <input type="text" class="form-control mb-2" name="texte" required value="<?php echo $texte; ?>" id="inlineFormInputMD" placeholder="Recherche" >
        <label class="sr-only" for="inlineFormInputMD">Name</label>

    </div>
  </div>

    <select class="flex-fill browser-default custom-select col-sm-3" name="critere" id="liste_criteres" >
              <?php
          foreach ($options as $key => $value) {
            ?>
              <option><?php echo $key; ?></option>
            <?php
          }
        ?>
    </select>
 
      <button type="submit" name="btn_submit" value="Rechercher" class="flex-fill btn btn-default posre">Rechercher</button> 

    
    <!-- Grid column -->
  </div>
  <!-- Grid row -->
</form>
<!-- Material auto-sizing form -->


    <br />
	<?php /* code javascript qui permet de séléctionner la derniére option choisie */ ?>
		<script type="text/javascript">
			var liste_criteres = document.getElementById('liste_criteres');
			liste_criteres.selectedIndex = <?php echo $last_selected_index ?>;
		</script>
  <?php
    if($afficherResultat):
      //affichage des résultats s'ils existent!
      if($critere == 'id' || $critere == 'quantite'):
        $res = DB_Manager::select($table, "$critere = '$texte'");
      else:
        $res = DB_Manager::select($table, "$critere LIKE '%$texte%'");
      endif;
      if($res == DB_Manager::$NO_RESULTS): //s'il n'ya pas de résultats
        print('pas de résultats!');
      else:
        $style = 'style="background-color:#92acff;"';
        ?>
          <table class="table container-md table-hover justify-content-center">

            <tr>
              <?php
                foreach ($options as $key => $value) {
                  ?>
                    <th scope="col"<?php if($critere == $key) { echo $style; } ?>><?php echo $key; ?></th>
                  <?php
                }
              ?>
              <?php if(Utilisateur::getUtilisateurConnecte()->estAdmin()): ?>
              	<th colspan="2">Options</th>
              <?php endif; ?>
            </tr>
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
                	<td><a href="modifier_produit.php?id=<?php echo $record['id']; ?>"><img src="../include/img/edit-icon.png" title="modifier" style="height: 24px; width: 24px;" /></a></td>
                	<td><a href="supprimer_produit.php?id=<?php echo $record['id']; ?>" onclick="return(confirm('Supprimer?'))"><img src="../include/img/delete-icon.png" title="supprimer" style="height: 24px; width: 24px;" /></a></td>
                <?php endif; ?>
                </tr>
                <?php
              }
            ?>
          </table>
                <button type="submit" onClick="window.print()" name="btn_submit" value="Rechercher" class="flex-fill btn btn-default">Imprimer cette page</button> 
        <?php
      endif;
    endif;
  ?>
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