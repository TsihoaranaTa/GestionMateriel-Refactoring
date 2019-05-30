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
	
	$per = new Personnel($idDirection, $idDepartement,$idService, $nom);	
	if(!$per->estValide()) {
		$_SESSION['status'] = Application::$ERREUR_AJOUT;
	} else {
		$_SESSION['status'] = Application::$SUCCES_AJOUT;
		Personnel::ajouter($per);
		$_SESSION['PersonnelNom'] = '';
		$_SESSION['PersonnelIdDirection'] = '';
		$_SESSION['PersonnelIdDepartement'] = '';
		$_SESSION['PersonnelIdService'] = '';
	}
	$_SESSION['message'] = $per->getMessage();
	Application::redir('afficher_personnel.php?n=1');