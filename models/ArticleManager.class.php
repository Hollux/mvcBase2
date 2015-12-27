<?php
class ArticleManager
{
	private $db;

	public function __construct($db)
	{
		$this -> db = $db;
	}

	public function create($title, $content, $image, $idAuthor)
	{
		$article = new Article($this->db);
		try
		{
			$article -> setTitle($title);
			$article -> setContent($content);
			$article -> setImage($image);
			$article -> setIdAuthor($idAuthor);
		}
		catch (Exception $e)
		{
			$err = $e->getMessage();
		}
		if(!isset($err))
		{
			$title 		= $this -> db -> quote($article -> getTitle());
			$content 	= $this -> db -> quote($article -> getContent());
			$idAuthor 	= $this -> db -> quote($article -> getIdAuthor());

			if ($image == "") 
			{
				$query		='INSERT INTO user(title, content, idAuthor)
						VALUE ('.$title.','.$content.','.$idAuthor.')';
			}
			else
			{
				$image 		= $this -> db -> quote($article -> getImage());
				$query		='INSERT INTO user(title, content, image, idAuthor)
						VALUE ('.$title.','.$content.','.$image.','.$idAuthor.')';
			}

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
 			throw new Exception('Error article');
 		}
	}

	public function delete(Article $article)
	{
		$id = $article->getId();
		$query = "DELETE FROM article WHERE id='".$id."'";
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

	public function update(Article $article)
	{
		$id 		= $article -> getId();
		$title 		= $this -> db -> quote($title -> getTitle());
		$content 	= $this -> db -> quote($content -> getContent());
		$image 		= $this -> db -> quote($image -> getImage());
		$idAuthor 	= $_SESSION['id'];

		$query 		= '	UPDATE article
						SET title 		='.$title.',
							content 	='.$content.',
							image 		='.$image.',
							$idAuthor 	='.$idAuthor.'
						WHERE id='.$id;
					= $this -> db -> exec($query);

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
		$query = "SELECT * FROM article";
		$res 	= $this -> db -> query($query);
		if ($res)
		{
			$articles = $res -> fetchAll(PDO::FETCH_CLASS, 'Article', array($this -> db));
			return $articles;
		}
		else
		{
			throw new Exception('Database error');
		}
	}

	public function getLasts()
	{
		$query = "SELECT * FROM article ORDER BY date DESC LIMIT 20";
		$res 	= $this -> db -> query($query);
		if ($res)
		{
			$articles = $res -> fetchAll(PDO::FETCH_CLASS, 'Article', array($this -> db));
			return $articles;
		}
		else
		{
			throw new Exception('Database error');
		}
	}
}

?>