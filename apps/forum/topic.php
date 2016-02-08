<?php 
	
	$topicManager = new TopicManager($db);
	$topic = $topicManager -> findById($_GET['id']);
	$userManager = new UserManager($db);
	$userTopic = $userManager->findById($topic->getIdAuthor());
	try
	{
		$test = $topicManager->addVue($topic->getId());
		$link = $userManager->deletLink($_SESSION['id'], $topic->getId());
	}
	catch(Exception $e)
	{
		$errors = $e->getMessage();
		echo($errors);
	}

	require("views/forum/topic.phtml");
 ?>