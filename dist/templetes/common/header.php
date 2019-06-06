<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo SITE_TITLE; ?></title></title>
	<meta charset="UTF-8">
	<meta charset="UFT-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
	<link rel="stylesheet" href="css/style.css?<?php echo date('l jS \of F Y h:i:s A'); ?>">
</head>
<body>
	<header class="bg-dark text-light p-2 d-flex justify-content-between fixed-top">
			<?php if (isset($_SESSION['user'])): ?>
			<?php extract($_SESSION['user']); ?>
		<div class="h5 m-1">
			<?php echo SITE_CODE ?> /
			<span class="badge badge-info">
				<?php 
				if($usertype=='admin')
					echo "Admin";
				else
					echo "User";
				?>
			</span>
		</div>
		<div><a href='logut.php'class="btn-danger btn">
			<i class="fas fa-sign-out-alt"></i>
		</a></div>
		<?php else: ?>
		<div class="h5 m-1">
			<?php echo SITE_TITLE ?>
		</div>
		<?php endif; ?>	
	</header>