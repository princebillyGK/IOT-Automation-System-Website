<?php 
	include 'config/init.php';
	include 'lib/inputProcess.php'; 
	$db= new Database;
	if(!empty($_REQUEST)){
		print_r($_REQUEST);
		foreach ($_REQUEST as $key => $value) {
			$db->query("SELECT * FROM sensors WHERE name = ?");
			$key=input_filter($key);
			$temp= $db->fetchArray([$key]);
			if(empty($temp)){
				$db->query("INSERT INTO `sensors` (`name`, `value`) VALUES (?,?)");
				$db->execute([$key,$value]);
			}else{
				$db->query("UPDATE `sensors` SET `value`= ? WHERE `name` = ?");
				$db->execute([$value,$key]);
			}
		}
	}
 ?>