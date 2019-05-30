<?php
	require_once '../include/include.php';
	$nom = $_POST['nom'];
	$idDirection = $_POST['id_direction'];
	$idDepartement = $_POST['id_departement'];
	
	$_SESSION['ServiceNom'] = $nom;
	$_SESSION['ServiceIdDirection'] = $idDirection;
	$_SESSION['ServiceIdDepartement'] = $idDepartement;
	
	$ser = new Service($idDirection, $idDepartement, $nom);	
	$ser->setId($_GET['id']);
	if(!$ser->estValide()) {
		$_SESSION['status'] = Application::$ERREUR_MODIFICATION;
	} else {
		$_SESSION['status'] = Application::$SUCCES_MODIFICATION;
		Service::modifier($ser);
		$_SESSION['ServiceNom'] = '';
		$_SESSION['ServiceIdDirection'] = '';
		$_SESSION['ServiceIdDepartement'] = '';
		
	}
	$_SESSION['message'] = $ser->getMessage();
	Application::redir('afficher_service.php?n=1');