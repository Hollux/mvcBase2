<?php
class UserManager
{
	private $db;

	public function __construct($db)
	{
		$this -> db = $db;
	}

	public function create($login, $password1, $password2, $email, $public, $avatar)
	{
		$user = new User($this->db);
		try
		{
			$user -> setLogin($login);
			$user -> setEmail($email);
			$user -> setPublic($public);
			$user -> setAvatar($avatar);
			$user -> setPassword($password1, $password2);
		}
		catch (Exception $e)
		{
			$errors = $e->getMessage();
		}

		if(!isset($errors))
		{
			$email 		= $this -> db -> quote($user -> getEmail());
			$login 		= $this -> db -> quote($user -> getLogin());
			$password 	= $user -> getPassword();
			if($avatar == "")
			{
				$query		= '	INSERT INTO user (email, public, login, password)
							VALUES ('.$email.','.$public.' '.$login.',"'.$password.'")';
			}
			else
			{
				$avatar 	= $this -> db -> quote($user -> getAvatar());
				$query		= '	INSERT INTO user (email, public, login, avatar, password)
							VALUES ('.$email.','.$public.' '.$login.','.$avatar.',"'.$password.'")';
			}
			$res		= $this -> db -> exec($query);
			if ($res)
			{
				$id = $this -> db -> lastInsertId();

				if ($id)
				{
					return $this -> findById($id);
				}
				else
				{
					throw new Exception('Database error');
				}
			}
			else
			{
				throw new Exception('User allready used');
			}
		}
		else
		{
			throw new Exception($errors);
		}
	}

	public function delete(User $user)
	{
		$id 	= intval($user -> getId());
		$query 	= "DELETE FROM user WHERE id='".$id."'";
		$res 	= $this -> db -> exec($query);
		if ($res)
		{
			return true;
		}
		else
		{
			throw new Exception("Internal Server Error");
		}
	}

	public function update(User $user)
	{
		$id 		= $user->getId();
		$login 		= $this->db->quote($user->getLogin());
		$password 	= $this->db->quote($user->getPassword());
		$email 		= $this->db->quote($user->getEmail());
		$avatar 	= $this->db->quote($user->getAvatar());
		$query 		= "UPDATE	 user 
						SET 	login		='".$login."', 
								password	='".$password."',
								email		='".$email."', 
								avatar		='".$avatar."' 
								WHERE id	='".$id."'";
		$res 		= $this -> db -> exec($query);
		if ($res)
		{
			return $this->findById($id);
		}
		else
		{
			throw new Exception( "Internal Server Error");
		}
	}
	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM user WHERE id='".$id."'";
		$res = $this -> db -> query($query);
		if ($res)
		{
			$user = $res -> fetchObject('User', array($this -> db));
			if ($user)
			{
				return $user;
			}
			else
			{
				return "User not found";
			}
		}
		else
		{
			return "Internal Server Error";
		}
	}
	public function getLast()
	{
		$query = "SELECT * FROM user WHERE (UNIX_TIMESTAMP()-UNIX_TIMESTAMP(last))<3 ORDER BY login";
		$res = $this->db->query($query);
		$listUser = array();
		while ($users = $res -> fetchAll(PDO::FETCH_CLASS, 'User', array($this -> db)));
		{
			$listUser[] = $user;
		}
		return $listUser;
	}
	public function getLastDate()
	{
		if(isset($_SESSION['login']))
		{
			/*$mysql_last_date = mysqli_query("SELECT last_date FROM user WHERE login=".$_SESSION['login']); 
			$reponse_date = mysqli_fetch_assoc($mysql_last_date); 
			$_SESSION["last_date"] = $reponse_date["last_date"]; 
			mysqli_query("UPDATE user SET last_date='".date("U")."' WHERE login=".$_SESSION['login']); */
		}
	}
	public function findByLogin($login)
	{
		if (strlen(trim($login)) > 0)
		{
			$login 	= $this -> db -> quote($login);
			$query 	= 'SELECT * FROM user WHERE login='.$login.'';
			$res 	= $this -> db -> query($query);
			if ($res)
			{
				$user = $res -> fetchObject("User", array($this -> db));
				if ($user) {
					return $user;
				}					
				else
					throw new Exception("User not found");
			}
			else
			{
				throw new Exception("Internal Server Error");
			}
		}
		else
		{
			throw new Exception("User not found");
		}
	}
	public function getCurrent()
	{
		if (isset($_SESSION['id']))
		{
			$query = "SELECT * FROM user WHERE id='".$_SESSION['id']."'";
			$res = $this -> db -> query($query);
			if ($res)
			{
				$user = $res -> fetchObject("User", array($this->db));
				if ($user)
				{
					return $user;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	/*FORUM*//*FORUM*//*FORUM*//*FORUM*//*FORUM*//*FORUM*//*FORUM*//*FORUM*//*FORUM*//*FORUM*//*FORUM*/

						/*PARTIE AJOUT USER*/
	public function addTopicUser(Topic $topic)
	{

		$query = "SELECT id FROM user";
		$res = $this -> db -> query($query);
		if ($res)
		{
			$users = $res -> fetchALL(PDO::FETCH_CLASS, 'User', array($this -> db));
			if($users)
			{
				$i = 0;
				$c = count($users);
				while($i < $c)
				{
					$user = $users[$i];
					$idUser = $user->getId();
					$idTopic = $topic->getId();

					$query = "SELECT COUNT(id_user) FROM link_user_topic 
						WHERE id_user=".$idUser." AND id_topic= ".$idTopic."";
					$res2 = $this -> db -> query($query);
					if($res2 == true)
					{
						$i++;
					}
					else
					{
						$query = 'INSERT INTO link_user_topic (id_user, id_topic)
								VALUES ('.$idUser.','.$idTopic.')';
						$res3 = $this -> db -> query($query);
						if($res3)
						{
							$i++;
						}
						else
						{
							$o = $i;
							$i = $c;
							throw new Exception('error DB ('.$o.','.$query.')');
						}
					}
				}
			}
			else
			{
				throw new Exception('bug bug bug');
			}
		}
	}

	public function findLink($idUser, $idTopic)
	{
		$query = "SELECT * FROM link_user_topic 
			WHERE id_user=".$idUser." AND id_topic= ".$idTopic."";
		$res = $this -> db -> query($query);
		if($res)
		{
			$link = $res -> fetchAll();
			if($link)
			{
				return $this;
			}
			else
			{
				return false;
			}
		}
		else
		{
			throw new Exception ('error findLink');
		}
	}

	public function deletLink($idUser, $idTopic)
	{
		$query = "SELECT COUNT(id_user) FROM link_user_topic 
			WHERE id_user=".$idUser." AND id_topic= ".$idTopic."";
		$res = $this -> db -> exec($query);
		var_dump($res);
		echo('<br>');
		/*if($res == 0)
		{
			echo('toto');
		}*/
		/*else
		{
			$query 	= "DELETE FROM link_user_topic WHERE id_user=".$idUser." AND id_topic=".$idTopic."";
			$res 	= $this -> db -> exec($query);
			if ($res)
			{
				return true;
			}
			else
			{
				throw new Exception("Internal Server Error");
			}
		}*/
	}

}
?>