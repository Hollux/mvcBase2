<?php 
if (isset($_GET['page']))
{
	$action = $_GET['page'];

	if($action == 'addSCategory')
	{
		if (isset($_POST['title'], $_POST['content']))
		{
			$manager = new CategoryManager($db);
			$category = $manager -> findById($_GET['id']);
			$idCategory = $category->getId();

			if(isset($idCategory))
			{
				$manager = new SCategoryManager($db);
				$idAuthor = $_SESSION['id'];
				try
				{
					$retour = $manager -> create($_POST['title'], $_POST['content'], $idAuthor, $category);
					header('Location: index.php?page=XcategoryX&id="'.$_GET['id'].'"');
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