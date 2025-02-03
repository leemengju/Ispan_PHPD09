<?php

// abstract class 定義出整個族系的使用標準
abstract class CDoor {
	abstract public function Open();  // 迫使後代物件必須 override 此一方法
	
}

class CCarDoor extends CDoor {
	public function Open() {
		echo "Open car door";
	}
}

// $obj = new CDoor();  // 無法建立 abstract class 的物件實體
$obj = new CCarDoor();
$obj->Open();


?>