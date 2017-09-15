<?php
class ezsqli
{
	private	$server = 'pdb3.biz.nf';
	private	$username = '1854492_rucoy';
	private	$password = 'sw92jgfA39104s01Q';
	private	$database = '1854492_rucoy';
	private $connection;

	public $all;
	public $row;
	public $str;




	public function __construct()
	{
		$this->connection = mysqli_connect($this->server,$this->username,$this->password,$this->database) or die();
		if(mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}
	public function __destruct()
	{
		mysqli_close($this->connection);
	}
	
	

	public function query($sql)
	{
		list($type, $field, $other) = explode(' ',$sql,3);
			$field = str_replace('`','', $field);
			$field = str_replace("'",'', $field);

		$result = mysqli_query($this->connection, $sql);

		if(strtolower($type) == "select")
		{

			$arr = array();
			while($row = mysqli_fetch_assoc($result)){$arr[] = $row;}

			$this->all = $arr;
			$this->row = $arr[0];
	
			if($field == "*"){$this->str = "*";}
			else{$this->str = $arr[0][$field];}

			return $this;
		}
		else
		{
			return $result;
		}
	}
	public function escape($var){
		if(is_array($var) === true)
		{
			for($f = 0; $f < count($var); $f++)
			{
				$var[$f] = mysqli_real_escape_string($this->connection, htmlspecialchars($var[$f], ENT_QUOTES, 'UTF-8'));
			}
		}
		else
		{
			$var = mysqli_real_escape_string($this->connection, htmlspecialchars($var, ENT_QUOTES, 'UTF-8'));
		}
		return $var;
	}
}
$ezsqli = new ezsqli;
?>
