<?php
// 一個資料如果不存在，__get會幫他找出來。
$obj = new CTest();
$obj->firstName = "Jeremy";
$name = $obj->firstName;
echo "<hr>";
echo $name;


class CTest {

	// 這裡 $_dataBag 是一個 私有陣列，用來儲存物件的屬性。
	private $_dataBag = array();


	// 這是 PHP 的 魔術方法 __set()，當你試圖存取一個不存在的屬性時，它就會被自動調用。
	public function __set($varName, $varValue)
	{
		echo "__set<br>";
		echo $varName, ": ", $varValue, "<br>";
		$this->_dataBag[$varName] = $varValue;
	}

	public function __get($varName)
	{
		echo "__get<br>";
		echo $varName, "<br>";
		return $this->_dataBag[$varName];
	}
		
}


?>
