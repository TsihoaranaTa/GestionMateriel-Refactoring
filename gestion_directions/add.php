<?php
	require_once '../include/include.php';
	$nom = $_POST['nom'];
	$nomCourt = $_POST['nom_court'];
	$_SESSION['DirectionNom'] = $nom;
	$_SESSION['DirectionNomCourt'] = $nomCourt;
	$d = new Direction($nom, $nomCourt);
	if(!$d->estValide()) {
		$_SESSION['status'] = Application::$ERREUR_AJOUT;
	} else {
		$_SESSION['status'] = Application::$SUCCES_AJOUT;
		Direction::ajouter($d);
		$_SESSION['DirectionNom'] = '';
		$_SESSION['DirectionNomCourt'] = '';
	}
	$_SESSION['message'] = $d->getMessage();
	//Application::redir($_SERVER['HTTP_REFERER']);
	Application::redir('afficher_direction.php?n=1');