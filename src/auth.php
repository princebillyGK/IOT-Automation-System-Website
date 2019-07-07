<?php
	session_start();
	include 'config/init.php';
	include 'lib/inputProcess.php'; 
	$db= new Database();

	$un= input_filter($_POST['username']);
	$pwd= input_filter($_POST['password']);
	$db-> query("SELECT * FROM `user` WHERE `username`=? AND `password`= ?");
	$user=$db->fetchArray([$un,$pwd]);
	if(!empty($user)){
		$_SESSION['user']=$user;
		header('location: index.php');
	}else{
		$_SESSION['loginErr']=true;
		header('location: login.php');
	}
?>