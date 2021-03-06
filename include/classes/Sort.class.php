<?php

class Sort {
	
	public static $ASC = 'asc';
	public static $DESC = 'desc';
	public static $orderLog = null;
	public static $cols = null;	//les colonnes
	
	
	public static function initOrderLog($table) {
		switch($table):
	
			case 'produits':
				self::$orderLog = array(
				'id'		=>	self::$ASC,
				'designation'	=>	self::$ASC,
				'quantite' => self::$ASC,
				'reference' => self::$ASC
			);
			break;
			default:
				self::$orderLog = null;	//pour détecter les erreurs
			break;
		endswitch;
	}
	
	public static function initCols($table) {
		switch($table):
			
			case 'produits':
				self::$cols = array(
					'id',
					'designation',
					'quantite',
					'reference'
				);
			break;
			default:
				self::$cols = null;	//pour détecter les erreurs
			break;
		endswitch;
	}
	
	//fonction qui verifie si les paramétres existent ou pas
	public static function parametresExistent() {
		return (isset($_GET['col']) && isset($_GET['ordre']) && isset($_GET['n']));
	}
	
	//fonction qui verifie si les paramétres sont valides ou non
	//remarque: cette fonction doit être obligatoirement utilisé si la fonction
	//parametresExistent() renvoie vrai (true)
	public static function parametresValides() {	//cette fonction change selon la table à consulter
		$ordres = array(self::$ASC, self::$DESC);
		return in_array($_GET['col'], self::$cols) && in_array($_GET['ordre'], $ordres) && preg_match("~^-?[0-9]+$~i", $_GET['n']);
		//paramétres de page:
		//col:		colonne
		//ordre:	ordre
	}
	
	//fonction qui met à jour le tableau $orderLog
	//et bascule la valeur ordre de la clé correspondante
	public static function MAJordre() {
		$colonne = $_GET['col'];
		self::$orderLog[$colonne] = $_GET['ordre'];	//pour corriger l'erreur de réinitialisation:
		self::$orderLog[$colonne] = (self::$orderLog[$colonne] == self::$ASC)? self::$DESC: self::$ASC;
	}
	
	public static function printArrow($tag) {
		if(self::parametresExistent() && self::parametresValides()):	//cette fonction ne fonctionne que si les paramétres sont présents et valides
			$descArr = "▼";
			$ascArr = "▲";
			if($_GET['col'] == $tag):
				echo ($_GET['ordre'] == self::$ASC)? $ascArr: $descArr;
			endif;
		endif;
	}
}