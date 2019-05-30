<?php
	require_once '../include/include.php';
	$designation = $_POST['designation'];
	$reference = $_POST['reference'];
	$_SESSION['ProduitDesignation'] = $designation;
	$_SESSION['ProduitReference'] = $designation;

	//la quantité du produit est par défaut 0, et est modifiée a travers les mouvements
	$p = new Produit($designation, $reference, 0);
	if(!$p->estValide())
	{
		$_SESSION['status'] = Application::$ERREUR_AJOUT;
	} else
	{
		$_SESSION['status'] = Application::$SUCCES_AJOUT;

		//ajouter le produit dans la base de données
		Produit::ajouter($p);
		$_SESSION['ProduitDesignation'] = '';
		$_SESSION['ProduitQuantite'] = '';
		$_SESSION['ProduitReference'] = '';
	}
	$_SESSION['message'] = $p->getMessage();
	Application::redir($_SERVER['HTTP_REFERER']);
