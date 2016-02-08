<?php 

class Post
{
	private $id;
	private $content;
	private $id_author;
	private $id_topic;
	private $id_SCategory;
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
	public function getContent()
	{
		return $this -> content;
	}
	public function getIdAuthor()
	{
		return $_SESSION['id'];
	}

			/*A VERIFIER*/
	public function getTopic()
	{
		if (!$this->topic)
		{
			$topicManager = new TopicManager($this->db);
			$this->topic = $topicManager->findById($this->id_topic);
		}
		return $this->topic;
	}
	public function getIdTopic()
	{
		return $this->id_topic;
	}
			/*A VERIFIER*/
	public function getSCategory()
	{
		if (!$this->sCategory)
		{
			$sCategoryManager = new SCategoryManager($this->db);
			$this->sCategory = $sCategoryManager->findById($this->id_sCategory);
		}
		return $this->sCategory;
	}
	public function getIdSCategory()
	{
		return $this->id_sCategory;
	}
	public function getDate()
	{
		return $this -> date;
	}

	//Setters

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
	public function setTopic(Topic $topic)
	{
		$this->id_topic = $topic->getId();
		return true;
	}
		/*A VERIFIER*/
	public function setSCategory(SCategory $sCategory)
	{
		$this->id_sCategory = $sCategory->getId();
		return true;
	}

	public function setDate($date)
	{
		$this -> date = $date;
		return true;
	}
}
 ?>