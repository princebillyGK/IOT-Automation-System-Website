<?php 
	function input_filter($input){
		$input= trim($input);
		$input= stripcslashes($input);
		$input= htmlspecialchars($input);
		return $input;
	}

	function boolcheck($string){
		return $string=='true'?1:0;
	}
 ?>