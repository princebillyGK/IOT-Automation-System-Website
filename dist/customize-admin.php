
<?php 
	include 'config/init.php';
	include 'lib/inputProcess.php';	
	 $db= new Database();
 ?>


<?php 
	session_start();
	if(!isset($_SESSION['user'])){
		header('location: login.php');
	}else{
		extract($_SESSION['user']);
		if($usertype!='admin'){
			header('location: unauthorized.php');	
		}
	}
 ?>
 
<?php 
	function goBackError($e){
	            header('location: customize-admin.php?e='.$e);
	        }

	/*====================================
	=            Form Control            =
	====================================*/

	/*----------  Sensor Add  ----------*/
	

	if(isset($_POST['sensorTitle'])){
		$sensorTitle= input_filter($_POST['sensorTitle']);
		$sensorUnit= input_filter($_POST['sensorUnit']);
		$sensorDevice= input_filter($_POST['sensorDevice']);
		//print_r($_FILES);
	$uploaded_sensorLogo_name= $_FILES['sensorLogo']['name'];
        $uploaded_sensorLogo_tmp_name= $_FILES['sensorLogo']['tmp_name'];
        $uploaded_sensorLogo_size=$_FILES['sensorLogo']['size'];
        $uploaded_sensorLogo_error= $_FILES['sensorLogo']['error'];
        $uploaded_sensorLogo_type= $_FILES['sensorLogo']['type'];
        $uploaded_sensorLogo_ext=explode('.', $uploaded_sensorLogo_name);
        $uploaded_sensorLogo_actual_ext= strtolower(end($uploaded_sensorLogo_ext));
        $uploaded_sensorLogo_dimension= getimagesize($uploaded_sensorLogo_tmp_name);
        $uploaded_sensorLogo_width= $uploaded_sensorLogo_dimension[0];
        $uploaded_sensorLogo_height= $uploaded_sensorLogo_dimension[1];
        $allowed_sensorLogo = array('png');
        $uploaded_sensorLogo_new_name= uniqid().'.'.$uploaded_sensorLogo_actual_ext;
                    $uploaded_sensorLogo_destination='appdata/logo/sensorLogo/'.$uploaded_sensorLogo_new_name;
        if($uploaded_sensorLogo_error===0){
            if(in_array($uploaded_sensorLogo_actual_ext,$allowed_sensorLogo)){
                if($uploaded_sensorLogo_size<=1000000){
                    if($uploaded_sensorLogo_width==128 && $uploaded_sensorLogo_height==128){
                         move_uploaded_file($uploaded_sensorLogo_tmp_name,$uploaded_sensorLogo_destination);
                    }else{
                        $e="Uploaded sensorLogo should be of 128 x 128";
                        goBackError($e);
                        exit;
                    }
                }else{
                    $e= 'Your file is too big';
                    goBackError($e);
                    exit;
                }
            }else{
                $e= 'Uploaded logo must be png';
                 goBackError($e);
                 exit;
            }
        }else{
            $e= 'There was an error uploading your sensorLogo'.
                goBackError($e);
                exit;
        }  


	    $db->query('INSERT INTO `sensorview`( `title`, `sensorId`, `unit`, `logo`) VALUES (:col_1,:col_2,:col_3,:col_4)');                
		$db->execute([
			'col_1' => $sensorTitle,
			'col_2' => $sensorDevice,
			'col_3' => $sensorUnit,
			'col_4' => $uploaded_sensorLogo_destination

		]);

	}


	/*----------  Switch Add  ----------*/
	

	if(isset($_POST['switchTitle'])){
		$switchTitle= input_filter($_POST['switchTitle']);
		$switchCode= input_filter($_POST['switchCode']);
		//print_r($_FILES);
	$uploaded_switchLogo_name= $_FILES['switchLogo']['name'];
        $uploaded_switchLogo_tmp_name= $_FILES['switchLogo']['tmp_name'];
        $uploaded_switchLogo_size=$_FILES['switchLogo']['size'];
        $uploaded_switchLogo_error= $_FILES['switchLogo']['error'];
        $uploaded_switchLogo_type= $_FILES['switchLogo']['type'];
        $uploaded_switchLogo_ext=explode('.', $uploaded_switchLogo_name);
        $uploaded_switchLogo_actual_ext= strtolower(end($uploaded_switchLogo_ext));
        $uploaded_switchLogo_dimension= getimagesize($uploaded_switchLogo_tmp_name);
        $uploaded_switchLogo_width= $uploaded_switchLogo_dimension[0];
        $uploaded_switchLogo_height= $uploaded_switchLogo_dimension[1];
        $allowed_switchLogo = array('png');
        $uploaded_switchLogo_new_name= uniqid().'.'.$uploaded_switchLogo_actual_ext;
                    $uploaded_switchLogo_destination='appdata/logo/switchLogo/'.$uploaded_switchLogo_new_name;
        if($uploaded_switchLogo_error===0){
            if(in_array($uploaded_switchLogo_actual_ext,$allowed_switchLogo)){
                if($uploaded_switchLogo_size<=1000000){
                    if($uploaded_switchLogo_width==128 && $uploaded_switchLogo_height==128){
                         move_uploaded_file($uploaded_switchLogo_tmp_name,$uploaded_switchLogo_destination);
                    }else{
                        $e="Uploaded switchLogo should be of 128 x 128";
                        goBackError($e);
                        exit;
                    }
                }else{
                    $e= 'Your file is too big';
                    goBackError($e);
                    exit;
                }
            }else{
                $e= 'Uploaded logo must be png';
                 goBackError($e);
                 exit;
            }
        }else{
            $e= 'There was an error uploading your switchLogo'.
                goBackError($e);
                exit;
        }  


	    $db->query('INSERT INTO `switchview`(`title`, `code`, `logo`) VALUES (:col_1,:col_2,:col_3)');                
		$db->execute([
			'col_1' => $switchTitle,
			'col_2' => $switchCode,
			'col_3' => $uploaded_switchLogo_destination
		]);

	}
	

	/*----------  Add User  ----------*/

	if(isset($_POST['username'])){
		$username= input_filter($_POST['username']);
		$password= input_filter($_POST['password']);

	    $db->query('INSERT INTO `user`(`username`, `password`, `usertype`) VALUES (:col_1,:col_2,:col_3)');                
		$db->execute([
			'col_1' => $username,
			'col_2' => $password,
			'col_3' => 'user'
		]);

	}
	
	/*=====  End of Form Control  ======*/



	/*=============================================
	=            remove button control            =
	=============================================*/
		
		if(isset($_GET['remove'])){
			$what= input_filter($_GET['remove']);
			$id= input_filter($_GET['id']);
			if($what=='sensor'){
				$db->query('DELETE FROM `sensorview` WHERE `serial`=?');
				$db->execute([$id]);
			}else if($what=='switch'){
				$db->query('DELETE FROM `switchview` WHERE `serial`=?');
				$db->execute([$id]);
			}else if($what=='user'){
				$db->query('DELETE FROM `user` WHERE `id`=?');
				$db->execute([$id]);
			}
		}
	
	
	/*=====  End of remove button control  ======*/
	
	



 ?>

<?php if (isset($_GET['e'])): ?>
	<script>
		alert('<?php echo $_GET['e']; ?>');
	</script>
<?php endif ?>

<?php 
	$header= new Templete('common/header');
	$footer= new Templete('common/footer');
 ?>

<?php echo $header; ?>
	<div class="container pt-2">
		<section id="senosrview">
			<div class="view">
				<div class="title">
					Sensor view settings
				</div>
				<hr>

				<?php 
					$db = new Database();
					$db->query("SELECT * FROM `sensors`");
					$sensors = $db->fetchArrayAll();
				 ?>	

				<form action="<?php echo $_SERVER['PHP_SELF'].'?'; ?>" method="POST" enctype="multipart/form-data" >
				  <div class="row">
				    <div class="col-sm-6">
				      <input required name="sensorTitle" type="text" class="form-control" placeholder="Enter name">
				    </div>
				    <div class="col-sm-6">
				      <input required name="sensorUnit" type="text" class="form-control" placeholder="Unit">
				    </div>
				  
					<br><br>
				  <div class="col-sm-4 ml-3 mr-3">
					  <input required name="sensorLogo" type="file" class="custom-file-input" id="sensorLogo">
					  <label class="custom-file-label" for="sensorLogo">Upload logo</label>
				  </div>


				  <div class="form-group col">
				    <select required name="sensorDevice" class="form-control" id="sensor-device">
				     <?php foreach ($sensors as $key => $value): ?>
				      	<option value="<?php echo $value['id']; ?>">
				      		<?php echo $value['name']; ?>
				      	</option>
			      	<?php endforeach ?>
				    </select>
				  </div>				    
				</div>

				<button class="form-control btn-success" type="submit" value="submit">Add Sensor</button>
				</form>
				<hr>
				<?php 
					$db->query('SELECT * FROM `sensorview`');
					$sensors=$db->fetchAll();
					//print_r($sensors);
				 ?>
				 <div class="h5 text-center">sensors</div>
				<table class="table table-hover table-light text-center">
				  <tbody>
				  	<?php foreach ($sensors as $key => $sensor): ?>
						<tr>
					      <th scope="row"><?php echo $sensor->title ?></th>
					      <?php
					      	 $db->query('SELECT  `name` FROM `sensors` WHERE id=?'); 
					      	 $sensordevice= $db->fetch([$sensor->sensorId])
					      ?>

					      <td><?php echo $sensordevice->name; ?></td>
					      <td class="text-right"><a href="<?php echo $_SERVER['PHP_SELF'].'?remove=sensor&id='.$sensor->serial ?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
					    </tr>
				  	<?php endforeach ?>
				</table>
			</div>
		</section>


		<section id="switchview">
			<div class="view">
				<div class="title">
					Switch view settings
				</div>
				<hr>
				<form action="<?php echo $_SERVER['PHP_SELF'].'?'; ?>" method="POST" enctype="multipart/form-data">
				  <div class="row">
				    <div class="col-sm-3">
				      <input name="switchTitle" type="text" class="form-control" placeholder="Enter name">
				    </div>

				    <div class="col-sm-3">
				      <input name="switchCode" type="text" class="form-control" placeholder="code">
				    </div>
				    
				  <div class="col-sm-4 ml-3 mr-3">
					  <input name="switchLogo" type="file" class="custom-file-input" id="switchLogo">
					  <label class="custom-file-label" for="switchLogo">add logo</label>
				  </div>			    
				</div>
				<br>
				<button class="form-control btn-success" type="submit" value="submit">Add Switch</button>
				</form>
				<hr>
				<?php 
					$db->query('SELECT * FROM `switchview`');
					$switches=$db->fetchAll();
					//print_r($switches);
				 ?>
				 <div class="h5 text-center">Switches</div>
				<table class="table table-hover table-light text-center">
				  <tbody>
				  	<?php foreach ($switches as $key => $switch): ?>
						<tr>
					      <th scope="row"><?php echo $switch->title ?></th>
					      <td><?php echo $switch->code ?></td>
					      <td class="text-right"><a href="<?php echo $_SERVER['PHP_SELF'].'?remove=switch&id='.$switch->serial ?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
					    </tr>
				  	<?php endforeach ?>
				</table>
			</div>
		</section>


		<section id="userview">
			<div class="view">
				<div class="title">
					User settings
				</div>
				<hr>
				<form action="<?php echo $_SERVER['PHP_SELF'].'?'; ?>" method="POST" >
				  <div class="row">
				    <div class="col-sm-4">
				      <input name="username" type="text" class="form-control" placeholder="username">
				    </div>
				    <div class="col-sm-4">
				      <input name="password" type="text" class="form-control" placeholder="password">
				    </div>
				  <br>
				<button class="m-3 form-control btn-success" type="submit" value="submit">Add User</button>
				</div>
			    </form>
			    <hr>

			    <?php 
					$db->query('SELECT * FROM `user` WHERE `usertype` = "user" ');
					$users=$db->fetchAll();
					//print_r($users);
				 ?>
				 <div class="h5 text-center">users</div>
				<table class="table table-hover table-light text-center">
				  <tbody>
				  	<?php foreach ($users as $key => $user): ?>
						<tr>
					      <th scope="row"><?php echo $user->username ?></th>
					      <td class="text-right"><a href="<?php echo $_SERVER['PHP_SELF'].'?remove=user&id='.$user->id ?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
					    </tr>
				  	<?php endforeach ?>
				</table>
			</div>
		</div>
		</section>
		<a href="index.php" class="add-user btn btn-light">
 			<i class="fas fa-door-closed"></i>
 		</a>	
<?php echo $footer; ?>