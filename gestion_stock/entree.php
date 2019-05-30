<?php
	$title = 'Reception';
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):
		Application::redir('../login/');
	endif;
  if(Produit::pasDelements()): //s'il n'ya pas de produits, on peut rien recevoir !
    Application::alert("aucun produit trouvé!");
    Application::redir('index.php');
  endif;
  $produits = Produit::getAll(); //produits
  //$gammes = array();  //gammes
	$dateEntree = (isset($_SESSION['EntreeDateEntree']) && !empty($_SESSION['EntreeDateEntree']))? $_SESSION['EntreeDateEntree']: '';
    $idProduit = (isset($_SESSION['EntreeIdEntree']) && !empty($_SESSION['EntreeIdEntree']))? $_SESSION['EntreeIdProduit']: '';
    $quantite = (isset($_SESSION['EntreeQuantite']) && !empty($_SESSION['EntreeQuantite']))? $_SESSION['EntreeQuantite']: '';
  $message = (isset($_SESSION['message']) && !empty($_SESSION['message']))? $_SESSION['message']: '';
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $title; ?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href="../style/mdb4/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../style/mdb4/css/mdb.min.css" rel="stylesheet">
  <link href="../style/custom.style.css" rel="stylesheet">
   <link href="../style/fontawesome/css/all.css" rel="stylesheet">

	<script type="text/javascript" src="../include/js/jquery-1.10.1.min.js"></script>
	<link rel="stylesheet" href="../include/js/jquery-ui-1.10.3/themes/base/jquery.ui.all.css">
	<script src="../include/js/jquery-ui-1.10.3/ui/jquery.ui.core.js"></script>
	<script src="../include/js/jquery-ui-1.10.3/ui/jquery.ui.widget.js"></script>
	<script src="../include/js/jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>
	<!--<link rel="stylesheet" href="../include/js/jquery-ui-1.10.3/demos/demos.css">-->
	<script type="text/javascript">
		$('document').ready(function(){
			$('#datefield').datepicker();
		});
	</script>
	<script type="text/javascript">
		//fonction qui change affiche l'article et la gamme qui correspond au produit sélectionné
		function updateInfo() {
			var list = document.getElementById('produit');
			var indice = list.selectedIndex;
      }
	</script>
</head>
<body onLoad="updateInfo()">
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
    
  <form method="post" action="add_e.php">
    <fieldset>
      <h2>Entrée</h2>

<!-- Default horizontal form -->

  <!-- Grid row -->
  <div class="form-group justify-content-center row">
    <!-- Default input -->
  <label for="datefield" class=" col-sm-3 col-form-label " >Date entrée</label>
    <div class="col-sm-7">
              <input  type='text' id='datefield' name="datefield" required value="<?php echo $dateEntree; ?>" class="form-control"/>
    </div>
  </div>
  <!-- Grid row -->

  <!-- Grid row -->
  <div class="form-group justify-content-center row">
    <!-- Default input -->
   <label for="produit" class="col-sm-3 col-form-label">Produit: </label>
    <div class="col-sm-7">
        <select class="flex-fill browser-default custom-select" onChange="updateInfo()" id="produit" name="produit">
          <?php
            foreach ($produits as $produit) {
              ?>
                <option value="<?php echo $produit->getId(); ?>"><?php echo $produit->getDesignation(); ?></option>
              <?php
            }
          ?>
        </select>
        <!-- script qui permet de sélectionner l'option de la liste précedante -->
        <script>
          var produit = document.getElementById('produit');
          produit.selectedIndex = 0;
        </script>
    </div>
  </div>


        <div class="form-group justify-content-center row">
    <!-- Default input -->
 <label for="qte" class="col-sm-3 col-form-label" >Qantité reçu:</label>
    <div class="col-sm-7">
                    <input type="number" min="1" name="qte" required value="<?php echo $quantite; ?>" class="form-control"/>

    </div>
  </div>

      <span><?php echo $message; $_SESSION['message'] = ''; ?></span>
    </fieldset>
    <button class="btn btn-default" type="submit" name="btn_creat">Création</button>
  </form>

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