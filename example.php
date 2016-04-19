<?php

require_once("browser_detection.php");

$browser = Browser_Detection::get_browser($_SERVER['HTTP_USER_AGENT']);
if($browser !== false)
{
	echo "Your browser is $browser <br />";
}

$os = Browser_Detection::get_os($_SERVER['HTTP_USER_AGENT']);

if($os !== false)
{
	echo "Your OS is $os <br />";
}
?>