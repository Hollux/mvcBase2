<?php 
class Topic
{
	private $id;
	private $title;
	private $vues;
	private $id_author;
	private $id_scategory;
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
	public function getVues()
	{
		return $this -> vues;
	}
	public function getIdAuthor()
	{
		return $_SESSION['id'];
	}

			/*A VERIFIER*/
	public function getSCategory()
	{
		if (!$this->category)
		{
			$sCategoryManager = new SCategoryManager($this->db);
			$this->sCategory = $sCategoryManager->findById($this->id_scategory);
		}
		return $this->sCategory;
	}
	public function getIdSCategory()
	{
		return $this->id_scategory;
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
				/*if(VOIR PROBLEME QUAND TITRE DEJA DONNE)*/
				$this -> title = $title;
				return true;
			}
			else
			{
				throw new Exception("Title incorrect (4/254 characters)");
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
	public function setSCategory(SCategory $sCategory)
	{
		$this->id_scategory = $sCategory->getId();
		return true;
	}

	public function setDate($date)
	{
		$this -> date = $date;
		return true;
	}


	public function setVues($vues)
	{
		if (intval($vues))
			{
				$this -> vues = $vues;
				return true;
			}
			else
			{
				throw new Exception("Error vues");
			}
	}
}
 ?>