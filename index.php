<?php
require_once "core/init.php";

//echo Config::get('mysql/password');
$insertSuccess = DB::getInstance()->insert('groups', array(
	'name' => 'Monirul',
	'permissions' => '{"admin": 1}'
	));

if ($insertSuccess) {
	echo "Success !";
}else {
	echo "Faild !";
}
