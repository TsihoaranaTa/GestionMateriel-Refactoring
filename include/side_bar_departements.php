<!--<div id="sidebar_container">
	<div class="sidebar">
		<div class="sidebar_top"></div>
		<div class="sidebar_item">
			<h3>Menu</h3>
			<ul>
				<li><a href="../index.php">Accueil</a></li>
				<li><a href="../gestion_departements">gestion_departements</a></li>
				<li><a href="ajouter_departement.php">ajouter departement</a></li>
				<li><a href="afficher_departement.php?n=1">afficher departement (<?php echo Departement::nb(); ?>)</a></li>
				<li><a href="rechercher_departement.php">rechercher département</a></li>
				<li><a href="../include/telecharger_liste.php?table=departements" target="_blank">télécharger liste</a></li>
			</ul>
		</div>
		<div class="sidebar_base"></div>
	</div>
</div>-->



<div id="sidebar_container">
      <ul class="nav flex-column blue lighten-5 py-4">
  <li class="nav-item ">
  <a class="nav-link text-primary" href="../index.php">Accueil</a>

  </li>

  <li class="nav-item">
     <a class="nav-link text-primary" href="ajouter_departement.php">ajouter departement</a>
  </li>
  <li class="nav-item">
<a class="nav-link text-primary" href="afficher_departement.php?n=1">afficher departement (<?php echo Departement::nb(); ?>)</a>
  </li>
    <li class="nav-item ">
  <a class="nav-link text-primary"  href="rechercher_departement.php">rechercher département</a>

  </li>
    <li class="nav-item ">
  <a class="nav-link text-primary" href="../include/telecharger_liste.php?table=departements" target="_blank">télécharger liste</a></li>
  </li>
</ul> 
</div>