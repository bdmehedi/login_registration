<?php
require_once "core/init.php";
//unset($_SESSION['user']);
if (Input::exists()){
    if (Token::check(Input::get('token'))){

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true)
        ));

        if ($validate->passed()){
            $user = new User();

            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('username'), Input::get('password'), $remember);
            
            if ($login){
                Redirect::to('index.php');
            }else{
                echo "Something going wrong.";
            }
        }else{
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
            <label for="remember">Remember me</label>
            <input type="checkbox" name="remember" id="remember">
        </div><br>
        <div class="field">
            <input type="hidden" name="token" value="<?php echo Token::generate() ?>">
            <input type="submit" value="Login">
        </div><br>
    </form>
</fieldset>
</body>
</html>