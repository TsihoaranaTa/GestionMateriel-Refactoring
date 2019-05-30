<?php
	//menu horizental
	require_once 'include.php';
	$page_accueil = (Utilisateur::getUtilisateurConnecte()->estAdmin())? 'admin2.php': 'autre.php';
?>


	<!--<nav class="navbar navbar-inverse" style="border-radius: 0px;">
  <div class="container-fluid">
     navbar et menu 
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="admin2.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Acceuil <span class="caret"></span></a>
          <ul class="dropdown-menu">
          	<li><a href="#">Matériel</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="admin.php">Stockage</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="admin3.php">Intervention</a></li>
          </ul>
        </li>


 		<li class="dropdown">
 			direct atao "afficher matériels" fa tsy dropdown quand l'interface sera fini
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Direction <span class="caret"></span></a>
          <ul class="dropdown-menu">

            <li><a href='../ajouter_direction.php'>Ajouter</a></li>
            <li role="separator" class="divider"></li>
            <li><a href='../rechercher_direction.php'>Rechercher</a></li>
            <li role="separator" class="divider" class='last'><a href='../afficher_direction.php?n=1'></li>
            <li><a href='../afficher_direction.php?n=1'<span>Afficher(<?php echo Direction::nb(); ?>)</span></a></li>
          </ul>
         </a>
     </li>

          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Département <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href='gestion_departements/ajouter_departement.php'>Ajouter</a></li>
            <li role="separator" class="divider"></li>
            <li><a href='gestion_departements/rechercher_departement.php'>Rechercher</a></li>
            <li role="separator" class="divider" class='last'><a href='gestion_departements/afficher_departement.php?n=1'></li>
            <li><a href='gestion_departements/afficher_departement.php?n=1'<span>Afficher(<?php echo Departement::nb(); ?>)</span></a></li>
          </ul>


           <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Service <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href='gestion_services/ajouter_service.php'>Ajouter</a></li>
            <li role="separator" class="divider"></li>
            <li><a href='gestion_services/rechercher_service.php'>Rechercher</a></li>
            <li role="separator" class="divider" class='last'><a href='gestion_services/afficher_service.php?n=1'></li>
            <li><a href='gestion_services/afficher_service.php?n=1'<span>Afficher(<?php echo Service::nb(); ?>)</span></a></li>
          </ul>

           <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Personnel <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href='gestion_personnels/ajouter_personnel.php'>Ajouter</a></li>
            <li role="separator" class="divider"></li>
            <li><a href='gestion_personnels/rechercher_personnel.php'>Rechercher</a></li>
            <li role="separator" class="divider" class='last'><a href='gestion_personnels/afficher_personnel.php?n=1'></li>
            <li><a href='gestion_personnels/afficher_personnel.php?n=1'<span>Afficher(<?php echo Personnel::nb(); ?>)</span></a></li>
          </ul>

          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Matériel <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href='gestion_materiels/ajouter_materiel.php'>Ajouter</a></li>
            <li role="separator" class="divider"></li>
            <li><a href='gestion_personnels/rechercher_personnel.php'>Rechercher</a></li>
            <li role="separator" class="divider" class='last'><a href='gestion_personnels/afficher_personnel.php?n=1'></li>
            <li><a href='gestion_personnels/afficher_personnel.php?n=1'<span>Afficher(<?php echo Personnel::nb(); ?>)</span></a></li>
          </ul>

			</ul>
        </li>
      </ul>
      navbar gauche recherche
      <form class="navbar-form navbar-left">
	    <div class="form-group has-success">
        <div class="form-group">
          <input type="text" value=" " class="form-control" />
        </div>
        <button type="submit" class="btn btn-default">Recherche</button>
         </div>
      </form>

       navbar gauche recherche
<div id="login_info">
      		
      <ul class="nav navbar-nav navbar-right">
      		 <li><a href="#" id="type"><?php echo $_SESSION['type'] ?></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Compte
          	<span class="caret"></span></a>
          	<ul class="dropdown-menu">
            <li><span id="prenom" class="glyphicon glyphicon-user"> <?php echo $_SESSION['prenom'] ?></span></li>
            <li role="separator" class="divider"></li>
            <a href='deconnexion.php' id="deconnexion" class="glyphicon glyphicon-off"> Déconnecter</a>
          </ul>
        </li>
      </ul>
      </div>
    </div>
  </div>
</nav>-->















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
          <a class="dropdown-item" href='../gestion_directions/ajouter_direction.php'>Ajouter</a>
          <a class="dropdown-item" href='../gestion_directions/rechercher_direction.php'>Rechercher</a>
          <a class="dropdown-item" href='../gestion_directions/afficher_direction.php?n=1'><span>Afficher(<?php echo Direction::nb(); ?>)</span></a>
        </div>      
      </li>

      <!-- direct atao "afficher matériels" fa tsy dropdown quand l'interface sera fini-->

    <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Département </a>
      
         
       <!--<a href='gestion_directions/afficher_direction.php?n=1'></li>-->

                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href='../gestion_departements/ajouter_departement.php'>Ajouter</a>
          <a class="dropdown-item" href='../gestion_departements/rechercher_departement.php'>Rechercher</a>
          <a class="dropdown-item" href='../gestion_departements/afficher_departement.php?n=1'><span>Afficher(<?php echo Departement::nb(); ?>)</span></a>
        </div>      
      </li>
    <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Service</a>
      
         
       <!--<a href='gestion_directions/afficher_direction.php?n=1'></li>-->

                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href='../gestion_services/ajouter_service.php'>Ajouter</a>
          <a class="dropdown-item" href='../gestion_services/rechercher_service.php'>Rechercher</a>
          <a class="dropdown-item" href='../gestion_services/afficher_service.php?n=1'><span>Afficher(<?php echo Service::nb(); ?>)</span></a>
        </div>      
      </li>

    <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Personnel</a>
      
         
       <!--<a href='gestion_directions/afficher_direction.php?n=1'></li>-->

                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href='../gestion_personnels/ajouter_personnel.php'>Ajouter</a>
          <a class="dropdown-item" href='../gestion_personnels/rechercher_personnel.php'>Rechercher</a>
          <a class="dropdown-item" href='../gestion_personnels/afficher_personnel.php?n=1'><span>Afficher(<?php echo Personnel::nb(); ?>)</span></a>
        </div>      
      </li>

          <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Matériel</a>
      
         
       <!--<a href='gestion_directions/afficher_direction.php?n=1'></li>-->

                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href='../gestion_materiels/ajouter_materiel.php'>Ajouter</a>
          <a class="dropdown-item" href='../gestion_materiels/rechercher_materiel.php'>Rechercher</a>
          <a class="dropdown-item" href='../gestion_materiels/afficher_materiel.php?n=1'><span>Afficher(<?php echo Personnel::nb(); ?>)</span></a>
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
         <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" id="prenom" class="glyphicon glyphicon-user" href="#"><?php echo $_SESSION['prenom'] ?></a>
          <a class="dropdown-item" href="../deconnexion.php" id="deconnexion" class="glyphicon glyphicon-off"> Déconnecter</a>
        </div>
      </li>
    </ul>
  </div>
</nav>


