<?php
class Produit {

	//attributs
	private $_id = null;
	private $_designation = null;
	private $_reference = null;
	private $_quantite = null;
	private $_message = null;
	public static $NO_PRODUIT = 1;
	private static $_options = array(
		'id' => 0,
		'designation' => 3,
		'reference' => 4,
		'quantite' => 5
	);
	
	//constructeur
	public function Produit($designation, $reference, $quantite) {
		$this->_designation = $designation;
		$this->_reference = $reference;
		$this->_quantite = $quantite;
	}
	
	//getters
	public function getId() { return $this->_id; }
	public function getDesignation() { return $this->_designation; }
	public function getReference() { return $this->_reference; }
	public function getQuantite() { return $this->_quantite; }
	public function getMessage() {
		//pour que le message s'affiche une seule fois on le réinitialise 
		$str = $this->_message;
		$this->_message = '';
		return $str;
	}
	
	//setters
	public function setId($value) { $this->_id = $value; }
	public function setDesignation($value) { $this->_designation = $value; }
	public function setReference($value) { $this->_reference = $value; }
	public function setQuantite($value) { $this->_quantite = $value; }
	public function setMessage($value) { $this->_message = $value; }
	
	public function estValide() {
		$this->setMessage('');
		$lenDesignation = strlen($this->getDesignation());
		$designation = ($lenDesignation > 0) && ($lenDesignation <= 100);
		if(!$designation) {
			if(!$lenDesignation) {
				$this->_message .= '<br/>la désignation ne doit pas être vide!';
			}
			if($lenDesignation > 100) {
				$this->_message .= '<br/>la désignation ne doit pas dépasser 100 caractéres!';
			}
		}
		$lenReference = strlen($this->getReference());
		$reference = ($lenReference > 0) && ($lenReference <= 100);
		if(!$reference) {
			if(!$lenReference) {
				$this->_message .= '<br/>les références ne doivent pas être vide!';
			}
			if($lenReference > 100) {
				$this->_message .= '<br/>les références ne doivent pas dépasser 100 caractéres!';
			}
		}
		$quantite = $this->getQuantite() >= 0;
		if(!$quantite) {
			$this->_message .= '<br/>quantité doit être positive!';
		}
		if(empty($this->_message)) {
			$this->setMessage('Produit valide');
		}
		return $designation && $reference && $quantite;
	}
	
	public static function nb() {
		return DB_Manager::getNbRows(self::getTableName());
	}
	
	public static function pasDelements() {
		return !self::nb();
	}

	public static function loadOptions() {
		return self::$_options;
	}
	
	public static function ajouter(Produit $p) {
		$cols = self::getCols();
		$vals = array(
			$p->getDesignation(),
			$p->getReference(),
			$p->getQuantite()
		);
		DB_Manager::insert(self::getTableName(), $cols, $vals);
	}
	
	public static function modifier(Produit $p) {
		$id = $p->getId();
		$cols = self::getCols();
		$vals = array(
			$p->getDesignation(),
			$p->getReference(),
			$p->getQuantite()
		);
		DB_Manager::update(self::getTableName(), $cols, $vals, "id = '$id'");
	}
	
	public static function supprimer(Produit $p) {
		$id = $p->getId();
		DB_Manager::delete(self::getTableName(), "id = '$id'");
	}
	
	public static function existe(Produit $p) {
		//le produit existe s'il existe dans la base
		//i.e: sa désignation existe
		$designation = $p->getDesignation();
		$condition = "designation = '$designation'";
		$res = DB_Manager::select(self::getTableName(), $condition);
		return ($res != DB_Manager::$NO_RESULTS);
	}
	
	public static function getAll() {
		$rows = DB_Manager::select(self::getTableName(), 'TRUE');
		if($rows == DB_Manager::$NO_RESULTS) { return self::$NO_PRODUIT; }
		$objs = array();
		foreach ($rows as $row) {
			$obj = new Produit($row['designation'], $row['reference'], $row['quantite']);
			$obj->setId($row['id']);
			$objs[] = $obj;
		}
		return $objs;
	}
	
	public static function get($id) {
		//$row = DB_Manager::select(self::getTableName(), "id = '$id'");
		$row = DB_Manager::getRow(self::getTableName(), $id);
		if($row == DB_Manager::$NOT_A_ROW) { return self::$NO_PRODUIT; }
		$p = new Produit($row['designation'], $row['reference'], $row['quantite']);
		$p->setId($id);
		return $p;
	}
	
	public static function getCols() {
		return array('designation', 'reference', 'quantite');
	}
	
	public static function getTableName() {
		return 'produits';
	}

	public static function getSommeEntree($id) {
		$condition = "id_produit = '$id'";
		$entrees = DB_Manager::select(Entree::getTableName(), $condition);
		if($entrees == DB_Manager::$NO_RESULTS) { return 0; }	//aucune entrée
		$somme = 0;
		foreach ($entrees as $entree) {
			$somme += $entree['quantite'];
		}
		return $somme;
	}

	public static function getSommeSortie($id) {
		$condition = "id_produit = '$id'";
		$sorties = DB_Manager::select(Sortie::getTableName(), $condition);
		if($sorties == DB_Manager::$NO_RESULTS) { return 0; }	//aucune sortie
		$somme = 0;
		foreach ($sorties as $sortie) {
			$somme += $sortie['quantite'];
		}
		return $somme;
	}
}