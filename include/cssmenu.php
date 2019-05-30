<?php
	//menu horizental
	require_once 'include.php';
	$user = Utilisateur::getUtilisateurConnecte();
	$page_accueil = ($user->estAdmin())? 'admin.php': 'autre.php';
?>



<nav class="mb-1 navbar fixed-top navbar-expand-lg navbar-dark default-color">

     <a class="navbar-brand" href='#'><strong>Accueil</strong></a>
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
          <a class="dropdown-item" href='../gestion_produits/ajouter_produit.php'>Ajouter produit</a>
          <a class="dropdown-item" href="../gestion_produits/rechercher_produit.php">Rechercher</a>
          <a class="dropdown-item" href="../gestion_produits/afficher_produit.php?n=1"><span>Afficher(<?php echo Produit::nb(); ?>)</span></a>
        </div>      
      </li>

            <li class="nav-item">
        <a class="nav-link" href="../gestion_stock/entree.php">Entrée</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../gestion_stock/sortie.php">Sortie</a>
      </li>

			<li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mouvement</a>
      
         
       <!--<a href='gestion_produits/afficher_produit.php?n=1'>-->

                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href='../gestion_stock/consultation.php'>Consultation (<?php echo Mouvement::nb(); ?>)
				</a>
        </div>      
      </li>
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
          <a class="dropdown-item" href="../deconnexion.php" id="deconnexion" class="glyphicon glyphicon-off"> Déconnecter</a>
        </div>
      </li>
    </ul>
  </div>
</nav>