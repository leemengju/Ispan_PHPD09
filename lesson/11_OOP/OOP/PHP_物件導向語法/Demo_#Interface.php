<?php

interface IDrive {
	public function addSpeed($value);
	public function getSpeed();
}

interface IMonitor {
	public function getHistoryData();
}

class CMachine {
	
}

// Implements 組件，extends繼承
class CCar extends CMachine implements IDrive, IMonitor {
	private $_speed = 0;
	
	public function addSpeed($value) {
		$this->_speed += $value;
	}
	
	public function getSpeed() {
		return $this->_speed;		
	}
	
	public function getHistoryData() {
		return "test data";
	}
}
// 定義介面
class CHobby {

}


class CGame extends CHobby implements IDrive {
	private $_speed = 0;

	public function addSpeed($value) {
		$this->_speed += $value * 10;
	}

	public function getSpeed() {
		return $this->_speed;
	}
}

// new CGame() 創建了一個 CGame 類別的實例。
// addSpeed(5) 方法被呼叫，會將 _speed 增加 5 * 10 = 50。
// getSpeed() 會返回當前的 _speed，此時 _speed 是 50，因此輸出：Game speed = 50



$obj = new CCar();
$obj->addSpeed(5);
echo "Car speed = ", $obj->getSpeed(), "<br>";

$obj = new CGame();
$obj->addSpeed(5);
echo "Game speed = ", $obj->getSpeed(), "<br>";

function Drive($objImplDriveInterface) {
    $objImplDriveInterface->addSpeed(5);
    echo "Lab speed = ", $objImplDriveInterface->getSpeed(), "<br>";
}
 
Drive($objGame);

?>
