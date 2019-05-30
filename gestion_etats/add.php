<?php
	require_once '../include/include.php';
	$nom = $_POST['nom'];
	$_SESSION['EtatNom'] = $nom;
	$et = new Etat($nom);
	if(!$et->estValide()) {
		$_SESSION['status'] = Application::$ERREUR_AJOUT;
	} else {
		$_SESSION['status'] = Application::$SUCCES_AJOUT;
		Etat::ajouter($et);
		$_SESSION['EtatNom'] = '';
	}
	$_SESSION['message'] = $et->getMessage();
	Application::redir($_SERVER['HTTP_REFERER']);