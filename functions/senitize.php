<?php
function escape($string){
	$_string = filter_id($string, FILTER_SANITIZE_STRING);
	$_string = htmlentities($string, ENT_QUOTES, 'UTF-8');
    return $_string;
}

