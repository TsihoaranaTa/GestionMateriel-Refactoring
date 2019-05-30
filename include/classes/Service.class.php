<?php
class Service {

	//attributs
	private $_id = null;
	private $_idDirection = null;
	private $_idDepartement = null;
	private $_nom = null;
	private $_message = null;
	public static $NO_SERVICE = 1;
	private static $_options = array(
		'id' => 0,
		'id_direction' => 1,
		'id_departement' => 2,
		'nom' => 3
	);
	
	//constructeur
	public function Service($idDirection, $idDepartement, $nom) {
		$this->_idDirection = $idDirection;
		$this->_idDepartement = $idDepartement;
		$this->_nom = $nom;
	}
	
	//getters
	public function getId() { return $this->_id; }
	public function getIdDirection() { return $this->_idDirection; }
	public function getIdDepartement() { return $this->_idDepartement; }
	public function getNom() { return $this->_nom; }
	public function getMessage() {
		//pour que le message s'affiche une seule fois on le réinitialise 
		$str = $this->_message;
		$this->_message = '';
		return $str;
	}
	
	//setters
	public function setId($value) { $this->_id = $value; }
	public function setIdDirection($value) { $this->_idDirection = $value; }
	public function setIdDepartement($value) { $this->_idDepartement = $value; }
	public function setNom($value) { $this->_nom = $value; }
	public function setMessage($value) { $this->_message = $value; }
	
	public function estValide() {
		$this->setMessage('');
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

		if(empty($this->_message)) {
			$this->setMessage('Service valide');
		}
		return $nom;
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
	
	public static function ajouter(Service $ser) {
		$cols = self::getCols();
		$vals = array(
			$ser->getIdDirection(),
			$ser->getIdDepartement(),
			$ser->getNom()
		);
		DB_Manager::insert(self::getTableName(), $cols, $vals);
	}
	
	public static function modifier(Service $ser) {
		$id = $ser->getId();
		$cols = self::getCols();
		$vals = array(
			$ser->getIdDirection(),
			$ser->getIdDepartement(),
			$ser->getNom()
		);
		DB_Manager::update(self::getTableName(), $cols, $vals, "id = '$id'");
	}
	
	public static function supprimer(Service $ser) {
		$id = $ser->getId();
		DB_Manager::delete(self::getTableName(), "id = '$id'");
	}
	
	public static function existe(Service $ser) {
		//le service existe s'il existe dans la base
		//i.e: son (id_direction, id_departement, nom) existe
		$idDirection = $ser->getIdDirection();
		$idDepartement = $ser->getIdDepartement();
		$nom = $ser->getNom();
		$condition = "id_direction = '$idDirection' AND id_departement = '$idDepartement' AND nom = '$nom'";
		$res = DB_Manager::select(self::getTableName(), $condition);
		return ($res != DB_Manager::$NO_RESULTS);
	}
	
	public static function getAll() {
		$rows = DB_Manager::select(self::getTableName(), 'TRUE');
		if($rows == DB_Manager::$NO_RESULTS) { return self::$NO_SERVICE; }
		$objs = array();
		foreach ($rows as $row) {
			$obj = new Service($row['id_direction'], $row['id_departement'], $row['nom']);
			$obj->setId($row['id']);
			$objs[] = $obj;
		}
		return $objs;
	}
	
	public static function get($id) {
		//$row = DB_Manager::select(self::getTableName(), "id = '$id'");
		$row = DB_Manager::getRow(self::getTableName(), $id);
		if($row == DB_Manager::$NOT_A_ROW) { return self::$NO_SERVICE; }
		$ser = new Service($row['id_direction'], $row['id_departement'], $row['nom']);
		$ser->setId($id);
		return $ser;
	}
	
	public static function getCols() {
		return array('id_direction', 'id_departement', 'nom');
	}
	
	public static function getTableName() {
		return 'services';
	}	
}