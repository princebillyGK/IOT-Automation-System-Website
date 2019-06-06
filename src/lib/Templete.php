<!-- templete.php -->
<?php 
	class Templete{
		protected $path;
		protected $vars= array();

		public function __construct($path){
			$this->path=$path;
		}

		public function __set($key, $val){
			$this->vars[$key]=$val;
		}

		public function __get($key){
			return $this->vars[$key];
		}

		public function __tostring(){
			extract($this->vars);
			ob_start();
			include 'templetes/'.str_replace('\\', '/', $this->path).'.php';
			return ob_get_clean();
		}


	}

 ?>