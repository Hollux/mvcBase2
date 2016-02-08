<?php 
	$categoryManager = new CategoryManager($db);
	$categorys = $categoryManager -> getList();
	$userManager = new UserManager($db);

	$i = 0;
	$c = count($categorys);
	while ($i < $c)
	{
		$category = $categorys[$i];
		$userCategory = $userManager->findById($category->idAuthor);
		require('views/forum/categorys.phtml');
		$i++;
	}
 ?>