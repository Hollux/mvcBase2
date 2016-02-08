<?php 
	$sCategoryManager = new SCategoryManager($db);
	$sCategorys = $sCategoryManager -> getList($category->getId());
	$topicManager = new TopicManager($db);
	$postManager = new PostManager($db);


	$a = 0;
	$b = count($sCategorys);
	while ($a < $b)
	{
		$sCategory = $sCategorys[$a];
		$topic = $topicManager -> getList($sCategory->getId());
		$nTopic = count($topic);
		$post = $postManager -> getListSCat($sCategory->getId());
		$nPost = count($post);
		
		if($nPost !== 0)
		{
			$lastPost = $postManager->getLastBySCat($sCategory->getId());
			$userLastPost = $userManager->findById($lastPost->getIdAuthor());
		}

		require('views/forum/sCategorys.phtml');
		$a++;
	}

?>