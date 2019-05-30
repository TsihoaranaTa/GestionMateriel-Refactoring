<!--<div id="sidebar_container">
	<div class="sidebar">
		<div class="sidebar_top"></div>
		<div class="sidebar_item">
			<h3>Menu</h3>
			<ul>
				<li><a href="../index.php">Accueil</a></li>
				<li><a href="index.php">gestion_materiels</a></li>
				<li><a href="ajouter_materiel.php">ajouter materiel</a></li>
				<li><a href="afficher_materiel.php?n=1">afficher materiel (<?php echo Materiel::nb(); ?>)</a></li>
				<li><a href="rechercher_materiel.php">rechercher materiel</a></li>
				
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
     <a class="nav-link text-primary" href="ajouter_materiel.php">ajouter materiel</a>
  </li>
  <li class="nav-item">
<a class="nav-link text-primary" href="afficher_materiel.php?n=1">afficher materiel (<?php echo Materiel::nb(); ?>)</a>
  </li>
    <li class="nav-item ">
  <a class="nav-link text-primary" href="rechercher_materiel.php">rechercher materiel</a>

  </li>
</ul> 
</div>