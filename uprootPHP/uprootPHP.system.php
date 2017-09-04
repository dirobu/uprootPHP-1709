<?php
class uprootPHP
{
	public $url;
	public $dir;
	public $href;
	public $ajax;
	public $template;
	public $page_allow;
	public $page_error;
	public $page_index;

	public function __construct()
	{
		global $_SERVER;
		$this->url = $_SERVER['REDIRECT_URL'];
		if(substr($this->url, 0, 1) == "/")
		{
			$this->url = substr($this->url, 1);
		}


		$this->dir = explode('/',$this->url);


		for($f = 0; $f < count($this->url) - 2; $f++)
		{
			$this->href.= '../';
		}


		global $_POST;
		global $_GET;

		if($_POST['ajax'])
		{
			$this->ajax =  $_POST['ajax'];
		}
		else if($_POST['ajax'])
		{
			$this->ajax =  $_GET['ajax'];
		}

		
		$this->allow = array();

	}

	public function obStart()
	{
		if(strlen($this->template) > 0 && file_exists($this->template))
		{
			ob_start();
			include($this->template);
		}
	}
	public function obFlush()
	{
		if(strlen($this->template) > 0 && file_exists($this->template))
		{
			ob_flush();
		}
	} 
	public function load()
	{
		if(strlen($this->url) < 1 && strlen($this->index) > 0 && file_exists($this->index))
		{
			$this->obStart();
			include($this->index);
			$this->obFlush();
			return true;
		}
		else if(isset($this->ajax) && file_exists('ajax/'.$_POST['ajax']))
		{
			include('ajax/'.$this->ajax);
			return true;
		}
		else if(strlen($this->dir[0]) > 0 && file_exists('pages/'.$this->dir[0].".php"))
		{
			$this->obStart();
			include('pages/'.$this->dir[0].".php");
			$this->obFlush();
			return true;
		}
		else if(in_array($this->url, $this->allow) && file_exists($this->url))
		{
			include($this->url);
			return true;
		}
		else if(strlen($this->error) > 0 && file_exists($this->error))
		{
			include($this->error);
			return true;
		}
		else
		{
			echo "<h1>UprootPHP: Missing Declaration</h1>";
			echo "<li>index()</li>";
			echo "<li>error()</li>";
			echo "<br><br>";
			echo "<h3>UprootPHP: Run - Default Example</h3>";
			echo "<br>";
			echo "&#36;uprootPHP = new uprootPHP;<br>";
			echo "&#36;uprootPHP -> allow('sitemap.xml') -> allow('robots.txt');<br>";
			echo "&#36;uprootPHP -> index('pages/index.php') -> error('pages/error.php');<br>";
			echo "&#36;uprootPHP -> load();<br>";

		}
	}
	

	public function allow($str)
	{
		array_push($this->allow, $str);
		return $this;
	}

	public function index($str)
	{
		$this->index = $str;
		return $this;
	}

	public function error($str)
	{
		$this->error = $str;
		return $this;
	}
	public function template($str)
	{
		$this->template = $str;
		return $this;
	}
}

?>
