<?php
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):	//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if(!Utilisateur::getUtilisateurConnecte()->estAdmin()):
		Application::alert('vous devez être administrateur pour consulter cette page');
		Application::redir('autre.php');
	endif;
	if(Sortie::pasDelements()):
		//test pour vérifier qu'il y a des gammes car un article doit être associé à une gamme
		Application::alert("aucune livraison trouvé!");
		Application::redir('index.php');
	endif;
	if(isset($_GET['id'])):
		//test s'il ya un paramétre passé à cette page et si ce dernier est valide ou pas
		$cleId = intval($_GET['id']);
		if(is_int($cleId)):
			$s = Sortie::get($cleId);
			if(!Sortie::existe($s)):
				Application::alert("sortie introuvable!");
				Application::redir('afficher_sortie.php?n=1');
			else:
				//id valide
				Sortie::supprimer($s);
				Application::redir('afficher_sortie.php?n=1');
			endif;
		else:
			Application::alert("la clé doit être numérique!");
			Application::redir('afficher_sortie.php?n=1');
		endif;
	else:
		Application::alert("paramétre introuvable!");
		Application::redir('afficher_sortie.php?n=1');
	endif;
?>