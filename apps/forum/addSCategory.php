<?php 
$title 		= "";
if(isset($_POST['title']))
{
	$title = $_POST['title'];
}
$content	= "";
if(isset($_POST['content']))
{
	$content = $_POST['content'];
}

	require('views/forum/addSCategory.phtml');
 ?>