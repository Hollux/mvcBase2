<?php 
	$sCategoryManager = new SCategoryManager($db);
	$sCategory = $sCategoryManager -> findById($_GET['id']);
	$userManager = new UserManager($db);
	$userSCategory = $userManager->findById($sCategory->getIdAuthor());

	require('views/forum/sCategory.phtml');
?>
	