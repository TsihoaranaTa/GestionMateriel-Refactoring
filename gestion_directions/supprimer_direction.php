<?php
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):	//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if(!Utilisateur::getUtilisateurConnecte()->estAdmin()):
		Application::alert('vous devez être administrateur pour consulter cette page');
		Application::redir('autre.php');
	endif;
	if(Direction::pasDelements()):	//test pour vérifier qu'il y a des directions car un article doit être associé à une direction
		Application::alert("aucune direction trouvé!");
		Application::redir('admin2.php');
	endif;
	if(isset($_GET['id'])):
		//test s'il ya un paramétre passé à cette page et si ce dernier est valide ou pas
		$cleId = intval($_GET['id']);
		if(is_int($cleId)):
			$direction = Direction::get($cleId);
			if(!Direction::existe($direction)):
				Application::alert("direction introuvable!");
				Application::redir('afficher_direction.php?n=1');
			else:
				//id valide
				Direction::supprimer($direction);
				Application::redir('afficher_direction.php?n=1');
			endif;
		else:
			Application::alert("la clé doit être numérique!");
			Application::redir('afficher_direction.php?n=1');
		endif;
	else:
		Application::alert("paramétre introuvable!");
		Application::redir('afficher_direction.php?n=1');
	endif;
?>