<?php
	require_once '../include/include.php';
	$type = $_POST['type'];
	$idDepartement = $_POST['id_departement'];
	$idDirection = $_POST['id_direction'];
	$reference = $_POST['reference'];
	$date = $_POST['date'];
	$idService = $_POST['id_service'];
	$idPersonnel = $_POST['id_personnel'];

	$_SESSION['MaterielType'] = $type;
	$_SESSION['MaterielIdDepartement'] = $idDepartement;
	$_SESSION['MaterielIdDirection'] = $idDirection;
	$_SESSION['MaterielReference'] = $reference;
	$_SESSION['MaterielDate'] = $date;
	$_SESSION['MaterielIdService'] = $idService;
	$_SESSION['MaterielIdPersonnel'] = $idPersonnel;

	$mat = new Materiel($idDepartement, $idDirection, $type, $reference,$date,$idService, $idPersonnel);
	$mat->setId($_GET['id']);
	if(!$mat->estValide()) {
		$_SESSION['status'] = Application::$ERREUR_MODIFICATION;
	} else {
		$_SESSION['status'] = Application::$SUCCES_MODIFICATION;
		Materiel::modifier($mat);
		$_SESSION['MaterielType'] = '';
		$_SESSION['MaterielIdDepartement'] = '';
		$_SESSION['MaterielIdDirection'] = '';
		$_SESSION['MaterielReference'] = '';
		$_SESSION['MaterielDate'] = '';
		$_SESSION['MaterielIdService'] = '';
		$_SESSION['MaterielIdPersonnel'] = '';
	}
	$_SESSION['message'] = $mat->getMessage();
	Application::redir('afficher_materiel.php?n=1');