<?php
class Personnel {

	//attributs
	private $_id = null;
	private $_idDirection = null;
	private $_idDepartement = null;
	private $_idService = null;
	private $_nom = null;
	private $_message = null;
	public static $NO_PERSONNEL = 1;
	private static $_options = array(
		'id' => 0,
		'id_direction' => 1,
		'id_departement' => 2,
		'id_service' => 3,
		'nom' => 4
	);
	
	//constructeur
	public function Personnel($idDirection, $idDepartement,$idService, $nom) {
		$this->_idDirection = $idDirection;
		$this->_idDepartement = $idDepartement;
		$this->_idService = $idService;
		$this->_nom = $nom;
	}
	
	//getters
	public function getId() { return $this->_id; }
	public function getIdDirection() { return $this->_idDirection; }
	public function getIdDepartement() { return $this->_idDepartement; }
	public function getIdService() { return $this->_idService; }
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
	public function setIdService($value) { $this->_idService = $value; }
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
			$this->setMessage('personnel valide');
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
	
	public static function ajouter(Personnel $per) {
		$cols = self::getCols();
		$vals = array(
			$per->getIdDirection(),
			$per->getIdDepartement(),
			$per->getIdService(),
			$per->getNom()
		);
		DB_Manager::insert(self::getTableName(), $cols, $vals);
	}
	
	public static function modifier(Personnel $per) {
		$id = $per->getId();
		$cols = self::getCols();
		$vals = array(
			$per->getIdDirection(),
			$per->getIdDepartement(),
			$per->getIdService(),
			$per->getNom()
		);
		DB_Manager::update(self::getTableName(), $cols, $vals, "id = '$id'");
	}
	
	public static function supprimer(Personnel $per) {
		$id = $per->getId();
		DB_Manager::delete(self::getTableName(), "id = '$id'");
	}
	
	public static function existe(Personnel $per) {
		//le personnel existe s'il existe dans la base
		//i.e: son nom existe
		$nom = $per->getNom();
		$condition = "nom = '$nom'";
		$res = DB_Manager::select(self::getTableName(), $condition);
		return ($res != DB_Manager::$NO_RESULTS);
	}
	
	public static function getAll() {
		$rows = DB_Manager::select(self::getTableName(), 'TRUE');
		if($rows == DB_Manager::$NO_RESULTS) { return self::$NO_PERSONNEL; }
		$objs = array();
		foreach ($rows as $row) {
			$obj = new Personnel($row['id_direction'], $row['id_departement'],$row['id_service'],$row['nom']);
			$obj->setId($row['id']);
			$objs[] = $obj;
		}
		return $objs;
	}
	
	public static function get($id) {
		//$row = DB_Manager::select(self::getTableName(), "id = '$id'");
		$row = DB_Manager::getRow(self::getTableName(), $id);
		if($row == DB_Manager::$NOT_A_ROW) { return self::$NO_PERSONNEL; }
		$per = new Personnel($row['id_direction'], $row['id_departement'],$row['id_service'], $row['nom']);
		$per->setId($id);
		return $per;
	}
	
	public static function getCols() {
		return array('id_direction', 'id_departement','id_service', 'nom');
	}
	
	public static function getTableName() {
		return 'personnels';
	}
}