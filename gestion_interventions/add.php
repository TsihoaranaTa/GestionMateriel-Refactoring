<?php
	require_once '../include/include.php';
	$nom = $_POST['nom'];
	$idEtat = $_POST['id_etat'];
	$idMateriel = $_POST['id_materiel'];
	$ticket = $_POST['ticket'];
	$cout = $_POST['cout'];
	$temps = $_POST['temps'];
	$idDirection = $_POST['id_direction'];
	$idDepartement = $_POST['id_departement'];
	$idService = $_POST['id_service'];
	$idPersonnel = $_POST['id_personnel'];
	$intervenant = $_POST['intervenant'];
	//$quantite = $_POST['quantite'];
	
	$_SESSION['InterventionNom'] = $nom;
	$_SESSION['InterventionIdEtat'] = $idEtat;
	$_SESSION['InterventionIdMateriel'] = $idMateriel;
	$_SESSION['InterventionTicket'] = $ticket;
	$_SESSION['InterventionCout'] = $cout;
	$_SESSION['InterventionTemps'] = $temps;
	$_SESSION['InterventionIdDirection'] = $idDirection;
	$_SESSION['InterventionIdDepartement'] = $idDepartement;
	$_SESSION['InterventionIdService'] = $idService;
	$_SESSION['InterventionIdPersonnel'] = $idPersonnel;
	$_SESSION['InterventionIntervenant'] = $intervenant;
	//$_SESSION['GadgetQuantite'] = $quantite;
	
	$in = new Intervention($idEtat, $idMateriel, $nom, $ticket, $cout, $temps,$idDirection, $idDepartement,$idService, $idPersonnel, $intervenant);	

	if(!$in->estValide()) {
		$_SESSION['status'] = Application::$ERREUR_AJOUT;
			
	} 
	else {
		$_SESSION['status'] = Application::$SUCCES_AJOUT;
		Intervention::ajouter($in);
		$_SESSION['InterventionNom'] = '';
		$_SESSION['InterventionIdEtat'] = '';
		$_SESSION['InterventionIdMateriel'] = '';
		$_SESSION['InterventionTicket'] = '';
		$_SESSION['InterventionCout'] = '';
		$_SESSION['InterventionTemps'] = '';
		$_SESSION['InterventionIdDirection'] = '';
		$_SESSION['InterventionIdDepartement'] = '';
		$_SESSION['InterventionIdService'] = '';
		$_SESSION['InterventionIdPersonnel'] = '';
		$_SESSION['InterventionIntervenant'] = '';
	}
	$_SESSION['message'] = $in->getMessage();
	Application::redir('afficher_intervention.php?n=1');
	
	