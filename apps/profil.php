<?php 
	if(isset($_GET['id']))
	{
		$id = intval($_GET['id']);
		$userManager = new UserManager($db);
		$user = $userManager->findById($id);
		require('views/profil.phtml');
	}
	else
	{
		require('views/login.phtml');
	}
 ?>