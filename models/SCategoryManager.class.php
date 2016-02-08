<?php
class SCategoryManager
{
	private $db;

	public function __construct($db)
	{
		$this -> db = $db;
	}

	public function create($title, $content, $idAuthor, Category $Category)
	{
		$sCategory = new SCategory($this->db);
		try
		{
			$sCategory -> setTitle($title);
			$sCategory -> setContent($content);
			$sCategory -> setIdAuthor($idAuthor);
			$sCategory -> setCategory($Category);
		}
		catch (Exception $e)
		{
			$errors = $e->getMessage();
		}
		if(!isset($err))
		{
			$title 		= $this -> db -> quote($sCategory -> getTitle());
			$content 	= $this -> db -> quote($sCategory -> getContent());
			$idAuthor 	= $sCategory -> getIdAuthor();
			$idCategory	= $sCategory -> getidCategory();

			$query		='INSERT INTO scategory(title, content, id_author, id_category)
						VALUE ('.$title.','.$content.','.$idAuthor.', '.$idCategory.')';
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
		$query = "DELETE FROM scategory WHERE id='".$id."'";
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

	public function update(SCategory $sCategory)
	{
		$id 		= $sCategory -> getId();
		$title 		= $this -> db -> quote($title -> getTitle());
		$content 	= $this -> db -> quote($content -> getContent());
		$idAuthor 	= $_SESSION['id'];

		$query 		= '	UPDATE scategory
						SET title 		='.$title.',
							content 	='.$content.',
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

	public function getList($id)
	{
		$query = "SELECT * FROM scategory WHERE id_category = '".$id."'";
		$res 	= $this -> db -> query($query);
		if ($res)
		{
			$sCategorys = $res -> fetchAll(PDO::FETCH_CLASS, 'sCategory', array($this -> db));
			return $sCategorys;
		}
		else
		{
			throw new Exception('Database error');
		}
	}

	public function getLasts()
	{
		$query = "SELECT * FROM category ORDER BY date DESC LIMIT 20";
		$res 	= $this -> db -> query($query);
		if ($res)
		{
			$sCategorys = $res -> fetchObject('sCategory', array($this -> db));
			return $categorys;
		}
		else
		{
			throw new Exception('Database error');
		}
	}
	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM scategory WHERE id='".$id."'";
		$res = $this -> db -> query($query);
		if ($res)
		{
			$sCategory = $res -> fetchObject('sCategory', array($this -> db));
			if ($sCategory)
			{
				return $sCategory;
			}
			else
			{
				return "Sous-category not found";
			}
		}
		else
		{
			return "Internal Server Error";
		}
	}
}

?>