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
    <script src="main.js"></script>
</head>
<body>
 <nav class="mb-1 navbar fixed-top navbar-expand-lg navbar-dark secondary-color">

     <a class="navbar-brand" href="admin3.php"><strong>Accueil</strong></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

     <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">


    <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Statut</a>
      
         
       <!--<a href='gestion_produits/afficher_produit.php?n=1'>-->

                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href='gestion_etats/ajouter_etat.php'>Ajouter</a>
          <a class="dropdown-item" href='gestion_etats/rechercher_etat.php'>Rechercher</a>
          <a class="dropdown-item" href='gestion_etats/afficher_etat.php?n=1'><span>Afficher(<?php echo Etat::nb(); ?>)</span></a>
        </div>      
      </li>
          <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Intervention</a>
      
         
       <!--<a href='gestion_produits/afficher_produit.php?n=1'>-->

                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href='gestion_interventions/ajouter_intervention.php'>Ajouter</a>
          <a class="dropdown-item" href='gestion_interventions/rechercher_intervention.php'>Rechercher</a>
          <a class="dropdown-item" href='gestion_interventions/afficher_intervention.php?n=1'><span>Afficher(<?php echo Intervention::nb(); ?>)</span></a>
        </div>      
      </li>

      </ul>
 
          <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light">
         <?php echo $_SESSION['type'] ?>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
         compte
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
    <div class="col-4 col-sm-2">
      <ul class="nav flex-column purple lighten-5 py-4">
  <li class="nav-item ">
  <a class="nav-link text-secondary" href="admin.php">Stockage</a>

  </li>

  <li class="nav-item">
  <a class="nav-link dark-grey-text" href="#">Intervention</a>
  </li>
  <li class="nav-item">
  <a class="nav-link text-secondary" href="gestion_materiels/afficher_materiel.php?n=1">Matériel</a>
  </li>
</ul>
    </div>
    <div class="col-12 col-sm-6 col-md-8">
          <h1>Gestion des interventions</h1>
  <h6>Statistique des matériels en panne</h6>
  <canvas id="lineChart"></canvas>
    </div>
  </div>
</div>
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
$data=mysqli_query($mysqli,"SELECT id,id_etat,temps,count(*) AS nombre FROM interventions  WHERE id_etat = 1 GROUP BY temps ");
?>
  <script>
var myData=[<?php 
while($info=mysqli_fetch_array($data))
    echo $info['nombre'].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];
<?php
$data=mysqli_query($mysqli,"SELECT id,id_etat,temps,count(*) AS nombre FROM interventions  WHERE id_etat = 1 GROUP BY temps ");
?>
var myLabels=[<?php 
while($info=mysqli_fetch_array($data))
    echo '"'.$info['temps'].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
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
          label: "Machine en panne",
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

</body>
</html>



<?php
/* Close the connection */
$mysqli->close(); 
?>
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
						<a href="#"><span class="logo_colour">gestion des interventions</span></a>
					</h1>
				</div>
			</div>
			<?php /*require 'include/cssmenu_admin3.php'*/; ?>
			<div id="site_content">
			<?php /*require_once 'include/side_bar3.php'*/; ?>
				<div id="content">
					<h1>Présentation</h1>
					<p>application web - gestion des interventions</p>
				</div>
			</div>
		</div>
	</div> 
-->

<!-- Footer -->

 <footer class="page-footer font-small secondary-color" style="position: fixed;width: 100%">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2018 Copyright:
    <a href="https://mdbootstrap.com/education/bootstrap/"> Gestion de maintenance des matériels informatiques</a>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->