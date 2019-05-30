<?php
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):	//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if(!Utilisateur::getUtilisateurConnecte()->estAdmin()):
		Application::alert('vous devez être administrateur pour consulter cette page');
		Application::redir('autre.php');
	endif;
	if(Etat::pasDelements()):	//test pour vérifier qu'il y a des gammes car un article doit être associé à une gamme
		Application::alert("aucun statu trouvé!");
		Application::redir('index.php');
	endif;
	if(isset($_GET['id'])):
		//test s'il ya un paramétre passé à cette page et si ce dernier est valide ou pas
		$cleId = intval($_GET['id']);
		if(is_int($cleId)):
			$etat = Etat::get($cleId);
			if(!Etat::existe($etat)):
				Application::alert("statu introuvable!");
				Application::redir('afficher_etat.php?n=1');
			else:
				//id valide
				Etat::supprimer($etat);
				Application::redir('afficher_etat.php?n=1');
			endif;
		else:
			Application::alert("la clé doit être numérique!");
			Application::redir('afficher_etat.php?n=1');
		endif;
	else:
		Application::alert("paramétre introuvable!");
		Application::redir('afficher_etat.php?n=1');
	endif;
?>