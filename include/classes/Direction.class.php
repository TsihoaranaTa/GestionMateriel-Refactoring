<?php
class Direction {

	//attributs
	private $_id = null;
	private $_nom = null;
	private $_nom_court = null;
	private $_message = null;
	public static $NO_DIRECTION = 1;
	private static $_options = array(
		'id' => 0,
		'nom' => 1,
		'nom_court' => 2
	);
	
	//constructeur
	public function Direction($nom, $nomCourt) {
		$this->_nom = $nom;
		$this->_nom_court = $nomCourt;
	}
	
	//getters
	public function getId() { return $this->_id; }
	public function getNom() { return $this->_nom; }
	public function getNomCourt() { return $this->_nom_court; }
	public function getMessage() {
		//pour que le message s'affiche une seule fois on le réinitialise 
		$str = $this->_message;
		$this->_message = '';
		return $str;
	}
	
	//setters
	public function setId($value) { $this->_id = $value; }
	public function setNom($value) { $this->_nom = $value; }
	public function setNomCourt($value) { $this->_nom_court = $value; }
	public function setMessage($value) { $this->_message = $value; }
	
	public function estValide() {
		$this->setMessage('');
		//nom doit être <= 100 caractéres
		$lenNom = strlen($this->getNom());
		$nom = ($lenNom > 0) && ($lenNom <= 100);
		if(!$nom) {
			if(!$lenNom) {
				$this->_message .= '<br/>nom ne doit pas être vide!';
			}
			if($lenNom > 100) {
				$this->_message .= '<br/>nom ne doit pas dépasser 100 caractéres!';
			}
		}
		//nomCourt doit être <= 50 caractéres
		$lenNomCourt = strlen($this->getNomCourt());
		$nomCourt = ($lenNomCourt > 0) && ($lenNomCourt <= 50);
		if(!$nomCourt) {
			if(!$lenNomCourt) {
				$this->_message .= '<br/>nomCourt ne doit pas être vide!';
			}
			if($lenNomCourt > 50) {
				$this->_message .= '<br/>nomCourt ne doit pas dépasser 50 caractéres!';
			}
		}
		if(empty($this->_message)) {
			$this->setMessage('Direction valide');
		}
		return $nom && $nomCourt;
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
	
	public static function ajouter(Direction $d) {
		$cols = self::getCols();
		$vals = array(
			$d->getNom(),
			$d->getNomCourt()
		);
		DB_Manager::insert(self::getTableName(), $cols, $vals);
	}
	
	public static function modifier(Direction $d) {
		$id = $d->getId();
		$cols = self::getCols();
		$vals = array(
			$d->getNom(),
			$d->getNomCourt()
		);
		DB_Manager::update(self::getTableName(), $cols, $vals, "id = '$id'");
	}
	
	public static function supprimer(Direction $d) {
		$id = $d->getId();
		DB_Manager::delete(self::getTableName(), "id = '$id'");
	}
	
	public static function existe(Direction $d) {
		//la direction existe s'il existe dans la base
		if($d === Direction::$NO_DIRECTION) { return false; }
		$nom = $d->getNom();
		$nomCourt = $d->getNomCourt();
		$condition = "nom = '$nom' AND nom_court = '$nomCourt'";
		$res = DB_Manager::select(self::getTableName(), $condition);
		return ($res != DB_Manager::$NO_RESULTS);
	}
	
	public static function getAll() {
		$rows = DB_Manager::select(self::getTableName(), 'TRUE');
		if($rows == DB_Manager::$NO_RESULTS) { return self::$NO_DIRECTION; }
		$objs = array();
		foreach ($rows as $row) {
			$obj = new Direction($row['nom'], $row['nom_court']);
			$obj->setId($row['id']);
			$objs[] = $obj;
		}
		return $objs;
	}
	
	public static function get($id) {
		//$row = DB_Manager::select(self::getTableName(), "id = '$id'");
		$row = DB_Manager::getRow(self::getTableName(), $id);
		if($row == DB_Manager::$NOT_A_ROW) { return self::$NO_DIRECTION; }
		$d = new Direction($row['nom'], $row['nom_court']);
		$d->setId($id);
		return $d;
	}
	
	public static function getCols() {
		return array('nom', 'nom_court');
	}
	
	public static function getTableName() {
		return 'directions';
	}
}