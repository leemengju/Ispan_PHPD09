<?php
    

    $mysqli = new mysqli('localhost','root','', 'lance');
    $mysqli->set_charset('utf8');

    // dsn data source name
    $pdo = new PDO('mysql:host=localhost;dbname=lance;charset=utf8', 'root', '');
    

    define('LETTERS', 'ABCDEFGHJKLMNPQRSTUVXYWZIO');
    function checkTWId($id){
        $isRight = false;
        $regex = '/^[A-Z][12][0-9]{8}$/';
        if (preg_match($regex, $id)){
            $c1 = substr($id, 0, 1);
            $a12 = strpos(LETTERS, $c1) + 10;
            $a1 = (int)($a12 / 10);
            $a2 = $a12 % 10;
            $n1 = substr($id, 1, 1);
            $n2 = substr($id, 2, 1);
            $n3 = substr($id, 3, 1);
            $n4 = substr($id, 4, 1);
            $n5 = substr($id, 5, 1);
            $n6 = substr($id, 6, 1);
            $n7 = substr($id, 7, 1);
            $n8 = substr($id, 8, 1);
            $n9 = substr($id, 9, 1);

            $sum = $a1*1 + $a2*9 + $n1*8 + $n2*7 + $n3*6 + $n4*5 +
                     $n5*4 + $n6*3 + $n7*2 + $n8*1 + $n9*1;

            $isRight = $sum % 10 == 0;
        }        

        return $isRight;
    }

    function createTWIdByRandom(){
        $isMale = rand(0,1) == 0;
        return createTWIdByGender($isMale);
    }
    function createTWIdByArea($area){
        $isMale = rand(0,1) == 0;
        return createTWIdByBoth($area, $isMale); 
    }
    function createTWIdByGender($isMale = true){
        $area = substr(LETTERS, rand(0,25), 1);
        return createTWIdByBoth($area, $isMale);
    }

    function createTWIdByBoth($area, $isMale){
        $id = $area;
        $id .= $isMale?'1':'2';
        for ($i=0; $i<7; $i++) $id .= rand(0,9);

        for ($i=0; $i<10; $i++){
            if (checkTWId($id . $i)){
                $id .= $i;
                break;
            }
        }
        return $id;
    }

    class Bike {
        protected $speed;

        function __construct(){
            $this->speed = 0;
        }

        function upSpeed(){
            $this->speed = $this->speed < 1 ? 1 : $this->speed*1.4;
        }
        function downSpeed(){
            $this->speed = $this->speed < 1 ? 0 : $this->speed*0.7;
        }
        function getSpeed(){
            return $this->speed;
        }
    }

    class Scooter extends Bike {
        private $gear;
        function __construct($gear=0){
            $this->gear = $gear;
        }
        function upSpeed(){
            $this->speed = $this->speed < 1 ? 1 : $this->speed*1.8*$this->gear;
        }
        function changeGear($gear = 0){
            if ($gear >= 0 && $gear <= 4){
                $this->gear = $gear;
            }
        }
    }

    class Member {
        private $id;
        private $account, $realname, $icon, $icontype;
        function __construct($id,$account, $realname, $icon, $icontype){
            $this->id = $id;
            $this->account = $account;
            $this->realname = $realname;
            $this->icon = $icon;
            $this->icontype = $icontype;
        }
        function getId(){return $this->id;}
        function getAccount(){return $this->account;}
        function getRealname(){return $this->realname;}
        function getIcon(){return $this->icon;}
        function getIcontype(){return $this->icontype;}

        function setRealname($realname){$this->realname=$realname;}
    }



?>