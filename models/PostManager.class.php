<?php

/*PAS FAIS*/
class PostManager
{
	private $db;

	public function __construct($db)
	{
		$this -> db = $db;
	}

	public function create($content, $idAuthor, Topic $Topic, SCategory $SCategory)
	{
		$post = new Post($this->db);
		try
		{
			$post -> setContent($content);
			$post -> setIdAuthor($idAuthor);
			$post -> setTopic($Topic);
			$post -> setSCategory($SCategory);
		}
		catch (Exception $e)
		{
			$errors = $e->getMessage();
			echo($errors);
		}
		if(!isset($err))
		{

			$content 	= $this -> db -> quote($post -> getContent());
			$idAuthor 	= $post -> getIdAuthor();
			$idTopic	= $post -> getIdTopic();
			$idSCategory= $post -> getIdSCategory();

			$query		='INSERT INTO post(content, id_author, id_topic, id_sCategory)
						VALUE ('.$content.','.$idAuthor.', '.$idTopic.', '.$idSCategory.')';
 		}
 		$res			=$this -> db -> exec($query);
 		if($res)
 		{
 			$id = $this -> db -> lastInsertId();

 			if($id)
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
 			throw new Exception($errors);
 		}
	}

	public function delete(SCategory $cate)
	{
		$id = $sCategory->getId();
		$query = "DELETE FROM post WHERE id='".$id."'";
		$res = $this -> db -> exec($query);
		if ($res)
		{
			return true;
		}
		else
		{
			throw new Exception("Internal Server Error");
		}
	}

	public function update(Post $post)
	{
		$id 		= $post -> getId();
		$content 	= $this -> db -> quote($content -> getContent());
		$idAuthor 	= $_SESSION['id'];

		$query 		= '	UPDATE post
						SET content 	='.$content.',
							$idAuthor 	='.$idAuthor.'
						WHERE id='.$id;
		$res		= $this -> db -> exec($query);

		if($res)
		{
			$id = $this -> db -> lastInsertId();

			if($id)
			{
				return $this -> findById($id);
			}
			else
			{
				throw new Exception('Internal server Error');
			}
		}
	}

	public function getList($idTop)
	{
		$query	= "SELECT * FROM post WHERE id_topic = ".$idTop."";
		$res	= $this -> db -> query($query);
		var_dump($query, $res, $idTop);
		if ($res)
		{
			$post = $res -> fetchAll(PDO::FETCH_CLASS, 'post', array($this -> db));
			/*$post = $res -> fetchObject('post', array($this -> db));*/
			return $post;
		}
		else
		{
			$error = '';
			try
			{
				throw new Exception("Database error");
			}
			catch (Exception $exception)
			{
				$error = $exception->getMessage();
			}
			if ($error !== '')
			{
				echo $error;
			}
		}
	}

	public function getListSCat($idsCat)
	{
		$query = "SELECT * FROM post WHERE id_sCategory = '".$idsCat."'";
		$res 	= $this -> db -> query($query);
		if ($res)
		{
			$post = $res -> fetchAll(PDO::FETCH_CLASS, 'post', array($this -> db));
			/*$post = $res -> fetchObject('post', array($this -> db));*/
			return $post;
		}
		else
		{
			throw new Exception('Database error');
		}
	}

	public function getListUser($idUser)
	{
		$query = "SELECT * FROM post WHERE id_author = '".$idUser."'";
		$res 	= $this -> db -> query($query);
		if ($res)
		{
			$post = $res -> fetchAll(PDO::FETCH_CLASS, 'post', array($this -> db));
			/*$post = $res -> fetchObject('post', array($this -> db));*/
			return $post;
		}
		else
		{
			throw new Exception('Database error');
		}
	}

	public function getLasts()
	{
		$query = "SELECT * FROM post ORDER BY date DESC LIMIT 20";
		$res 	= $this -> db -> query($query);
		if ($res)
		{
			$post = $res -> fetchObject('post', array($this -> db));
			return $post;
		}
		else
		{
			throw new Exception('Database error');
		}
	}

	public function getLastByTopic($idTopic)
	{
		$query = "SELECT * FROM post WHERE id_topic = '".$idTopic."' ORDER BY date DESC LIMIT 1";
		$res 	= $this -> db -> query($query);
		if ($res)
		{
			$post = $res -> fetchObject('post', array($this -> db));
			return $post;
		}
		else
		{
			throw new Exception('Database error');
		}
	}

	public function getLastBySCat($idSCat)
	{
		$query = "SELECT * FROM post WHERE id_sCategory = '".$idSCat."' ORDER BY date DESC LIMIT 1";
		$res 	= $this -> db -> query($query);
		if ($res)
		{
			$post = $res -> fetchObject('post', array($this -> db));
			return $post;
		}
		else
		{
			throw new Exception('Database error');
		}
	}

	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM post WHERE id='".$id."'";
		$res = $this -> db -> query($query);
		if ($res)
		{
			$post = $res -> fetchObject('post', array($this -> db));
			if ($post)
			{
				return $post;
			}
			else
			{
				return "Post not found";
			}
		}
		else
		{
			return "Internal Server Error";
		}
	}
}

?>