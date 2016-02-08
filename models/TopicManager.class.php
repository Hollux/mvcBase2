<?php
class TopicManager
{
	private $db;

	public function __construct($db)
	{
		$this -> db = $db;
	}

	public function create($title, $idAuthor, SCategory $SCategory)
	{
		$topic = new Topic($this->db);
		try
		{
			$topic -> setTitle($title);
			$topic -> setIdAuthor($idAuthor);
			$topic -> setSCategory($SCategory);
		}
		catch (Exception $e)
		{
			$errors = $e->getMessage();
		}
		if(!isset($err))
		{
			$title 			= $this -> db -> quote($topic -> getTitle());
			$idAuthor 		= $topic -> getIdAuthor();
			$idSCategory	= $topic -> getidSCategory();

			$query		='INSERT INTO topic(title, id_author, id_scategory)
						VALUE ('.$title.','.$idAuthor.', '.$idSCategory.')';
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
		$id = $topic->getId();
		$query = "DELETE FROM topic WHERE id='".$id."'";
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

	public function update(Topic $topic)
	{
		$id 		= $topic -> getId();
		$title 		= $this -> db -> quote($title -> getTitle());
		$idAuthor 	= $_SESSION['id'];

		$query 		= '	UPDATE topic
						SET title 		='.$title.',
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

	public function getList($idsCat)
	{
		$query = "SELECT * FROM topic WHERE id_scategory = '".$idsCat."'";
		$res 	= $this -> db -> query($query);
		if ($res)
		{
			$topic = $res -> fetchAll(PDO::FETCH_CLASS, 'topic', array($this -> db));
			return $topic;
		}
		else
		{
			throw new Exception('Database error');
		}
	}

	public function getLast()
	{
		$query = "SELECT * FROM topic ORDER BY date DESC LIMIT 1";
		$res 	= $this -> db -> query($query);
		if ($res)
		{
			$topic = $res -> fetchObject('topic', array($this -> db));
			return $topic;
		}
		else
		{
			throw new Exception('Database error');
		}
	}



	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM topic WHERE id='".$id."'";
		$res = $this -> db -> query($query);
		if ($res)
		{
			$topic = $res -> fetchObject('topic', array($this -> db));
			if ($topic)
			{
				return $topic;
			}
			else
			{
				return "Topic not found";
			}
		}
		else
		{
			return "Internal Server Error";
		}
	}

					/*ADD VUE*/
	public function addVue($id)
	{
		$id = intval($id);
		$query 	= "SELECT * FROM topic WHERE id='".$id."'";
		$res 	= $this -> db -> query($query);
		if ($res)
		{
			$topic = $res -> fetchObject('topic', array($this -> db));
			$topicVues = $topic->getVues()+1;
			$query = "UPDATE topic SET vues = '$topicVues' WHERE id='".$id."'";
			$res		= $this -> db -> exec($query);

		if($res)
		{
			/*IL FAUT METTRE QUOI LA DEDANS ??*/
		}
		}
		else
		{
			throw new Exception('Database error');
		}
	}
}

?>