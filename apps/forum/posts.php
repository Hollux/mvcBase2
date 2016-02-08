<?php 
	$postManager = new PostManager($db);
	$posts = $postManager -> getList($_GET['id']);
	$userManager = new UserManager($db);

	$i = 0;
	$c = count($posts);
	while ($i < $c)
	{
		$post = $posts[$i];
		$postUser = $postManager -> getListUser($post->getIdAuthor());
		$NpostUser = count($postUser);
		$userPost = $userManager->findById($post->getIdAuthor());
		require('views/forum/posts.phtml');
		$i++;
	}
 ?>