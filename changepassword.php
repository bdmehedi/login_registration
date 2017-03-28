<?php
require_once "core/init.php";

$user = new User();

if (!$user->isLoggedIn()){
    Redirect::to('index.php');
}

if (Input::exists()){
    if (Token::check(Input::get('token'))){

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'password_corrent' => array(
                'required' => true,
                'min' => 6,
            ),
            'password_new' => array(
                'required' => true,
                'min' => 6
            ),
            'password_new_again' => array(
                'required' => true,
                'min' => 6,
                'matches' => 'password_new'
            ),
        ));

        if ($validation->passed()){

            if (Hash::make(Input::get('password_corrent'), $user->data()->salt) !== $user->data()->password){
                echo "Your corrent password is wrong !.";
            } else {
                $salt = Hash::salt(32);
                $user->update(array(
                    'password' => Hash::make(Input::get('password_new'), $salt),
                    'salt' => $salt
                ));

                Session::flash('home', 'Your password has been change!');
                Redirect::to('index.php');
            }

        }else{
            foreach ($validation->errors() as $error){
                echo $error, '<br>';
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
            <label for="password_corrent">Current Password</label>
            <input type="password" name="password_corrent" id="password_corrent">
        </div><br>
        <div class="field">
            <label for="password_new">New Password</label>
            <input type="password" name="password_new" id="password_new">
        </div><br>
        <div class="field">
            <label for="password_new_again">New Password again</label>
            <input type="password" name="password_new_again" id="password_new_again">
        </div><br>
        <div class="field">
            <input type="hidden" name="token" value="<?php echo Token::generate() ?>">
            <input type="submit" value="Change">
        </div><br>
    </form>
</fieldset>
</body>
</html>
