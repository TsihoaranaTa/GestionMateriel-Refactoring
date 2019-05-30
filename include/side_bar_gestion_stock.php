<?php require_once 'include.php'; ?>
<div id="sidebar_container">
      <ul class="nav flex-column green lighten-5 py-4">
  <li class="nav-item ">
  <a class="nav-link text-default" href="../index.php">Accueil</a>

  </li>

  <li class="nav-item">
     <a class="nav-link text-default" href="afficher_sortie.php?n=1">Afficher liste des sorties</a>
  </li>
  <li class="nav-item">
<a class="nav-link text-default" href="consultation.php">consultation (<?php echo Mouvement::nb(); ?>)</a>
  </li>
</ul> 
</div>

				<!--<li><a href="reception.php">Bon d'entrée</a></li>
				<li><a href="livraison.php">Bon de sortie</a></li>-->