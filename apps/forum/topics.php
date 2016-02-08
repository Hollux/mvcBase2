<?php 
	$topicManager = new TopicManager($db);
	$topics = $topicManager -> getList($_GET['id']);
	$userManager = new UserManager($db);
	$postManager = new PostManager($db);

	$i = 0;
	$c = count($topics);
	while ($i < $c)
	{
		$topic = $topics[$i];
		$link = $userManager -> findLink($_SESSION['id'], $topic->getId());
		$userTopic = $userManager->findById($topic->getIdAuthor());
		$lastPost = $postManager->getLastByTopic($topic->getId());
		if(($lastPost) == TRUE)
		{
			$userLastPost = $userManager->findById($lastPost->getIdAuthor());
			$posts = $postManager->getList($topic->getId());
			$Nrep = count($posts)-1;
		}
		
		require('views/forum/topics.phtml');
		$i++;
	}

?>