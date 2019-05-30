<?php
	require_once '../include/include.php';
	if(!Utilisateur::utilisateurConnecte()):	//si l'utilisateur n'est pas connecté, on le renvoie vers l'interface de connexion
		Application::redir('../login/');
	endif;
	if(!Utilisateur::getUtilisateurConnecte()->estAdmin()):
		Application::alert('vous devez être administrateur pour consulter cette page');
		Application::redir('autre.php');
	endif;
	if(Departement::pasDelements()):	//test pour vérifier qu'il y a des directions car un département doit être associé à une direction
		Application::alert("aucun département trouvé!");
		Application::redir('index.php');
	endif;
	if(isset($_GET['id'])):	//test s'il ya un paramétre passé à cette page et si ce dernier est valide ou pas
		$cleId = intval($_GET['id']);
		if(is_int($cleId)):
			$dep = Departement::get($cleId);
			if(!Departement::existe($dep)):
				Application::alert("département introuvable!");
				Application::redir('afficher_departement.php?n=1');
			else:
				//id valide
				Departement::supprimer($dep);
				Application::redir('afficher_departement.php?n=1');
			endif;
		else:
			Application::alert("la clé doit être numérique!");
			Application::redir('afficher_departement.php?n=1');
		endif;
	else:
		Application::alert("paramétre introuvable!");
		Application::redir('afficher_departement.php?n=1');
	endif;
?>