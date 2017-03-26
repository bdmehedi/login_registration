<?php 
require_once('core/init.php');
if (Input::exists()) {
	$validate = new Validation();
	$validation = $validate->check($_POST, array(
		'username' => array(
			'required' => true,
			'min' => 2,
			'max' => 20,
			'unique' => 'users'
			),
		'password' => array(
			'required' => true,
			'min' => 6
			),
		'password_again' => array(
			'required' => true,
			'matches' => 'password'
			),
		'name' => array(
			'required' => true,
			'min' => 2,
			'max' => 50
			)
		));

	if ($validate->passed()) {
		# register user.
	}else {
		# output errors........
	}
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register | Page</title>
	<style type="text/css">
		fieldset{
			width: 600px;
			margin: 80px auto;
		}
	</style>
</head>
<body>
	<fieldset>
		<legend>Register From</legend>
		<form action="" method="post">
			<div class="field">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" value="" autocomplete="off">
			</div><br>
			<div class="field">
				<label for="password">Password</label>
				<input type="password" name="password" id="password">
			</div><br>
			<div class="field">
				<label for="password_again">Repeate Password</label>
				<input type="password_again" name="password_again" id="password_again">
			</div><br>
			<div class="field">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" value="" autocomplete="off">
			</div><br>
			<div class="field">
				<input type="submit" value="Register">
			</div><br>
		</form>
	</fieldset>
</body>
</html>