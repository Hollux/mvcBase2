<?php
class CategoryManager
{
	private $db;

	public function __construct($db)
	{
		$this -> db = $db;
	}

	public function create($title, $content, $idAuthor)
	{
		$category = new Category($this->db);
		try
		{
			$category -> setTitle($title);
			$category -> setContent($content);
			$category -> setIdAuthor($idAuthor);
		}
		catch (Exception $e)
		{
			$errors = $e->getMessage();
			echo($errors);
		}
		if(!isset($err))
		{
			$title 		= $this -> db -> quote($category -> getTitle());
			$content 	= $this -> db -> quote($category -> getContent());
			$idAuthor 	= $category -> getIdAuthor();

			$query		='INSERT INTO category(title, content, idAuthor)
						VALUE ('.$title.','.$content.','.$idAuthor.')';
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

	public function delete(Category $cate)
	{
		$id = $category->getId();
		$query = "DELETE FROM category WHERE id='".$id."'";
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

	public function update(Category $category)
	{
		$id 		= $category -> getId();
		$title 		= $this -> db -> quote($title -> getTitle());
		$content 	= $this -> db -> quote($content -> getContent());
		$image 		= $this -> db -> quote($image -> getImage());
		$idAuthor 	= $_SESSION['id'];

		$query 		= '	UPDATE category
						SET title 		='.$title.',
							content 	='.$content.',
							image 		='.$image.',
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

	public function getList()
	{
		$query = "SELECT * FROM category";
		$res 	= $this -> db -> query($query);
		if ($res)
		{
			$categorys = $res -> fetchAll(PDO::FETCH_CLASS, 'Category', array($this -> db));
			return $categorys;
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
			$categorys = $res -> fetchObject('category', array($this -> db));
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
		$query = "SELECT * FROM category WHERE id='".$id."'";
		$res = $this -> db -> query($query);
		if ($res)
		{
			$category = $res -> fetchObject('category', array($this -> db));
			if ($category)
			{
				return $category;
			}
			else
			{
				return "Category not found";
			}
		}
		else
		{
			return "Internal Server Error";
		}
	}
}

?>