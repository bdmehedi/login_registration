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
            'name' => array(
                'required' => true,
                'min' => 2,
                'max' => 50
            )
        ));

        if ($validation->passed()){

            try {

                $user->update(array(
                    'name' => Input::get('name')
                ));

                Session::flash('home', 'Your details have been updated.');
                Redirect::to('index.php');

            } catch (Exception $e) {
                die($e->getMessage());
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
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo escape($user->data()->name); ?>" autocomplete="off">
        </div><br>
        <div class="field">
            <input type="hidden" name="token" value="<?php echo Token::generate() ?>">
            <input type="submit" value="Update">
        </div><br>
        <div class="field">
            <a href="index.php">Home</a>
        </div>
    </form>
</fieldset>
</body>
</html>
