<!-- <-----------------------------物件導向---------------------------->
<?php

$mysqli = new mysqli('localhost', 'root', '', 'lance');
$mysqli->set_charset('utf8');


class Bike
{
    // 這個腳踏車做出來會有速度屬性。

    // 加上private等於封裝。只有function內的speed可以修改。外層的 $myBike->speed不能改。
    // private $speed;

    // "protected"屬性可以讓繼承的物件繼續使用$speed
    protected $speed;

    // 1.建構式設計:空出記憶體，把產品做出來。
    function __construct()
    {
        $this->speed = 0;
    }
    function upSpeed()
    {
        $this->speed = $this->speed < 1 ? 1 : $this->speed * 1.4;
    }
    function downSpeed()
    {
        $this->speed = $this->speed < 1 ? 0 : $this->speed * 0.7;
    }
    function getSpeed()
    {
        return $this->speed;
    }
}

// 擴展腳踏車的功能。(觀念:繼承)
class Scooter extends Bike
{
    private $gear;
    var $speed = 1;
    function __construct()
    {
        $this->gear = 1;
    }

    function upSpeed()
    {
        $this->speed = $this->speed < 1 ? 1 : $this->speed * 1.9;
    }
    // 換擋
    function changeGear($gear = 1)
    {
        if ($gear >= 0 && $gear <= 4) {
            $this->gear = $gear;
        }
    }
}

class Member
{
    private $id;
    private $account, $realname, $icon, $icontype;
    function __construct($id, $account, $realname, $icon, $icontype)
    {
        $this->id = $id;
        $this->account = $account;
        $this->realname = $realname;
        $this->icon = $icon;
        $this->icontype = $icontype;
    }

    function getId() {return $this->id ;}
    function getAccount() {return  $this->account ;}
    function getRealname() {return $this->realname;}
    function getIcon() {return $this->icon ;}
    function getIcontype() {return  $this->icontype ;}
    function setRealname() {return  $this->realname ;}

}


// 2.買了產品來使用物件
// 我和我朋友可以分別擁有一個new Bike，彼此互相不干擾。
$myBike = new Bike();
$urBike = new Bike();

echo $myBike->getSpeed() . "<br/>";
$myBike->upSpeed();
$myBike->upSpeed();
$myBike->upSpeed();
$myBike->upSpeed();
$myBike->upSpeed();
$myBike->upSpeed();
$myBike->upSpeed();
$myBike->upSpeed();
$myBike->upSpeed();
$myBike->upSpeed();
$myBike->upSpeed();
$myBike->upSpeed();
echo $myBike->getSpeed() . "<br/>";
$urBike->upSpeed();
$urBike->upSpeed();
$urBike->upSpeed();
$urBike->upSpeed();
$urBike->upSpeed();
$urBike->upSpeed();
echo $urBike->getSpeed() . "<br/>";
?>