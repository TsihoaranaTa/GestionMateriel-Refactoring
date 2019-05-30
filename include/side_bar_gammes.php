<!--<div id="sidebar_container">
  <div class="sidebar">
    <div class="sidebar_top"></div>
    <div class="sidebar_item">
      <h3>Menu</h3>
      <ul>
        <li><a href="../admin2.php">Acceuil</a></li>
        <li><a href="index.php">gestion directions</a></li>
        <li><a href="ajouter_direction.php">ajouter direction</a></li>
        <li><a href="afficher_direction.php?n=1">afficher direction (<?php echo Direction::nb(); ?>)</a></li>
        <?php /* le paramétre passé pour demander la premiére page (le résultat est paginé) */ ?>
        <li><a href="rechercher_direction.php">rechercher direction</a><li/>

        <li><a href="../include/telecharger_liste.php?table=directions" target="_blank">télécharger liste</a></li>
      </ul>
    </div>
  </div>
</div>-->

<div id="sidebar_container">
      <ul class="nav flex-column blue lighten-5 py-4">
  <li class="nav-item ">
  <a class="nav-link text-primary" href="../index.php">Accueil</a>

  </li>

  <li class="nav-item">
     <a class="nav-link text-primary" href="ajouter_direction.php">ajouter direction</a>
  </li>
  <li class="nav-item">
<a class="nav-link text-primary" href="afficher_direction.php?n=1">afficher direction (<?php echo Direction::nb(); ?>)</a>
  </li>
    <li class="nav-item ">
  <a class="nav-link text-primary"  href="rechercher_direction.php">rechercher direction</a>
  </li>
    <li class="nav-item ">
  <a class="nav-link text-primary" href="../include/telecharger_liste.php?table=directions" target="_blank">télécharger liste</a></li>
  </li>
</ul> 
</div>