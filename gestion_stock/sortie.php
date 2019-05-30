<?php
  $title = 'Sortie';
  require_once '../include/include.php';
  if(!Utilisateur::utilisateurConnecte()):
    Application::redir('../login/');
  endif;
  if(Produit::pasDelements()): //s'il n'ya pas de produits, on peut rien livrer !
    Application::alert("aucun produit trouvé!");
    Application::redir('index.php');
  endif;
  /* if(Client::pasDelements()): //s'il n'ya pas de clients, on peut rien livrer !
    Application::alert("aucun client trouvé!");
    Application::redir('index.php');
  endif; */
  $produits = Produit::getAll(); //produits
  $qte_stock = array(); //quantités
  //$clients = Client::getAll(); //clients
  $dateSortie = (isset($_SESSION['datefield']) && !empty($_SESSION['datefield']))? $_SESSION['datefield']: '';
    $idProduit = (isset($_SESSION['produit']) && !empty($_SESSION['produit']))? $_SESSION['produit']: '';
    $quantite = (isset($_SESSION['qte']) && !empty($_SESSION['qte']))? $_SESSION['qte']: '';
    $bon = (isset($_SESSION['bon']) && !empty($_SESSION['bon']))? $_SESSION['bon']: '';
    //$idClient = (isset($_SESSION['client']) && !empty($_SESSION['client']))? $_SESSION['client']: '';
    $message = (isset($_SESSION['message']) && !empty($_SESSION['message']))? $_SESSION['message']: '';
?>
<!DOCTYPE HTML>
<html>
<head>
  <title><?php echo $title; ?></title>
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
      $('#datefield').datepicker();
    });
  </script>
  <script type="text/javascript">
      //fonction qui change affiche l'article et la gamme qui correspond au produit sélectionné
      function updateInfo() {
        var list = document.getElementById('produit');
        var qte_stock = document.getElementById('qte_stock');
        var qte_stock_list = document.getElementById('qte_stock_list');
        var indice = list.selectedIndex;
        qte_stock.innerHTML = qte_stock_list.options[indice].text;
      }
  </script>
</head>
<!-- l'attribut onLoad est spécifié pour que les champs gamme et article ne reste pas vide lors du chargement de la page -->
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

  <div id="main">
    <div id="header">

    <div id="site_content">
</br>
    <!--<a href="afficher_sortie.php?n=1">Afficher liste des sorties</a>-->

  <div id="content">
    <form method="post" action="add_s.php">
      <fieldset>
        <h2>Sortie de stock</h2>
        <div class="form-group justify-content-center row">
          <label for="bon"  class=" col-sm-5 col-form-label " >Bon de livraison: </label>
          <div class="col-sm-7">
          <input type='text' required class="form-control" name="bon" value="<?php echo $bon; ?>"/><br />
        </div>
        </div>

        <div class="form-group justify-content-center row">
          <label for="datefield"  class=" col-sm-5 col-form-label " >Date de sortie: </label>
          <div class="col-sm-7">
          <input class="form-control" type='text' id='datefield' required name="datefield" value="<?php echo $dateSortie; ?>"/><br />
        </div>
        </div>

        <div class="form-group justify-content-center row">
          <label for="produit" class="col-sm-5 col-form-label">Produit: </label>
          <div class="col-sm-7">
          <select class="flex-fill browser-default custom-select" onChange="updateInfo()" id="produit" name="produit">
            <?php
              foreach ($produits as $produit) {
                $qte_stock[] = $produit->getQuantite();
                ?>
                  <option value="<?php echo $produit->getId(); ?>"><?php echo $produit->getDesignation(); ?></option>
                <?php
              }
            ?>
          </select>
        </div>
        </div>
    <div class="form-group justify-content-center row">
          <label for="qte_stock" >quantité Stock: </label>
          <span id="qte_stock" class="col-sm-7"></span>
        </div>
        <div class="form-group justify-content-center row">
          <label for="qte" class="col-sm-5 col-form-label">Quantité à sortir:</label>
            <div class="col-sm-7">
          <input class="form-control" type="number" min="1" name="qte" required value="<?php echo $quantite; ?>"/>
        </div>
        </div>
        <div>
          <!-- script pour sélectionner la premiére option des listes de produits et de clients -->
          <script>
            var produit = document.getElementById('produit');
            //var client = document.getElementById('client');
            produit.selectedIndex = 0;
            //client.selectedIndex = 0;
          </script>
        </div>
        <span><?php echo $message; $_SESSION['message'] = ''; ?></span>
      </fieldset>
      <select id="qte_stock_list" style="display:none">
        <?php
          foreach ($qte_stock as $key => $value) { 
            ?>
              <option><?php echo $value; ?></option>
            <?php
          }
        ?>
      </select>
      <button class="btn btn-default" type="submit" name="btn_creat">Création</button>
    </form>
  </div>
    </div>
  </div>
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