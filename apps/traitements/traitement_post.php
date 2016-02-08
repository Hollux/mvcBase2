<?php 
if (isset($_GET['page']))
{
	$action = $_GET['page'];

	if($action == 'addPost')
	{
		if (isset($_POST['content']))
		{
			$manager = new TopicManager($db);
			$topic = $manager -> findById($_GET['id']);
			$idTopic = $topic->getId();
			$idScategoryTopic = $topic->getIdSCategory();
			$manager = new SCategoryManager($db);
			$sCategory = $manager -> findById($idScategoryTopic);


			if(isset($idTopic))
			{
				$manager = new PostManager($db);
				$userManager = new UserManager($db);
				$idAuthor = $_SESSION['id'];
				try
				{
					$retour = $manager -> create($_POST['content'], $idAuthor, $topic, $sCategory);
					$retour = $userManager -> addTopicUser($topic);
					header('Location: index.php?page=XtopicX&id='.$topic->getId().'');
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