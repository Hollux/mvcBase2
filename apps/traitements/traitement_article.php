<?php
if (isset($_GET['page']))
{
	$action = $_GET['page'];
var_dump($_GET, $_SESSION, $currentUser, $_POST);
exit;

	if ($action == 'create')
	{
		if (isset($_POST['title'], $_POST['content'], $_POST['image']))
		{
			$manager = new ArticleManager($db);
			$idAuthor = $_SESSION['$id'];
			try
			{
				$retour = $manager->create($_POST['title'], $_POST['content'], $_POST['image'], $idAuthor);
				header('Location: index.php?page=articles');
				exit;
			}
			catch(Exception $e)
			{
				$errors = $e->getMessage();
			}
		}
		if (count($errors) == 0)
		{
			$_SESSION['success'] = "Create successful";
			header('Location: index.php?page=home');
			exit;
		}
	}
	else if ($action == 'update')
	{
		if (isset($_POST['title'], $_POST['content'], $_POST['image']))
		{
			$manager = new ArticleManager($db);
			$article = $manager->findById($_GET['id']);

			if ($article -> getIdAuthor() == $currentUser->getId())
			{
				$id=intval($_GET['id']);
                $article 	-> setTitle($_POST['title']);
                $article 	-> setContent($_POST['content']);
                $article 	-> setImage($_POST['image']);

                $retour 	-> $manager -> update($article)
			}
			else
			{
				$user = $retour;
				header('Location: index.php?page=profil&id='.$user->getId().'');
				exit;
			}

		}

	}
}
?>