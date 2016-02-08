<?php 
	$articleManager = new ArticleManager($db);
	$articles = $articleManager -> getList();

	$i = 0;
	$c = count($articles);
	while ($i < $c)
	{
		$article = $articles[$i];
		require('views/articles.phtml');
		$i++;
	}
 ?>