<?php
	require_once '../include/include.php';
	$designation = $_POST['designation'];
	//$quantite = $_POST['quantite'];
	$reference = $_POST['reference'];
	$_SESSION['ProduitDesignation'] = $designation;
	//$_SESSION['ProduitQuantite'] = $quantite;
	$_SESSION['ProduitReference'] = $designation;
	$p = new Produit($designation, $reference, 0);	//la quantité du produit est par défaut 0, et est modifiée a travers les mouvements
	if(!$p->estValide()) {
		$_SESSION['status'] = Application::$ERREUR_AJOUT;
	} else {
		$_SESSION['status'] = Application::$SUCCES_AJOUT;
		Produit::ajouter($p);
		$_SESSION['ProduitDesignation'] = '';
		$_SESSION['ProduitQuantite'] = '';
		$_SESSION['ProduitReference'] = '';
	}
	$_SESSION['message'] = $p->getMessage();
	Application::redir($_SERVER['HTTP_REFERER']);