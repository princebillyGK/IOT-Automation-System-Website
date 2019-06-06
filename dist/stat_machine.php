<?php 
	include 'config/init.php'; 
	$db = new Database();

	$db->query('SELECT * FROM `switchview`');
	$switchs=$db->fetchAll();
	foreach ($switchs as $key => $switch)
		echo $switch->code.'='.$switch->value.'<br>';
?>