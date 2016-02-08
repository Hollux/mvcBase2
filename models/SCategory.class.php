<?php 
class SCategory
{
	private $id;
	private $title;
	private $content;
	private $id_author;
	private $id_category;
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
	public function getIdAuthor()
	{
		return $_SESSION['id'];
	}

			/*A VERIFIER*/
	public function getCategory()
	{
		if (!$this->category)
		{
			$categoryManager = new CategoryManager($this->db);
			$this->category = $categoryManager->findById($this->id_category);
		}
		return $this->category;
	}
	public function getIdCategory()
	{
		return $this->id_category;
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
			throw new Exception("Content incorrect (4/2048 characters)");
		}
	}

	public function setIdAuthor($idAuthor)
	{
		if($idAuthor == ($_SESSION['id']))
		{
			$this -> idAuthor = $idAuthor;
			return true;
		}
		else
		{
			throw new Exception("problem id author");
		}
	}

		/*A VERIFIER*/
	public function setCategory(Category $category)
	{
		$this->id_category = $category->getId();
		return true;
	}

	public function setDate($date)
	{
		$this -> date = $date;
		return true;
	}
}
 ?>