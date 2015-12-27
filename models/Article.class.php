<?php 
class Article
{
	private $id;
	private $title;
	private $content;
	private $image;
	private $id_author;
	private $date;
	private $db;

	//Construct
	public function __construct($db)
	{
		$this -> db = $db;
	}

	//Getters
	public function getId()
	{
		return $this -> id;
	}
	public function getTitle()
	{
		return $this -> title;
	}
	public function getContent()
	{
		return $this -> content;
	}
	public function getImage()
	{
		return $this -> image;
	}
	public function getIdAuthor()
	{
		return $this -> id_author;
	}
	public function getDate()
	{
		return $this -> date;
	}

	//Setters
	public function setTitle($title)
	{
		if (strlen($title) > 3 && strlen($title) < 255)
			{
				$this -> title = $title;
				return true;
			}
			else
			{
				throw new Exception("Title incorrect (4/254 characters)");
			}
	}

	public function setContent($content)
	{
		if (strlen($content) > 3 && strlen($content) < 2047)
			{
				$this -> content = $content;
				return true;
			}
			else
			{
				throw new Exception("Title incorrect (4/2048 characters)");
			}
	}

	public function setImage($image)
	{
		if($image !== "")
		{
			if (filter_var($image, FILTER_VALIDATE_URL))
			{
				$this -> image = $image;
				return true;
			}
			else
			{
				throw new Exception("URL incorrecte");
			}
		}
	}

	public function setIdAuthor($idAuthor)
	{
		if($idAuthor == ($_SESSION['id']))
		{
			$this -> idAuthor = $idAuthor;
			return true;
		}
	}

	public function setDate($date)
	{
		$this -> date = $date;
		return true;
	}
}
 ?>