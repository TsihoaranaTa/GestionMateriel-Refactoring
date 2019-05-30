<?php
	require_once 'include.php';
	$user = Utilisateur::getUtilisateurConnecte();
	$page_accueil = ($user->estAdmin())? 'admin3.php': 'autre.php';
?>
<div id="sidebar_container">
	<div class="sidebar">
		<div class="sidebar_top"></div>
		<div class="sidebar_item">
			<h3>Menu</h3>
			<ul>
				<li><a href="<?php echo $page_accueil; ?>">Accueil</a></li>
				<li><a href="gestion_etats/">Gestion des status</a></li>
				<li><a href="gestion_interventions/">Gestion des interventions</a></li>
				<li><a href="deconnexion.php">Déconnecter</a></li>
			</ul>
		</div>
		<div class="sidebar_base"></div>
	</div>
</div>