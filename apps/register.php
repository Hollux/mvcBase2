<?php
if(isset($_POST['login']))
{
	$login	= $_POST['login'];
}
else
{
	$login 		= "";
}
if(isset($_POST['email']))
{
	$email	= $_POST['email'];
}
else
{
	$email 		= "";
}
if(isset($_POST['avatar']))
{
	$avatar	= $_POST['avatar'];
}
else
{
	$avatar 		= "";
}
require('views/register.phtml');
?>