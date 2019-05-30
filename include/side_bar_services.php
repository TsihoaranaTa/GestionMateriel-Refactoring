<!--<div id="sidebar_container">
  <div class="sidebar">
    <div class="sidebar_top"></div>
    <div class="sidebar_item">
      <h3>Menu</h3>
      <ul>
        <li><a href="../index.php">Accueil</a></li>
        <li><a href="index.php">gestion services</a></li>
        <li><a href="ajouter_service.php">ajouter service</a></li>
        <li><a href="afficher_service.php?n=1">afficher service (<?php echo Service::nb(); ?>)</a></li>
        <?php /* le paramétre passé pour demander la premiére page (le résultat est paginé) */ ?>
        <li><a href="rechercher_service.php">rechercher service</a><li/>
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
     <a class="nav-link text-primary" href="ajouter_service.php">ajouter service</a>
  </li>
  <li class="nav-item">
<a class="nav-link text-primary" href="afficher_service.php?n=1">afficher service (<?php echo Service::nb(); ?>)</a>
  </li>
    <li class="nav-item ">
  <a class="nav-link text-primary" href="rechercher_service.php">rechercher service</a>

  </li>
</ul> 
</div>