<?php
	require_once '../include/include.php';
	//Création d'un object Entree
    $dateEntree = $_POST['datefield'];
    $idProduit = $_POST['produit'];
    $quantite = $_POST['qte'];
	$_SESSION['EntreeDateEntree'] = $dateEntree;
	$_SESSION['EntreeIdProduit'] = $idProduit;
	$_SESSION['EntreeQuantite'] = $quantite;
	$e = new Entree($idProduit, $quantite, $dateEntree);
	if(!$e->estValide()) {
		$_SESSION['status'] = Application::$ERREUR_AJOUT;
	} else {
		$_SESSION['status'] = Application::$SUCCES_AJOUT;
		Entree::ajouter($e);
		$_SESSION['EntreeDateEntree'] = '';
		$_SESSION['EntreeIdProduit'] = '';
		$_SESSION['EntreeQuantite'] = '';
	}
	$_SESSION['message'] = $e->getMessage();
	Application::redir($_SERVER['HTTP_REFERER']);