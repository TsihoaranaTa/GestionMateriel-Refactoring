<?php
	require_once '../include/include.php';
	$mouvement = Mouvement::get($_GET['id']);
	if($mouvement->getType() == 'sortie') {
	    $dateSortie = $_POST['datefield'];
	    $idProduit = $_POST['produit'];
	    $quantite = $_POST['qte'];
	    $s = new Sortie($idProduit, $quantite, $dateSortie);
	    $s->setId($mouvement->getId());
	    
	    //ancienne valeur de la quantité en stock du produit
	    $ancienneSortie = Sortie::get($mouvement->getId());
	    $p = Produit::get($ancienneSortie->getIdProduit());
	    $qteStockProduit = $p->getQuantite() + $ancienneSortie->getQuantite();
	    $valide = $s->getQuantite() <= $qteStockProduit;	//valide si la nouvelle qte à livrer est <= qteStockRéel du produit
	    
		if(!$valide) {
			$_SESSION['status'] = Application::$ERREUR_AJOUT;
	    } else {
			$_SESSION['status'] = Application::$SUCCES_AJOUT;
			//mise a jour de la quantité en stock
			$p->setQuantite($qteStockProduit);	//réinitialisation de la qte du produit
			Produit::modifier($p);	//la quantité du produit est comme si on n'a pas fait de sortie
			Sortie::modifier($s);
	    }
		$_SESSION['message'] = $s->getMessage();
		Application::redir($_SERVER['HTTP_REFERER']);
	} else {
	    $dateEntree = $_POST['datefield'];
	    $idProduit = $_POST['produit'];
	    $quantite = $_POST['qte'];
		$e = new Entree($idProduit, $quantite, $dateEntree);
		$e->setId($mouvement->getId());
		
		//ancienne valeur de la quantité en stock du produit
	    $ancienneEntree = Entree::get($mouvement->getId());
	    $p = Produit::get($ancienneEntree->getIdProduit());
	    $qteStockProduit = $p->getQuantite() - $ancienneEntree->getQuantite();
	    
	    $sommeEntree = Produit::getSommeEntree($p->getId());
	    $sommeSortie = Produit::getSommeSortie($p->getId());
	    
	    $sommeEntree = $sommeEntree - $ancienneEntree->getQuantite() + $quantite;
	    
	    $valide = $sommeEntree >= $sommeSortie;	//la reception est valide si la somme des receptions est >= la somme des livraisons
	    
		if(!$valide) {
			$_SESSION['status'] = Application::$ERREUR_AJOUT;
			$_SESSION['message'] = $e->getMessage() . 'Remarque: il faut que la somme des receptions du produit soit >= a la somme des livraisons!';
		} else {
			$_SESSION['status'] = Application::$SUCCES_AJOUT;
			//mise a jour de la quantité en stock
			$p->setQuantite($qteStockProduit);
			Produit::modifier($p);	//la quantité du produit est comme si on n'a pas fait de livraison
			Entree::modifier($e);
			$_SESSION['message'] = $e->getMessage();
		}
		Application::redir($_SERVER['HTTP_REFERER']);
	}