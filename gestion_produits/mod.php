<?php
	require_once '../include/include.php';
	$designation = $_POST['designation'];
	//$quantite = $_POST['quantite'];
	$reference = $_POST['reference'];
	$_SESSION['ProduitDesignation'] = $designation;
	//$_SESSION['GadgetQuantite'] = $quantite;
	$_SESSION['ProduitReference'] = $reference;
	$p = new Produit($designation, $reference, Produit::get($_GET['id'])->getQuantite());	//ancienne quantité
	$p->setId($_GET['id']);
	if(!$p->estValide()) {
		$_SESSION['status'] = Application::$ERREUR_MODIFICATION;
	} else {
		$_SESSION['status'] = Application::$SUCCES_MODIFICATION;
		Produit::modifier($p);
		$_SESSION['ProduitDesignation'] = '';
		//$_SESSION['GadgetQuantite'] = '';
		$_SESSION['ProduitReference'] = '';
	}
	$_SESSION['message'] = $p->getMessage();
	Application::redir($_SERVER['HTTP_REFERER']);
	//Application::redir('afficher_gamme.php?n=1');