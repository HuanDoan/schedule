<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <title>Login</title>

	    <link rel="stylesheet" href="<?= base_url()?>assets/admin/css/login.css">
	    <link rel="stylesheet" href="<?= base_url()?>assets/admin/css/font-awesome.min.css">
	</head>

	<body>

		<div id="login">
			<?php if($this->session->err_msg != ''): ?>
			<div class="err">
				<span><strong>Error!</strong></span>
				<span><?= $this->session->err_msg;?></span>
			</div>
			<?php endif; ?>
	      	<form name='form-login' method="post" action="<?=base_url()?>admin/login/submit">
		        <span class="fa fa-user"></span>
		        <input type="text" name="username" placeholder="Username">
		       
		        <span class="fa fa-lock"></span>
		        <input type="password" name="password" placeholder="Password">
		        
		        <input type="submit" value="Login">

			</form>
	</body>
</html>