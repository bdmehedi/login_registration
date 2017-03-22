<?php
require_once "core/init.php";

//echo Config::get('mysql/password');
$db = DB::getInstance();
//$groups = $db->query("SELECT * FROM users WHERE username = ?", array('mehedi'));
$groups = $db->get('users', array('username', '=', 'mehedi'));
if (!$groups->count()) {
	echo "No groups";
}else {
	echo $db->firstResult()->username;
}
