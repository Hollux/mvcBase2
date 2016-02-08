<?php 
if(isset($_POST['title']))
{
	$title	= $_POST['title'];
}
else
{
	$title 		= "";
}
if(isset($_POST['content']))
{
	$content	= $_POST['content'];
}
else
{
	$content 		= "";
}

	require('views/forum/addTopic.phtml');
 ?>