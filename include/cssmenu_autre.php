<?php
	//menu horizental
	require_once 'include.php';
	$page_accueil = (Utilisateur::getUtilisateurConnecte()->estAdmin())? 'admin3.php': 'autre.php';
?>

<!--<div
	<ul>

	<li><a href='<?php echo $page_accueil; ?>'><span>Accueil</span> </a></li>
		<li class='has-sub'><a href='gestion_etats/'><span>Status</span> </a>
			<ul>
				<li><a href='../Application/gestion_etats/ajouter_etat.php'><span>Ajouter</span>
				</a></li>
				<li><a href='../gestion_etats/rechercher_etat.php'><span>Rechercher</span>
				</a></li>
				<li class='last'><a href='../gestion_etats/afficher_etat.php?n=1'><span>Afficher (<?php echo Etat::nb(); ?>)</span> </a></li>
			</ul>
		</li>
		<li class='has-sub'><a href='gestion_interventions/'><span>Intervention</span>
		</a>
			<ul>
				<li><a href='../Application/gestion_interventions/ajouter_intervention.php'><span>Ajouter</span>
				</a></li>
				<li><a href='../Application/gestion_interventions/recherher_intervention.php'><span>Rechercher</span>
				</a></li>
				<li class='last'><a
					href='../gestion_interventions/afficher_intervention.php'><span>Afficher</span> </a></li>
			</ul>
		</li>
			</ul>
		</li>
	</ul>
</div>-->
//stop here



 <nav class="mb-1 navbar fixed-top navbar-expand-lg navbar-dark secondary-color">

     <a class="navbar-brand" href="#"><strong>Accueil</strong></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

     <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">


    <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Status</a>


       <!--<a href='gestion_produits/afficher_produit.php?n=1'>-->

                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href='../Application/gestion_etats/ajouter_etat.php'>Ajouter</a>
          <a class="dropdown-item" href='../Application/gestion_etats/rechercher_etat.php'>Rechercher</a>
          <a class="dropdown-item" href='../Application/gestion_etats/afficher_etat.php?n=1'><span>Afficher (<?php echo Etat::nb(); ?>)</span> </a>
        </div>
      </li>
          <li class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Intervention</a>


       <!--<a href='gestion_produits/afficher_produit.php?n=1'>-->

                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
          <a class="dropdown-item" href='../Application/gestion_interventions/ajouter_intervention.php'>Ajouter</a>
          <a class="dropdown-item" href='../Application/gestion_interventions/recherher_intervention.php'>Rechercher</a>
          <a class="dropdown-item" href='../Application/gestion_interventions/afficher_intervention.php?n=1'><span>Afficher(<?php echo Intervention::nb(); ?>)</span> </a>
        </div>
      </li>

      </ul>

          <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item">
        <a class="nav-link waves-effect waves-light">
         <?php echo $_SESSION['type'] ?>
        </a>
      </li>
            <li class="nav-item">
        <a class="nav-link waves-effect waves-light">
         <span id="nom"><?php echo $_SESSION['prenom'] ?></span>
        </a>
      </li>
            <li class="nav-item">
        <a class="nav-link waves-effect waves-light">
         <span id="prenom"><?php echo $_SESSION['nom'] ?></span>
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
