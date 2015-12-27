<?php
class User
{
	private $id;
	private $login;
	private $password;
	private $email;
	private $avatar;
	private $date;
	private $last_date;
	private $date_registration;
	private $db;

	//Construct
	public function __construct($db)
	{
		$this -> db = $db;
		
	}

	// Getters
	public function getId()
	{
		return $this->id;
	}
	public function getLogin()
	{
		return $this->login;
	}
	public function getPassword()
	{
		return $this->password;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function getAvatar()
	{
		return $this->avatar;
	}
	public function getDate()
	{
		return $this->date;
	}
	public function getLastDate()
	{
		return $this->last_date;
	}
	public function getDateRegistration()
	{
		return $this -> date_registration;
	}

	public function setLogin($login)
	{
/*		$userManager = new userManager();
		$user=$userManager->findByLogin($login);
var_dump($userManager, $user, $login);
exit;*/
		/*if(!isset($user))
		{*/
			if (strlen($login) > 3 && strlen($login) < 32)
			{
				$this->login = $login;
				return true;
			}
			else
			{
				throw new Exception("Login incorrect (4 /31 characters)");
			}
		/*}
		else
		{
			throw new Exception('Login déjà utilisé');
		}*/
	}
	public function setEmail($email)
	{
		if (strlen($email) > 3 && strlen($email) < 52)
		{
			if (preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,5}$#", $email))
			{
				$this ->email = $email;
				return true;
			}
			else
			{
				throw new Exception('Email format invalide');
			}
		}
		else
		{
			throw new Ecveption ("Email incorrect");
		}
	}

	public function editPassword($password1, $password2)
	{
		if (strlen($password) > 5)
		{
			if ($password1 == $password2)
			{
				$this->password = password_hash($password1, PASSWORD_BCRYPT, array("cost"=>10));
				return true;
			}
			else
			{
				throw new Exception("Les mots de passe ne correspondent pas");
			}
		}
		else
		{
			throw new Exception("Password trop court");
		}
	}


	public function setPassword($password1, $password2)
	{
		if (strlen($password1) > 5)
		{
			if ($password1 == $password2)
			{
				$this->password = password_hash($password1, PASSWORD_BCRYPT, array("cost"=>10));
				return true;
			}
			else
			{
				throw new Exception('Les mots de passe ne correspondent pas');
			}
		}
		else
		{
			throw new Exception("Mot de passe trop court");
		}
	}

	public function verifPassword($password)
	{
		return (password_verify($password, $this->password));
	}

	public function setAvatar($avatar)
	{
		if($avatar !== "")
		{
			if (filter_var($avatar, FILTER_VALIDATE_URL))
			{
				$this->avatar = $avatar;
				return true;
			}
			else
			{
				throw new Exception("URL incorrecte");
			}
		}
	}
	// Set date derniere co
	public function setDateConnection($date)
	{
		if (ctype_digit($date))
		{
			$this -> date_connection = $date;
			return true;
		}
		else
		{
			throw new Exception('Format needs to be a timestamp');
		}
	}
}

?>