<?php
	require_once '../include/include.php';
	$nom = $_POST['nom'];
	$nomCourt = $_POST['nom_court'];
	$_SESSION['	DirectionNom'] = $nom;
	$_SESSION['DirectionNomCourt'] = $nomCourt;
	$d = new Direction($nom, $nomCourt);
	$d->setId($_GET['id']);
	if(!$d->estValide()) {
		$_SESSION['status'] = Application::$ERREUR_MODIFICATION;
	} else {
		$_SESSION['status'] = Application::$SUCCES_MODIFICATION;
		Direction::modifier($d);
		$_SESSION['DirectionNom'] = '';
		$_SESSION['DirectionNomCourt'] = '';
	}
	
	//Application::redir($_SERVER['HTTP_REFERER']);
	Application::redir('afficher_direction.php?n=1');