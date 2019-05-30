<?php
	require_once '../include/include.php';
	$nom = $_POST['nom'];
	$_SESSION['EtatNom'] = $nom;
	$et = new Etat($nom);
	$et->setId($_GET['id']);
	if(!$et->estValide()) {
		$_SESSION['status'] = Application::$ERREUR_MODIFICATION;
	} else {
		$_SESSION['status'] = Application::$SUCCES_MODIFICATION;
		Etat::modifier($et);
		$_SESSION['EtatNom'] = '';
	}
	$_SESSION['message'] = $et->getMessage();
	Application::redir($_SERVER['HTTP_REFERER']);
	//Application::redir('afficher_gamme.php?n=1');