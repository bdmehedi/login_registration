<?php
require_once "core/init.php";

if (Session::exists('home')){
    echo '<p>'.Session::flash('home').'</p>';
}


$user = new User();
if ($user->isLoggedIn()){
?>

    <p>Hello <a href="#"><?php echo $user->data()->username; ?></a></p>

    <ul>
        <li><a href="logout.php">Log out</a></li> <br>
        <li><a href="update.php">Update</a></li>
        <li><a href="changepassword.php">Change Password</a></li>
    </ul>

<?php

if ($user->hasPermission('admin')) {
	echo "You are Administrator !";
}

}else{
?>

    <p>You need to <a href="login.php">login</a> or <a href="register.php">register</a></p>

<?php
}
