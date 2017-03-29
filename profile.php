<?php
require_once "core/init.php";

if (!$username = Input::get('user')){
    Redirect::to('index.php');
} else {
    $user = new User($username);
    if (!$user->exists()){
        Redirect::to(404);
    }else{
        $data = $user->data();
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Profile</title>
</head>
<body>
    <h4><?php echo escape($data->username)?></h4>
    <p>Full name is : <?php echo escape($data->name)?></p>
</body>
</html>
