<?php 
if(isset($_POST['content']))
{
	$content	= $_POST['content'];
}
else
{
	$content 		= "";
}

	require('views/forum/addPost.phtml');
 ?>