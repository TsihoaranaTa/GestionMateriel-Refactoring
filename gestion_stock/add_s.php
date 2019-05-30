<?php
	require_once '../include/include.php';
    //Création d'un object Sortiee
    $dateSortie = $_POST['datefield'];
    $idProduit = $_POST['produit'];
    $quantite = $_POST['qte'];
    $bon = $_POST['bon'];

    $_SESSION['SortieDateSortie'] = $dateSortie;
    $_SESSION['SortieIdProduit'] = $idProduit;
    $_SESSION['SortieQuantite'] = $quantite;
    $_SESSION['SortieBon'] = $bon;

    $s = new Sortie($idProduit, $quantite, $dateSortie, $bon);
	if(!$s->estValide()) {
		$_SESSION['status'] = Application::$ERREUR_AJOUT;
    } else {
		$_SESSION['status'] = Application::$SUCCES_AJOUT;

		Sortie::ajouter($s);
    	$_SESSION['SortieDateSortie'] = '';
    	$_SESSION['SortieIdProduit'] = '';
    	$_SESSION['SortieQuantite'] = '';
        $_SESSION['SortieBon'] = '';
    }
	$_SESSION['message'] = $s->getMessage();

    Application::redir('afficher_sortie.php?n=1');
