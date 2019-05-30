<?php
class Intervention {

	//attributs
	private $_id = null;
	private $_idEtat = null;
	private $_idMateriel = null;
	private $_nom = null;
	private $_ticket = null;
	private $_cout = null;
	private $_temps = null;
	private $_idDirection = null;
	private $_idDepartement = null;
	private $_idService = null;
	private $_idPersonnel = null;
	private $_intervenant = null;
	private $_message = null;
	public static $NO_INTERVENTION = 1;
	private static $_options = array(
		'id' => 0,
		'id_etat' => 1,
		'id_materiel' => 2,
		'nom' => 3,
		'ticket' => 4,
		'cout' => 5,
		'temps' => 6,
		'id_direction' => 7,
		'id_departement' => 8,
		'id_service' => 9,
		'id_personnel' => 10,
		'intervenant' => 11
	);
	
	//constructeur
	public function Intervention($idEtat, $idMateriel, $nom, $ticket, $cout, $temps,$idDirection, $idDepartement,
		$idService, $idPersonnel, $intervenant) 
	{
		$this->_idEtat = $idEtat;
		$this->_idMateriel = $idMateriel;
		$this->_nom = $nom;
		$this->_ticket = $ticket;
		$this->_cout = $cout;
		$this->_temps = $temps;
		$this->_idDirection = $idDirection;
		$this->_idDepartement = $idDepartement;
		$this->_idService = $idService;
		$this->_idPersonnel = $idPersonnel;
		$this->_intervenant = $intervenant;
	}
	
	//getters
	public function getId() { return $this->_id; }
	public function getIdEtat() { return $this->_idEtat; }
	public function getIdMateriel() { return $this->_idMateriel; }
	public function getNom() { return $this->_nom; }
	public function getTicket() { return $this->_ticket; }
	public function getCout() { return $this->_cout; }
	public function getTemps() { return $this->_temps; }
	public function getIdDirection() { return $this->_idDirection; }
	public function getIdDepartement() { return $this->_idDepartement; }
	public function getIdService() { return $this->_idService; }
	public function getIdPersonnel() { return $this->_idPersonnel; }
	public function getIntervenant() { return $this->_intervenant; }
	public function getMessage() {
		//pour que le message s'affiche une seule fois on le réinitialise 
		$str = $this->_message;
		$this->_message = '';
		return $str;
	}
	
	//setters
	public function setId($value) { $this->_id = $value; }
	public function setIdEtat($value) { $this->_idEtat = $value; }
	public function setIdMateriel($value) { $this->_idMateriel = $value; }
	public function setNom($value) { $this->_nom = $value; }
	public function setTicket($value) { $this->_ticket = $value; }
	public function setCout($value) { $this->_cout = $value; }
	public function setTemps($value) { $this->_temps = $value; }
	public function setIdDirection($value) { $this->_idDirection = $value; }
	public function setIdDepartement($value) { $this->_idDepartement = $value; }
	public function setIdService($value) { $this->_idService = $value; }
	public function setIdPersonnel($value) { $this->_idPersonnel = $value; }
	public function setIntervenant($value) { $this->_intervenant = $value; }
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
	
	public static function ajouter(Intervention $in) {
		$cols = self::getCols();
		$vals = array(
			$in->getIdEtat(),
			$in->getIdMateriel(),
			$in->getNom(),
			$in->getTicket(),
			$in->getCout(),
			$in->getTemps(),
			$in->getIdDirection(),
			$in->getIdDepartement(),
			$in->getIdService(),
			$in->getIdPersonnel(),
			$in->getIntervenant()
		);
		DB_Manager::insert(self::getTableName(), $cols, $vals);
	}
	
	public static function modifier(Intervention $in) {
		$id = $in->getId();
		$cols = self::getCols();
		$vals = array(
			$in->getIdEtat(),
			$in->getIdMateriel(),
			$in->getNom(),
			$in->getTicket(),
			$in->getCout(),
			$in->getTemps(),
			$in->getIdDirection(),
			$in->getIdDepartement(),
			$in->getIdService(),
			$in->getIdPersonnel(),
			$in->getIntervenant()
		);
		DB_Manager::update(self::getTableName(), $cols, $vals, "id = '$id'");
	}
	
	public static function supprimer(Intervention $in) {
		$id = $in->getId();
		DB_Manager::delete(self::getTableName(), "id = '$id'");
	}
	
	public static function existe(Intervention $in) {
		//l'intervention existe s'il existe dans la base
		//i.e: son (id_etat, id_materiel, nom) existe
		$idEtat = $in->getIdEtat();
		$idMateriel = $in->getIdMateriel();
		$nom = $in->getNom();
		$ticket = $in->getTicket();
		$cout = $in->getCout();
		$temps = $in->getTemps();
		$condition = "id_etat = '$idEtat' AND id_materiel = '$idMateriel' AND nom = '$nom' AND ticket = '$ticket' AND cout = '$cout' AND temps = '$temps'";
		$res = DB_Manager::select(self::getTableName(), $condition);
		return ($res != DB_Manager::$NO_RESULTS);
	}
	
	public static function getAll() {
		$rows = DB_Manager::select(self::getTableName(), 'TRUE');
		if($rows == DB_Manager::$NO_RESULTS) { return self::$NO_INTERVENTION; }
		$objs = array();
		foreach ($rows as $row) {
			$obj = new Intervention($row['id_etat'], $row['id_materiel'], $row['nom'], $row['ticket'], $row['cout'], $row['temps'],$row['id_direction'], $row['id_departement'], $row['id_service'], $row['id_personnel'], $row['intervenant']);
			$obj->setId($row['id']);
			$objs[] = $obj;
		}
		return $objs;
	}
	
	public static function get($id) {
		//$row = DB_Manager::select(self::getTableName(), "id = '$id'");
		$row = DB_Manager::getRow(self::getTableName(), $id);
		if($row == DB_Manager::$NOT_A_ROW) { return self::$NO_INTERVENTION; }
		$in = new Intervention($row['id_etat'], $row['id_materiel'], $row['nom'], $row['ticket'], $row['cout'],
		 $row['temps'],$row['id_direction'], $row['id_departement'], $row['id_service'], $row['id_personnel'], $row['intervenant']);
		
		$in->setId($id);
		return $in;
	}
	
	public static function getCols() {
		return array('id_etat', 'id_materiel', 'nom', 'ticket', 'cout', 'temps','id_direction', 'id_departement','id_service', 'id_personnel', 'intervenant');
	}
	
	public static function getTableName() {
		return 'interventions';
	}	
}