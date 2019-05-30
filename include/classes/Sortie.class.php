<?php
class Sortie {
	//attributs
	private $_id = null;
	private $_idProduit = null;
	private $_quantite = null;
	private $_dateSortie = null;
	private $_bon = null;
	private $_message = null;
	public static $NO_SORTIE = 1;
	private static $_options = array(
		'id' => 0,
		'id_produit' => 1,
		'quantite' => 2,
		'date_sortie' => 3,
		'bon' => 4
	);

	
	//constructeur
	public function Sortie($idProduit, $quantite, $dateSortie, $bon) {
		$this->_idProduit = $idProduit;
		$this->_quantite = $quantite;
		$this->_dateSortie = $dateSortie;
		$this->_bon = $bon;
	}
	
	//getters  
	public function getId() { return $this->_id; }
	public function getIdProduit() { return $this->_idProduit; }
	public function getQuantite() { return $this->_quantite; }
	public function getDateSortie() { return $this->_dateSortie; }
	public function getBon() { return $this->_bon; }
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
	public function setDateSortie($value) { $this->_dateSortie = $value; }
	public function setBon($value) { $this->_bon = $value; }
	public function setMessage($value) { $this->_message = $value; }
	
	public function estValide() {
		$this->setMessage('');
		$quantite = ($this->getQuantite() > 0);
		$p = Produit::get($this->_idProduit);
		$quantiteStock = $this->_quantite <= $p->getQuantite();	//la quantité livré doit être inférieur ou égale a la quantité en stock
		//la date de reception doit être aujourd'hui ou avant pas aprés!
		$date = Application::datesValides(Application::buildDate(date("d"), date("m"), date("Y")), $this->getDateSortie());
		if(!$quantite) {
			$this->_message .= 'quantite doit être > 0<br/>';
		}
		if(!$quantiteStock) {
			$this->_message .= 'quantite livré doit être <= quantité en stock (' . $p->getQuantite() . ')<br/>';
		}
		if(!$date) {
			$this->_message .= 'date de sortie doit être supérieur ou égale à ' . Application::buildDate(date("d"), date("m"), date("Y")) . '<br/>';
		}
		if(empty($this->_message)) {
			$this->setMessage('Sortie de stock valide');
		}
		return $quantite && $quantiteStock && $date;
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
	
	public static function ajouter(Sortie $s) {
		$cols = self::getCols();
		$vals = array(
			$s->getIdProduit(),
			$s->getQuantite(),
			Application::toSQLdate($s->getDateSortie()),
			$s->getBon(),
		);
		DB_Manager::insert(self::getTableName(), $cols, $vals);
    	//mise à jour de la quantité en stock
    	$p = Produit::get($s->getIdProduit());
    	$p->setQuantite($p->getQuantite() - $s->getQuantite());
    	Produit::modifier($p);
		//on doit aussi ajouter un mouvement
		$m = new Mouvement('sortie', $s->getDateSortie());
		$m->setId(self::getLastId());
		Mouvement::ajouter($m);
	}
	
	public static function modifier(Sortie $s) {
		$id = $s->getId();
		$cols = self::getCols();
		$vals = array(
			$s->getIdProduit(),
			$s->getQuantite(),
			Application::toSQLdate($s->getDateSortie()),
			$s->getBon(),
		);
		DB_Manager::update(self::getTableName(), $cols, $vals, "id = '$id'");
		//mise à jour de la quantité en stock
		$p = Produit::get($s->getIdProduit());
    	$p->setQuantite($p->getQuantite() - $s->getQuantite());
    	Produit::modifier($p);
	}
	
	public static function supprimer(Sortie $s) {
		$id = $p->getId();
		DB_Manager::delete(self::getTableName(), "id = '$id'");
	}
	
	public static function existe(Sortie $s) {
		//la sortie existe s'il existe dans la base
		$idProduit = $s->getIdProduit();
		$quantite = $s->getQuantite();
		$dateSortie = $s->getDateSortie();
		$bon = $s->getBon();
		$condition = "id_produit = '$idProduit' AND quantite = '$quantite' AND date_sortie = '$dateSortie' AND bon = '$bon' ";
		$res = DB_Manager::select(self::getTableName(), $condition);
		return ($res != DB_Manager::$NO_RESULTS);
	}
	
	public static function getAll() {
		$rows = DB_Manager::select(self::getTableName(), 'TRUE');
		if($rows == DB_Manager::$NO_RESULTS) { return self::$NO_SORTIE; }
		$objs = array();
		foreach ($rows as $row) {
			$obj = new Sortie($row['id_produit'], $row['quantite'], $row['date_sortie'], $row['bon']);
			$obj->setId($row['id']);
			$objs[] = $obj;
		}
		return $objs;
	}
	
	public static function get($id) {
		//$row = DB_Manager::select(self::getTableName(), "id = '$id'");
		$row = DB_Manager::getRow(self::getTableName(), $id);
		if($row == DB_Manager::$NOT_A_ROW) { return self::$NO_SORTIE; }
		$s = new Sortie($row['id_produit'], $row['quantite'], Application::toNormalDate($row['date_sortie']), $row['bon']);
		$s->setId($id);
		return $s;
	}
	
	public static function getCols() {
		return array('id_produit', 'quantite', 'date_sortie', 'bon');
	}
	
	public static function getTableName() {
		return 'sorties';
	}
	
	public static function getLastId() {
		$condition = "id = (SELECT MAX(id) FROM " . self::getTableName() . ")";
		$row = DB_Manager::select(self::getTableName(), $condition);
		return $row[0]['id'];
	}
}