<?php 
require_once('core/init.php');


if (Input::exists()) {
	if (Token::check(Input::get('token'))) {
		$validate = new Validate();
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
			$user = new User();
			$salt = Hash::salt(32);

			try {

			    $user->create(array(
			            'username' => Input::get('username'),
			            'password' => Hash::make(Input::get('password'), $salt),
			            'salt' => $salt,
			            'name' => Input::get('name'),
			            'joined' => date('Y-m-d h:m:s'),
			            'group' => 1,
                ));

			    Session::flash('home', 'You have been registered and can now login !');
			    Redirect::to(404);

            } catch (Exception $e){
			    die($e->getMessage());
            }
		}else {
			foreach ($validate->errors() as $error) {
				echo $error . '<br>';
			}
		}
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
				<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
			</div><br>
			<div class="field">
				<label for="password">Password</label>
				<input type="password" name="password" id="password">
			</div><br>
			<div class="field">
				<label for="password_again">Repeate Password</label>
				<input type="password" name="password_again" id="password_again">
			</div><br>
			<div class="field">
				<label for="name">Name</label>
				<input type="text" name="name" id="name" value="<?php echo escape(Input::get('name')); ?>" autocomplete="off">
			</div><br>
			<div class="field">
				<input type="hidden" name="token" value="<?php echo Token::generate() ?>">
				<input type="submit" value="Register">
			</div><br>
		</form>
	</fieldset>
</body>
</html>