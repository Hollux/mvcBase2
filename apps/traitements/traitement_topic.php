<?php 
if (isset($_GET['page']))
{
	$action = $_GET['page'];

	if($action == 'addTopic')
	{
		if (isset($_POST['title'], $_POST['content']))
		{
			$manager = new SCategoryManager($db);
			$sCategory = $manager -> findById($_GET['id']);
			$idSCategory = $sCategory->getId();

			if(isset($idSCategory))
			{
				$managerTopic = new TopicManager($db);
				$idAuthor = $_SESSION['id'];
				try
				{
					$retour = $managerTopic -> create($_POST['title'], $idAuthor, $sCategory);
				}
				catch(Exception $e)
				{
					$errors = $e->getMessage();
				}

				$managerPost = new PostManager($db);
				$lastTopic = $managerTopic -> getLast();
				$lastTopicIdSCategory = $lastTopic->getIdSCategory();
				$manager = new SCategoryManager($db);
				$sCategory = $manager -> findById($lastTopicIdSCategory);
				try
				{
					$retour = $managerPost -> create($_POST['content'], $idAuthor, $lastTopic, $sCategory);

				}
				catch(Exception $e)
				{
					$errors = $e->getMessage();
				}



				$managerUser = new UserManager($db);
				try
				{
					$retour = $managerUser -> addTopicUser($lastTopic);
					header('Location: index.php?page=XtopicX&id='.$lastTopic->getId().'');
					exit;
				}
				catch(Exception $e)
				{
					$errors = $e->getMessage();
				}		
			}
			else
			{
				throw new Exception ("Categorie inéxistance");
			}
		}
	}
	else if ($action == 'updateSCategory')

	/*	A REVOIR*/
	{
		if(isset($_POST['title'], $_POST['content']))
		{
			$manager = new CategoryManager($db);
			$category = $manager -> findById($_GET['id']);
			$idCategory = $category['id'];

			if(isset($idCategory))
			{
				$manager = new SCategoryManager($db);
				$sCategory = $manager -> findById($_GET['id']);

				if($category -> getIdAuthor() == $currentUser -> getId())
				{
					$id = intval($_GET['id']);
					$sCategory 	-> setTitle($_POST['title']);
					$sCategory 	-> setContent($_POST['content']);

					$retour 	-> $manager -> update ($sCategory);
				}
				else
				{
					$user = $retour;
					header('Location : index.php?page=home');
					exit;
				}
			}
		}
	}
}



 ?>