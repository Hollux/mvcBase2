<?php

// SESSION
session_start();
$errors = "";

// DATABASE
try
{
	$db = new PDO('mysql:dbname=mvcbase;host=localhost', 'root', ''/*'id', 'mdp', 'nomDB'*/);
}
catch(Exception $e)
{
	die('DB error');
}

// AUTOLOAD OBJECTS (evite le require)
spl_autoload_register(function($class)
{
	require('models/'.$class.'.class.php');
});


// Mise en place $currentUser
if (isset($_SESSION['id']))
{
	$userManager = new UserManager($db);
	$currentUser = $userManager -> getCurrent();
		
}

// autorisation pages
$access_public 	= array('home', 'rien', 'register', 'login');
$access_user 	= array('home','rien', 'logout', 'addArticle', 'articles', 'profil', 'addCategory', 'addCategory');
$access_admin	= array('', '', '');

// fichier traitement
$traitements_public 	= array('login' 		=> 'user',
								'register'		=> 'user',
								'addArticle'	=> 'article');
$traitements_user 		= array('addArticle'	=> 'article',
								'addCategory'	=> 'category');
$traitements_admin		= array('dashboard_users' 		=> 'user',
							'dashboard_items' 			=> 'item',
							'dashboard_order' 			=> 'order',
							'dashboard_categories' 		=> 'category');
// REVOIR ELEMENT
$access_ids 		= array();

if (isset($_GET['page']))
{
	// LOGOUT
	if ($_GET['page'] === 'logout')
	{
		session_destroy();
		$_SESSION = array();
		header('Location: ?page=home');
		exit;
	}

	// page Public
	if (in_array($_GET['page'], $access_public) && !isset($_SESSION['id']))
	{
		$page = $_GET['page'];

		if (isset($traitements_public[$_GET['page']]) && !empty($_POST))
		{
		var_dump($_POST);
			require('apps/traitements/traitement_'.$traitements_public[$_GET['page']].'.php');
		}
	}

	// page Log
	else if (in_array($_GET['page'], $access_user) && isset($_SESSION['id']))
	{
		if (in_array($_GET['page'], $access_ids))
		{
			if (isset($_GET['id']))
			{
				$page = $_GET['page'];
			}
			else
			{
				header('Location: ?page=home');
				exit;
			}
		}
		else
		{
			$page = $_GET['page'];
		}
		if (isset($traitement_user[$_GET['page']]) && !empty($_POST))
		{
			require('apps/traitements/traitement_'.$traitements_user[$_GET['page']].'.php');
		}
	}

	// page Admin
	else if (in_array($_GET['page'], $access_admin) && isset($_SESSION['id']) && ($currentUser -> getStatus()) > 0)
	{
		$page = $_GET['page'];

		if (isset($traitements_admin[$_GET['page']]) && !empty($_POST))
		{
			require('apps/traitements/traitement_'.$traitments_admin[$_GET['page']].'.php');
		}
	}


	// page de base
	else
	{
		header('Location: ?page=home');
		exit;
	}
}
else
{
	$page = 'home';
}


require('apps/skel.php');

// A REVOIR
/* TURN OFF SESSION SUCCESS*/
$_SESSION['success'] = "";
?>