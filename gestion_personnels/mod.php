<?php
	require_once '../include/include.php';
	$nom = $_POST['nom'];
	$idDirection = $_POST['id_direction'];
	$idDepartement = $_POST['id_departement'];
	$idService = $_POST['id_service'];
	
	$_SESSION['PersonnelNom'] = $nom;
	$_SESSION['PersonnelIdDirection'] = $idDirection;
	$_SESSION['PersonnelIdDepartement'] = $idDepartement;
	$_SESSION['PersonnelIdService'] = $idService;
	
	$per = new Personnel($idDirection, $idDepartement,$idService,$nom);
	$per->setId($_GET['id']);
	if(!$per->estValide()) {
		$_SESSION['status'] = Application::$ERREUR_MODIFICATION;
	} else {
		$_SESSION['status'] = Application::$SUCCES_MODIFICATION;
		Personnel::modifier($per);
		$_SESSION['PersonnelNom'] = '';
		$_SESSION['PersonnelIdDirection'] = '';
		$_SESSION['PersonnelIdDepartement'] = '';
		$_SESSION['PersonnelIdService'] = '';
		
	}
	$_SESSION['message'] = $per->getMessage();
	Application::redir('afficher_personnel.php?n=1');