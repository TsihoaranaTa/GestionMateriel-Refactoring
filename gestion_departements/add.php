<?php
	require_once '../include/include.php';
	$nom = $_POST['nom'];
	$idDirection = $_POST['id_direction'];
	$_SESSION['DepartementNom'] = $nom;
	$_SESSION['DepartementIdDirection'] = $idDirection;
	$dep = new Departement($idDirection, $nom);
	if(!$dep->estValide()) {
		$_SESSION['status'] = Application::$ERREUR_AJOUT;
	} else {
		$_SESSION['status'] = Application::$SUCCES_AJOUT;
		Departement::ajouter($dep);
		$_SESSION['DepartementNom'] = '';
		$_SESSION['DepartementIdDirection'] = '';
	}
	Application::redir('afficher_departement.php?n=1');