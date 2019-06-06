<?php 
	class Database{
		private $host= DB_HOST;
		private $uname= DB_USER;
		private $pwd= DB_PASS;
		private $dbName= DB_NAME;
		private $pdoOption= array(
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_EMULATE_PREPARES=> false
			);

		private $dbh;
		private $error;
		private $stmt;

		public function __construct(){
				$dsn= "mysql:host=".$this->host.";dbname=".$this->dbName;
				$this->dbh= new PDO($dsn,$this->uname,$this->pwd,$this->pdoOption ); 
		}

		public function query($sql){
			$this->stmt=$this->dbh->prepare($sql);
		}

		public function execute($input=[]){
			$this->stmt->execute($input);
		}

		public function fetchall($input=[]){
			$this->stmt->execute($input);
			return $this->stmt->fetchAll(PDO::FETCH_OBJ);
		}

		public function fetch($input=[]){
			$this->stmt->execute($input);
			return $this->stmt->fetch(PDO::FETCH_OBJ);
		}

		public function fetchArray($input=[]){
			$this->stmt->execute($input);
			return $this->stmt->fetch(PDO::FETCH_ASSOC);
		}

		public function fetchArrayAll($input=[]){
			$this->stmt->execute($input);
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}
}
?>
