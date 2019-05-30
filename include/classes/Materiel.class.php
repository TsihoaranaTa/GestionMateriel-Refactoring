<?php
class Materiel {

	//attributs
	private $_id = null;
	private $_idDepartement = null;
	private $_idDirection = null;
	private $_type = null;
	private $_reference = null;
	private $_date = null;
	private $_idService = null;
	private $_idPersonnel = null;

	private $_message = null;
	public static $NO_MATERIEL = 1;
	private static $_options = array(
		'id' => 0,
		'id_departement' => 1,
		'id_direction' => 2,
		'type' => 3,
		'reference' => 4,
		'date' => 5,
		'id_service' => 6,
		'id_personnel' => 7
	);
	
	//constructeur
	public function Materiel($idDepartement, $idDirection, $type, $reference,$date,$idService, $idPersonnel)
	 {
		$this->_idDepartement = $idDepartement;
		$this->_idDirection = $idDirection;
		$this->_type = $type;
		$this->_reference = $reference;
		$this->_date = $date;
		$this->_idService = $idService;
		$this->_idPersonnel = $idPersonnel;
	}
	
	//getters
	public function getId() { return $this->_id; }
	public function getIdDepartement() { return $this->_idDepartement; }
	public function getIdDirection() { return $this->_idDirection; }
	public function getType() { return $this->_type; }
	public function getReference() { return $this->_reference; }
	public function getDate() { return $this->_date; }
	public function getIdService() { return $this->_idService; }
	public function getIdPersonnel() { return $this->_idPersonnel; }
	public function getMessage() {
		//pour que le message s'affiche une seule fois on le réinitialise 
		$str = $this->_message;
		$this->_message = '';
		return $str;
	}
	
	//setters
	public function setId($value) { $this->_id = $value; }
	public function setIdDepartement($value) { $this->_idDepartement = $value; }
	public function setIdDirection($value) { $this->_idDirection = $value; }
	public function setType($value) { $this->_type = $value; }
	public function setReference($value) { $this->_reference = $value; }
	public function setDate($value) { $this->_date = $value; }
	public function setIdService($value) { $this->_idService = $value; }
	public function setIdPersonnel($value) { $this->_idPersonnel = $value; }
	public function setMessage($value) { $this->_message = $value; }
	
	public function estValide() {
		$this->setMessage('');
		$lenType = strlen($this->getType());
		$type = ($lenType > 0) && ($lenType <= 100);
		if(!$type) {
			if(!$lenType) {
				$this->_message .= '<br/>type ne doit pas être vide!';
			}
			if($lenType > 100) {
				$this->_message .= '<br/>type ne doit pas dépasser 100 caractéres!';
			}
		}
		$lenReference = strlen($this->getReference());
		$reference = ($lenReference > 0) && ($lenReference <= 100);
		if(!$reference) {
			if(!$lenReference) {
				$this->_message .= '<br/>reference ne doit pas être vide!';
			}
			if($lenReference > 100) {
				$this->_message .= '<br/>reference ne doit pas dépasser 100 caractéres!';
			}
		}
		
		if(empty($this->_message)) {
			$this->setMessage('Materiel valide');
		}
		return $type && $reference;
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
	
	public static function ajouter(Materiel $mat) {
		$cols = self::getCols();
		$vals = array(
			$mat->getIdDepartement(),
			$mat->getIdDirection(),
			$mat->getType(),
			$mat->getReference(),
			$mat->getDate(),
			$mat->getIdService(),
			$mat->getIdPersonnel(),
			
		);
		DB_Manager::insert(self::getTableName(), $cols, $vals);
	}
	
	public static function modifier(Materiel $mat) {
		$id = $mat->getId();
		$cols = self::getCols();
		$vals = array(
			$mat->getIdDepartement(),
			$mat->getIdDirection(),
			$mat->getType(),
			$mat->getReference(),
			$mat->getDate(),
			$mat->getIdService(),
			$mat->getIdPersonnel(),
			
		);
		DB_Manager::update(self::getTableName(), $cols, $vals, "id = '$id'");
	}
	
	public static function supprimer(Materiel $mat) {
		$id = $mat->getId();
		DB_Manager::delete(self::getTableName(), "id = '$id'");
	}
	
	public static function existe(Materiel $mat) {
		//le materiel existe s'il existe dans la base
		//i.e: son (id_departement, id_direction, type) existe
		$type = $mat->getType();
		$date = $mat->getDate();
		$condition = "type = '$type' AND date = '$date'";
		$res = DB_Manager::select(self::getTableName(), $condition);
		return ($res != DB_Manager::$NO_RESULTS);
	}
	
	public static function getAll() {
		$rows = DB_Manager::select(self::getTableName(), 'TRUE');
		if($rows == DB_Manager::$NO_RESULTS) { return self::$NO_MATERIEL; }
		$objs = array();
		foreach ($rows as $row) {
			$obj = new Materiel($row['id_departement'], $row['id_direction'], $row['type'], $row['reference'], $row['date'],$row['id_service'], $row['id_personnel']);
			$obj->setId($row['id']);
			$objs[] = $obj;
		}
		return $objs;
	}
	
	public static function get($id) {
		//$row = DB_Manager::select(self::getTableName(), "id = '$id'");
		$row = DB_Manager::getRow(self::getTableName(), $id);
		if($row == DB_Manager::$NOT_A_ROW) { return self::$NO_MATERIEL; }
		$mat = new Materiel($row['id_departement'], $row['id_direction'], $row['type'], $row['reference'],$row['date'],$row['id_service'], $row['id_personnel']);
		$mat->setId($id);
		return $mat;
	}
	
	public static function getCols() {
		return array('id_departement', 'id_direction', 'type', 'reference','date','id_service', 'id_personnel');
	}
	
	public static function getTableName() {
		return 'materiels';
	}
}