<?php
if(!isset($_GET['id']) || empty($_GET['id'])) die('error!');
	$title = 'supprimerMouvement id = ' . $_GET['id'];
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):
		Application::redir('../login/');
	endif;
	if(!Utilisateur::getUtilisateurConnecte()->estAdmin()):
		Application::alert('vous devez être administrateur pour consulter cette page');
		Application::redir('autre.php');
	endif;
	//récupération du mouvement
	$m = Mouvement::get($_GET['id']);
	
	$typeMouvement = $m->getType();
	if($typeMouvement == 'entree') {
		$entree = Entree::get($m->getId());		
		$sommeEntree = Produit::getSommeEntree($entree->getIdProduit());
		$sommeSortie = Produit::getSommeSortie($entree->getIdProduit());
		$sommeEntree -= $entree->getQuantite();	//aprés suppression
		$valide = $sommeSortie <= $sommeEntree;
	} else {
		$valide = true;	//la suppression d'une livraison est toujours valide!
	}
	if($valide) {
		Mouvement::supprimer($m);
	} else {
		Application::alert('suppression invalide! la somme des livraisons doit être <= à la somme des receptions!');
	}
	Application::redir($_SERVER['HTTP_REFERER']);
?>