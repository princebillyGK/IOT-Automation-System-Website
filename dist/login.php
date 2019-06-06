<?php session_start(); ?>
<?php include 'config/init.php'; ?>
<?php 
	$header= new Templete('common/header');
	$footer= new Templete('common/footer');
 ?>
 <?php echo $header ?>
	<div id="login-form" class="container p-3">
	<?php if (isset($_SESSION['loginErr'])): ?>
		<div class="alert alert-danger" role="alert">
		  <i class="fas fa-exclamation-triangle"></i> The username or password is wrong
		</div>
		<?php unset($_SESSION['loginErr']); ?>
	<?php endif ?>
	<form action="auth.php" method='POST'>
	  <div class="form-group">
	    <label for="username">Username</label>
	    <input name="username" type="text" class="form-control" id="username" aria-describedby="username help" placeholder="Enter username" required="required">
	    <small id="username help" class="form-text text-muted">Please input a valid user name</small>
	  </div>
	  <div class="form-group">
	    <label for="exampleInputPassword1">Password</label>
	    <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required="required">
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>	
 <?php echo $footer ?>