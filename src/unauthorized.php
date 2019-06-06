
<?php include 'config/init.php'; ?>

 <?php 
	session_start();
	if(!isset($_SESSION['user'])){
		header('location: login.php');
	}else{
		extract($_SESSION['user']);
	}
 ?>
 
<?php 
	$header= new Templete('common/header');
	$footer= new Templete('common/footer');
 ?>
<?php echo $header ?>
<div class="jumbotron not-found">
  <h1 class="display-4">Unauthorized Access</h1>
  <p class="lead">You don't have appropriate permissions to access this page</p>
  <hr class="my-4">
  <p>Please contact the admin</p>
</div>
<?php echo $footer; ?>