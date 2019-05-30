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
<nav class="mb-1 navbar fixed-top navbar-expand-lg navbar-dark primary-color">

     <a class="navbar-brand" href="#"><strong>Accueil</strong></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

     <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">


    <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Direction</a>
      
         
       <!--<a href='gestion_directions/afficher_direction.php?n=1'></li>-->

                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href='gestion_directions/ajouter_direction.php'>Ajouter</a>
          <a class="dropdown-item" href='gestion_directions/rechercher_direction.php'>Rechercher</a>
          <a class="dropdown-item" href='gestion_directions/afficher_direction.php?n=1'><span>Afficher(<?php echo Direction::nb(); ?>)</span></a>
        </div>      
      </li>

 			<!-- direct atao "afficher matériels" fa tsy dropdown quand l'interface sera fini-->

    <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Département </a>
      
         
       <!--<a href='gestion_directions/afficher_direction.php?n=1'></li>-->

                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href='gestion_departements/ajouter_departement.php'>Ajouter</a>
          <a class="dropdown-item" href='gestion_departements/rechercher_departement.php'>Rechercher</a>
          <a class="dropdown-item" href='gestion_departements/afficher_departement.php?n=1'><span>Afficher(<?php echo Departement::nb(); ?>)</span></a>
        </div>      
      </li>
    <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Service</a>
      
         
       <!--<a href='gestion_directions/afficher_direction.php?n=1'></li>-->

                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href='gestion_services/ajouter_service.php'>Ajouter</a>
          <a class="dropdown-item" href='gestion_services/rechercher_service.php'>Rechercher</a>
          <a class="dropdown-item" href='gestion_services/afficher_service.php?n=1'><span>Afficher(<?php echo Service::nb(); ?>)</span></a>
        </div>      
      </li>

    <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Personnel</a>
      
         
       <!--<a href='gestion_directions/afficher_direction.php?n=1'></li>-->

                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href='gestion_personnels/ajouter_personnel.php'>Ajouter</a>
          <a class="dropdown-item" href='gestion_personnels/rechercher_personnel.php'>Rechercher</a>
          <a class="dropdown-item" href='gestion_personnels/afficher_personnel.php?n=1'><span>Afficher(<?php echo Personnel::nb(); ?>)</span></a>
        </div>      
      </li>

          <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Matériel</a>
      
         
       <!--<a href='gestion_directions/afficher_direction.php?n=1'></li>-->

                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href='gestion_materiels/ajouter_materiel.php'>Ajouter</a>
          <a class="dropdown-item" href='gestion_materiels/rechercher_materiel.php'>Rechercher</a>
          <a class="dropdown-item" href='gestion_materiels/afficher_materiel.php?n=1'><span>Afficher(<?php echo Personnel::nb(); ?>)</span></a>
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
      <ul class="nav flex-column blue lighten-5 py-4">
  <li class="nav-item ">
  <a class="nav-link text-primary" href="admin.php">Stockage</a>

  </li>

  <li class="nav-item">
  <a class="nav-link text-primary" href="admin3.php">Intervention</a>
  </li>
  <li class="nav-item">
  <a class="nav-link dark-grey-text" href="gestion_materiels/afficher_materiel.php?n=1">Matériel</a>
  </li>
</ul>
    </div>
    <div class="col-12 col-sm-6 col-md-8">
    <h1>Gestion des matériels informatique</h1>
  <h2>Bienvenue!</h2>
    </div>
  </div>
</div>
	<!-- Titre de la page -->

  <script type="text/javascript" src="style/mdb4/js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="style/mdb4/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="style/mdb4/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="style/mdb4/js/mdb.min.js"></script>
</body>
</html>

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