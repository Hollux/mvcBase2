<?php 
if (isset($_GET['page']))
{
	$action = $_GET['page'];

	if($action == 'addCategory')
	{
		if (isset($_POST['title'], $_POST['content']))
		{
			$manager = new CategoryManager($db);
			$idAuthor = $_SESSION['id'];
			try
			{
				$retour = $manager -> create($_POST['title'], $_POST['content'], $idAuthor);
				header('Location: index.php?page=XcategorysX');
				exit;
			}
			catch(Exception $e)
			{
				$errors = $e->getMessage();
			}
		}
	}
	else if ($action == 'updateCategory')
	{
		if(isset($_POST['title'], $_POST['content']))
		{
			$manager = new ArticleManager($db);
			$category = $manager -> findById($_GET['id']);

			if($category -> getIdAuthor() == $currentUser -> getId())
			{
				$id = intval($_GET['id']);
				$category 	-> setTitle($_POST['title']);
				$category 	-> setContent($_POST['content']);

				$retour 	-> $manager -> update ($category);
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



 ?>