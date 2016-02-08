<?php 
	$categoryManager = new CategoryManager($db);
	$category = $categoryManager -> findById($_GET['id']);
	$userManager = new UserManager($db);
	$userCategory = $userManager->findById($category->idAuthor);
	
	require('views/forum/category.phtml');
?>
	