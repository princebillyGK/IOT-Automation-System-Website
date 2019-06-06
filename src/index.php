
<?php 
	include 'config/init.php'; 
	include 'lib/inputProcess.php';
	$db = new Database();
?>


<?php 
	session_start();
	if(!isset($_SESSION['user'])){
		header('location: login.php');
	}else{
		extract($_SESSION['user']);
	}
 ?>

 <?php 

 /*======================================
 =            Switch Control            =
 ======================================*/
 
 	if(isset($_GET['switchtoggle'])){
 		$id= input_filter($_GET['switchtoggle']);
 		$db->query('UPDATE `switchview` SET `value`= !value WHERE `serial`= ?');
 		$db->execute([$id]);
 	}
 
 /*=====  End of Switch Control  ======*/
 
  ?>


<?php 
	$header= new Templete('common/header');
	$footer= new Templete('common/footer');
 ?>

 <?php echo $header ?>

<div class="container">
 <div class="view sensors-view">
 		<span class="title"><i class="fas fa-tachometer-alt"></i> Sensors</span>
 		<?php if($usertype=='admin'):  ?>
 			<a href="customize-admin.php#sensorview" class="btn btn-success text-light float-right">
 				<i class="fas fa-cog"></i>
 			</a>
 		<?php endif; ?>
 		<hr>
 		<?php 
			$db->query('SELECT * FROM `sensorview`');
			$sensors=$db->fetchAll();
			//print_r($sensors);
		 ?>
		<div class="d-flex flex-wrap" >
			<?php foreach ($sensors as $key => $sensor): ?>
				<div class="sensorbox">
					 <h6 class='title'><?php echo $sensor->title ?></h6>
					 <img class='logo' src="<?php echo $sensor->logo ?>">
				      <?php
				      	 $db->query('SELECT * FROM `sensors` WHERE id= ?'); 
				      	 $sensordevice= $db->fetch([$sensor->sensorId])
				      ?>
				      <p class="value"><?php echo $sensordevice->value; ?><?php echo $sensor->unit; ?></p>
				</div>
			<?php endforeach ?>
		</div>
 </div>
 


 <div class="view switch-view">
 		<span class="title"><i class="fas fa-toggle-on"></i> Switches</span>
 		<?php if($usertype=='admin'):  ?>
 			<a href="customize-admin.php#switchview" class="btn btn-success text-light float-right">
 				<i class="fas fa-cog"></i>
 			</a>
 		<?php endif; ?>
 		<hr>
		<?php 
			$db->query('SELECT * FROM `switchview`');
			$switchs=$db->fetchAll();
			//print_r($switchs);
		 ?>
		<div class="d-flex flex-wrap" >
			<?php foreach ($switchs as $key => $switch): ?>
				<a class="switch" href="<?php echo $_SERVER['PHP_SELF'].'?switchtoggle='.$switch->serial ?>">
					<div class="switchbox">
						 <h6 class='title'><?php echo $switch->title ?></h6>
						 <img class='logo' src="<?php echo $switch->logo ?>">
						 <?php if ($switch->value==1): ?>
						 	<p class="text-center small"><i class="far fa-circle text-success"></i> ON</span>
						 <?php else: ?>
						 	<p class="text-center text-muted small"><i class="far fa-dizzy"></i> OFF</span>
						 <?php endif ?>
					</div>
				</a>
			<?php endforeach ?>
		</div>
 </div>
</div>


 <?php if($usertype=='admin'):  ?>
 	<a href="customize-admin.php#userview" class="add-user btn btn-light">
 		<i class="fas fa-user-plus"></i>
 	</a>	
 <?php endif; ?>


 <?php echo $footer ?>
