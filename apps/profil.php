<?php 
	if(isset($_SESSION['id']))
	{
		$userManager = new UserManager($db);
		$user = $userManager->findById($_SESSION['id']);
		require('views/profil.phtml');
	}
	else
	{
		require('views/login.phtml');
	}
 ?>