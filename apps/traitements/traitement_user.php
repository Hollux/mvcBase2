<?php
if (isset($_GET['page']))
{
	$action = $_GET['page'];

	if ($action == 'login')
	{
		if (isset($_POST['login'], $_POST['password']))
		{
			$userManager = new UserManager($db);
			try
			{
				$user= $userManager->findByLogin($_POST['login']);
			}
			catch (Exception $e)
			{
				$errors = $e -> getMessage();
			}
			if($errors == "")
			{
				if ($user->verifPassword($_POST['password']))
				{
					$_SESSION['id'] 	= $user->getId();
					$_SESSION['succes']	="Login succesfull";
					try
					{
						$user -> setDateConnection(time());
						$userManager -> update($user);
					}
					catch (Exception $e)
					{
						$_SESSION['success']= "Welcome back";
						header('Location: index.php');
						exit;
					}
				}
				else
				{
					$errors[] = 'Incorrect Password';
					/*$email 	= $_POST['email'];*/
				}
			}
			else
			{
				/*$email 	= $_POST['email'];*/
			}
		}
	}
	else if ($action == 'register')
	{
		if (isset($_POST['login'], $_POST['password1'], $_POST['password2'], $_POST['email'], $_POST['avatar']))
		{
			$manager = new UserManager($db);
			try
			{
				$retour = $manager->create($_POST['login'], $_POST['password1'], $_POST['password2'], $_POST['email'], $_POST['avatar']);
			}
			catch(Exception $e)
			{
				$errors = $e->getMessage();
			}
		}
		if (count($errors) == 0)
		{
			$_SESSION['success'] = "Registration successful";
			header('Location: ?page=login');
			exit;
		}
	}
	else if ($action == 'logout')
	{
		session_destroy();
		$_SESSION = array();
		header('Location: index.php');
		exit;
	}
	else if ($action == 'edit_profil')
	{
		if (isset($_POST['login'], $_POST['email'], $_POST['password1'], $_POST['password2'], $_POST['avatar']))
		{
			$manager = new UserManager($db);
			$currentUser->setLogin($_POST['login']);
			$currentUser->setEmail($_POST['email']);
			$currentUser->setPassword($_POST['password1'], $_POST['password2']);
			$currentUser->setAvatar($_POST['avatar']);
			$retour = $manager->update($currentUser);

			if(is_string($retour))
                {
                    $errors[] = $retour;
                }
                else
                {
                    header('Location: index.php?page=article&id='.$_GET['id'].'');
                    exit;
                }

		}

	}
}
?>