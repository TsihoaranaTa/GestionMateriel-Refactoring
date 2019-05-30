<?php
	require_once 'include/include.php';
	$title = 'Administration';
	if(!Utilisateur::utilisateurConnecte()):
		Application::alert('vous devez connecter pour consulter cette page');
		Application::redir('login/');
	endif;
	if(!Utilisateur::getUtilisateurConnecte()->estAdmin()):
		Application::alert('vous devez être administrateur pour consulter cette page');
		Application::redir('../Application/gestion_interventions/afficher_intervention.php?n=1');
	endif;
?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Bootstrap core CSS -->
  <link href="style/mdb4/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="style/mdb4/css/mdb.min.css" rel="stylesheet">
  <link href="style/custom.style.css" rel="stylesheet">
  <link href="style/fontawesome/css/all.css" rel="stylesheet">  
    <script src="main.js"></script>
</head>

<body>
 <nav class="mb-1 navbar fixed-top navbar-expand-lg navbar-dark default-color">

     <a class="navbar-brand" href="admin.php"><strong>Accueil</strong></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

     <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">


 		<li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Etat stock</a>
      
         
       <!--<a href='gestion_produits/afficher_produit.php?n=1'>-->

                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href="gestion_produits/ajouter_produit.php">Ajouter produit</a>
          <a class="dropdown-item" href="gestion_produits/rechercher_produit.php">Rechercher</a>
          <a class="dropdown-item" href="gestion_produits/afficher_produit.php?n=1"><span>Afficher(<?php echo Produit::nb(); ?>)</span></a>
        </div>      
      </li>

            <li class="nav-item">
        <a class="nav-link" href="gestion_stock/entree.php">Entrée</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="gestion_stock/sortie.php">Sortie</a>
      </li>

            <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mouvement</a>
      
         
       <!--<a href='gestion_produits/afficher_produit.php?n=1'>-->

                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href='gestion_stock/consultation.php'>Consultation (<?php echo Mouvement::nb(); ?>)
        </a>
        </div>      
      </li>

            <!--<li class="nav-item">
        <a class="nav-link" href="gestion_stock"><span>Mouvement</span></a> 
      </li>-->

			</ul>
      
<!--<div id="login_info">
      		

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Compte
          	<span class="caret"></span></a>
          	<ul class="dropdown-menu">
            <li><span id="prenom" class="glyphicon glyphicon-user"> 

            <?php echo $_SESSION['prenom'] ?></span></li>
            <li role="separator" class="divider"></li>
            <a href='deconnexion.php' id="deconnexion" class="glyphicon glyphicon-off"> Déconnecter</a>
          </ul>
        </li>
      </ul>-->
          <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light">
         <?php echo $_SESSION['type'] ?>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
         <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" id="prenom" class="glyphicon glyphicon-user" href="#"><?php echo $_SESSION['prenom'] ?></a>
          <a class="dropdown-item" href="deconnexion.php" id="deconnexion" class="glyphicon glyphicon-off"> Déconnecter</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
   



<div class="contcustom">
  <div class="row ">
    <div class="col-4 col-sm-2 ">
      <ul class="nav flex-column green lighten-5 py-4">
  <li class="nav-item ">
  <a class="nav-link dark-grey-text" href="admin.php">Stockage</a>

  </li>

  <li class="nav-item">
  <a class="nav-link text-default" href="admin3.php">Intervention</a>
  </li>
  <li class="nav-item">
  <a class="nav-link text-default" href="gestion_materiels/afficher_materiel.php?n=1">Matériel</a>
  </li>
</ul>
    </div>
    <div class="col-12 col-sm-6 col-md-10 justify-content-center">
  <h2>Tableau de bord</h2>
   <h6>Statistique des entrées</h6>
  <div class="row">
  <canvas class="w-50 h-25" id="lineChart"></canvas>
  <canvas class="w-50 h-25" id="doughnutChart"></canvas>
   <h6 style="margin-left: 760px;margin-top: 20px">Résultat de l'état de stock</h6>
  </div>
  <div class="row">
 
  </div>
  <br/><br/>
  <h6>Statistique des sorties</h6>
  <canvas class="w-75 h-50" id="lineChart2"></canvas><h2>

    </div>
  </div>
</div>
<!--Navbar-->

          

	<!-- code php 
	<div id="login_info">
		<span id="nom"><?php echo $_SESSION['prenom'] ?></span>,
		<span id="prenom"><?php echo $_SESSION['nom'] ?></span>
		<span id="deconnexion"><a href='deconnexion.php'>Déconnecter</a></span>
	</div>
	<div id="main">
		<div id="header">
			<div id="logo">
				<div id="logo_text">
					<h1>
						<a href="#"><span class="logo_colour">gestion de stock</span></a>
					</h1>
				</div>
			</div>
			<?php require 'include/cssmenu_admin.php'; ?>
			<div id="site_content">
			<?php require_once 'include/side_bar.php'; ?>
				<div id="content">
					<h1>Présentation</h1>
					<p>application web - gestion de stock</p>
				</div>

				<a href="admin2.php"> Aller vers la gestion des matériels</a>
			</div>
		</div>
	</div>
	-->

  <script type="text/javascript" src="style/mdb4/js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="style/mdb4/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="style/mdb4/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="style/mdb4/js/mdb.min.js"></script>
    <?php 
/* Open connection to "zing_db" MySQL database. */
$mysqli = new mysqli("localhost", "root", "", "Adwya2");
 
/* Check the connection. */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
 
/* Fetch result set from t_test table */
$data=mysqli_query($mysqli,"SELECT id,type,date,count(*) AS nombre FROM mouvements  WHERE type = 'entree' GROUP BY date ");
?>
  <script>
var myData=[<?php 
while($info=mysqli_fetch_array($data))
    echo $info['nombre'].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];
<?php
$data=mysqli_query($mysqli,"SELECT id,type,date,count(*) AS nombre FROM mouvements  WHERE type = 'entree' GROUP BY date ");
?>
var myLabels=[<?php 
while($info=mysqli_fetch_array($data))
    echo '"'.$info['date'].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
?>];
</script>
  <script>
  //line 
  var ctxL = document.getElementById("lineChart").getContext('2d');
  var myLineChart = new Chart(ctxL, {
    type: 'line',
    data: {
      labels: myLabels,
      datasets: [{
          label: "Entrée",
          data: myData,
          backgroundColor: [
            'rgba(105, 0, 132, .2)',
          ],
          borderColor: [
            'rgba(200, 99, 132, .7)',
          ],
          borderWidth: 2
        },
      ]
    },
    options: {
      responsive: true
    }
  });

</script>  
    <?php 
 
/* Fetch result set from t_test table */
$data=mysqli_query($mysqli,"SELECT id,type,date,count(*) AS nombre FROM mouvements  WHERE type = 'sortie' GROUP BY date ");
?>
  <script>
var myData2=[<?php 
while($info=mysqli_fetch_array($data))
    echo $info['nombre'].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];
<?php
$data=mysqli_query($mysqli,"SELECT id,type,date,count(*) AS nombre FROM mouvements  WHERE type = 'sortie' GROUP BY date ");
?>
var myLabels2=[<?php 
while($info=mysqli_fetch_array($data))
    echo '"'.$info['date'].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
?>];
</script>

  <script>
  //line 
  var ctxL = document.getElementById("lineChart2").getContext('2d');
  var myLineChart = new Chart(ctxL, {
    type: 'line',
    data: {
      labels: myLabels2,
      datasets: [{
          label: "sortie",
          data: myData2,
          backgroundColor: [
            'rgba(0, 137, 132, .2)',
          ],
          borderColor: [
            'rgba(0, 10, 130, .7)',
          ],
          borderWidth: 2
        },
      ]
    },
    options: {
      responsive: true
    }
  });

</script>
    <?php 
 
/* Fetch result set from t_test table */
$data=mysqli_query($mysqli,"SELECT designation,quantite FROM produits");
?>
  <script>
var DataPro=[<?php 
while($info=mysqli_fetch_array($data))
    echo $info['quantite'].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];
<?php
$data=mysqli_query($mysqli,"SELECT designation,quantite FROM produits");
?>
var labPro=[<?php 
while($info=mysqli_fetch_array($data))
    echo '"'.$info['designation'].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
?>];
</script>
  <script>
  //doughnut
  var ctxD = document.getElementById("doughnutChart").getContext('2d');
  var myLineChart = new Chart(ctxD, {
    type: 'doughnut',
    data: {
      labels: labPro,
      datasets: [{
        data: DataPro,
        backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
      }]
    },
    options: {
      responsive: true
    }
  });

</script>
</body>
</html>



<?php
/* Close the connection */
$mysqli->close(); 
?>

</br> </br> </br>

  <!-- Footer -->
<footer class="page-footer font-small default-color">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
    <a href="https://mdbootstrap.com/education/bootstrap/"> Gestion de maintenance des matériels informatique</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->