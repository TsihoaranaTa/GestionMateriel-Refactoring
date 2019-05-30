<?php
class Entree {
	//attributs
	private $_id = null;
	private $_idProduit = null;
	private $_quantite = null;
	private $_dateEntree = null;
	private $_message = null;
	public static $NO_ENTREE = 1;
	private static $_options = array(
		'id' => 0,
		'id_produit' => 1,
		'quantite' => 2,
		'date_entree' => 3
	);

	//constructeur
	public function Entree($idProduit, $quantite, $dateEntree) {
		$this->_idProduit = $idProduit;
		$this->_quantite = $quantite;
		$this->_dateEntree = $dateEntree;
	}
	
	//getters
	public function getId() { return $this->_id; }
	public function getIdProduit() { return $this->_idProduit; }
	public function getQuantite() { return $this->_quantite; }
	public function getDateEntree() { return $this->_dateEntree; }
	public function getMessage() {
		//pour que le message s'affiche une seule fois on le réinitialise 
		$str = $this->_message;
		$this->_message = '';
		return $str;
	}

	//setters
	public function setId($value) { $this->_id = $value; }
	public function setIdProduit($value) { $this->_idProduit = $value; }
	public function setQuantite($value) { $this->_quantite = $value; }
	public function setDateEntree($value) { $this->_dateEntree = $value; }
	public function setMessage($value) { $this->_message = $value; }
	
	public function estValide() {
		$this->setMessage('');
		$quantite = ($this->getQuantite() > 0);
		//la date de reception doit être aujourd'hui ou avant pas aprés!
		$date = Application::datesValides($this->getDateEntree(), Application::buildDate(date("d"), date("m"), date("Y")));
		if(!$quantite) {
			$this->_message .= 'quantite doit être > 0<br/>';
		}
		if(!$date) {
			$this->_message .= 'dateEntree doit être inférieur ou égale à ' . Application::buildDate(date("d"), date("m"), date("Y")) . '<br/>';
		}
		if(empty($this->_message)) {
			$this->setMessage('Entrée en stock valide');
		}
		return $quantite && $date;
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
	
	public static function ajouter(Entree $e) {
		$cols = self::getCols();
		$vals = array(
			$e->getIdProduit(),
			$e->getQuantite(),
			Application::toSQLdate($e->getDateEntree())
		);
		DB_Manager::insert(self::getTableName(), $cols, $vals);
		//en plus on doit mettre à jour la quantité en stock du prod
		$p = Produit::get($e->getIdProduit());
		$p->setQuantite($p->getQuantite() + $e->getQuantite());
		Produit::modifier($p);
		//on doit aussi ajouter un mouvement
		$m = new Mouvement('entree', $e->getDateEntree());
		$m->setId(self::getLastId());
		Mouvement::ajouter($m);

	}
	
	public static function modifier(Entree $e) {
		$id = $e->getId();
		$cols = self::getCols();
		$vals = array(
			$e->getIdProduit(),
			$e->getQuantite(),
			Application::toSQLdate($e->getDateEntree())
		);
		DB_Manager::update(self::getTableName(), $cols, $vals, "id = '$id'");
		//mise à jour de la quantité en stock
		$p = Produit::get($e->getIdProduit());
    	$p->setQuantite($p->getQuantite() + $e->getQuantite());
    	Produit::modifier($p);
	}
	
	public static function supprimer(Entree $e) {
		$id = $e->getId();
		DB_Manager::delete(self::getTableName(), "id = '$id'");
	}
	
	public static function existe(Entree $e) {
		//la reception existe s'il existe dans la base
		$idProduit = $e->getIdProduit();
		$quantite = $e->getQuantite();
		$dateEntree = $e->getDateEntree();
		$condition = "id_produit = '$idProduit' AND quantite = '$quantite' AND date_entree = '$dateEntree'";
		$res = DB_Manager::select(self::getTableName(), $condition);
		return ($res != DB_Manager::$NO_RESULTS);
	}
	
	public static function getAll() {
		$rows = DB_Manager::select(self::getTableName(), 'TRUE');
		if($rows == DB_Manager::$NO_RESULTS) { return self::$NO_ENTREE; }
		$objs = array();
		foreach ($rows as $row) {
			$obj = new Entree($row['id_produit'], $row['quantite'], Application::toNormalDate($row['date_entree']));
			$obj->setId($row['id']);
			$objs[] = $obj;
		}
		return $objs;
	}
	
	public static function get($id) {
		//$row = DB_Manager::select(self::getTableName(), "id = '$id'");
		$row = DB_Manager::getRow(self::getTableName(), $id);
		if($row == DB_Manager::$NOT_A_ROW) { return self::$NO_ENTREE; }
		$e = new Entree($row['id_produit'], $row['quantite'], Application::toNormalDate($row['date_entree']));
		$e->setId($id);
		return $e;
	}
	
	public static function getCols() {
		return array('id_produit', 'quantite', 'date_entree');
	}
	
	public static function getTableName() {
		return 'entrees';
	}
	
	public static function getLastId() {
		$condition = "id = (SELECT MAX(id) FROM " . self::getTableName() . ")";
		$row = DB_Manager::select(self::getTableName(), $condition);
		return $row[0]['id'];
	}
}