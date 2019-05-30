<?php
	//menu horizental
	require_once 'include.php';
	$page_accueil = (Utilisateur::getUtilisateurConnecte()->estAdmin())? 'admin.php': 'autre.php';
?>
<div>
	<ul>
		<li><a href='<?php echo $page_accueil; ?>'><span>Accueil</span> </a></li>
	
		<li class='has-sub'><a href='gestion_produits/'><span>Produit</span> </a>
			<ul>
				<li><a href='gestion_produits/ajouter_produit.php'><span>Ajouter</span></a></li>
				<li><a href='gestion_produits/rechercher_produit.php'><span>Rechercher</span></a></li>
				<li class='last'><a
					href='gestion_produits/afficher_produit.php?n=1'><span>Afficher(<?php echo Produit::nb(); ?>)</span></a></li>
			</ul>
		</li>

		<li><a href='gestion_stock/entree.php'><span>Bon d'entrée</span>
				</a></li>

		<li><a href='gestion_stock/sortie.php'><span>Bon de sortie</span>
				</a></li>

		<li class='has-sub last'><a href='gestion_stock'><span>Etat de mouvement de stock</span>
		</a>
			<ul>
				<li class='last'><a href='consultation.php'><span>Consultation (<?php echo Mouvement::nb(); ?>)</span></a></li>
			</ul>
		</li>
	</ul>
</div>
