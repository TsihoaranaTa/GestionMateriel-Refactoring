<?php
	//menu horizental
	require_once 'include.php';
	$user = Utilisateur::getUtilisateurConnecte();
	$page_accueil = ($user->estAdmin())? 'admin2.php': 'autre.php';
?>
<div id='cssmenu'>
	<ul>
		 <li><a href='../<?php echo $page_accueil; ?>'><span>Accueil</span> </a>
		</li> 
		<li class='has-sub'><a href='../gestion_directions/'><span>Direction</span> </a>
			<ul>
				<li><a href='../ajouter_direction.php'><span>Ajouter</span>
				</a></li>
				<li><a href='../gestion_directions/rechercher_direction.php'><span>Rechercher</span>
				</a></li>
				<li class='last'><a href='../gestion_directions/afficher_direction.php?n=1'><span>Afficher
							(<?php echo Direction::nb(); ?>)</span> </a></li>
			</ul>
		</li>
		<li class='has-sub'><a href='../gestion_departements/'><span>Département</span>
		</a>
			<ul>
				<li><a href='../gestion_departements/ajouter_departement.php'><span>Ajouter</span>
				</a></li>
				<li><a href='../gestion_departements/rechercher_departement.php'><span>Rechercher</span>
				</a></li>
				<li class='last'><a href='../gestion_departements/afficher_departement.php?n=1'><span>Afficher
							(<?php echo Departement::nb(); ?>)</span> </a></li>
			</ul>
		</li>

		<li class='has-sub'><a href='../gestion_personnels/'><span>Personnel</span>
		</a>
			<ul>
				<li><a href='../gestion_personnels/ajouter_personnel.php'><span>Ajouter</span>
				</a></li>
				<li><a href='../gestion_personnels/rechercher_personnel.php'><span>Rechercher</span>
				</a></li>
				<li class='last'><a
					href='../gestion_personnels/afficher_personnel.php?n=1'><span>Afficher (<?php echo Personnel::nb(); ?>)</span>
				</a></li>
			</ul>
		</li>

		<li class='has-sub'><a href='../gestion_materiels/'><span>Matériels</span>
		</a>
			<ul>
				<li><a href='../gestion_materiels/ajouter_gadget.php'><span>Ajouter</span>
				</a></li>
				<li><a href='../gestion_materiels/rechercher_gadget.php'><span>Rechercher</span>
				</a></li>
				<li class='last'><a
					href='../gestion_materiels/afficher_gadget.php?n=1'><span>Afficher (<?php echo Materiel::nb(); ?>)</span>
				</a></li>
			</ul>
		</li>
	</ul>
</div>
