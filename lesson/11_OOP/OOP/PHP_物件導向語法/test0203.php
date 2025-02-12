<?php

// <---------------------------動物的echo----------------------------------------------->

$obj = new CAnimal();
$obj->makeNoise();
$obj->place = "TaiChung";
echo $obj->place, "<br />";
// $obj->__destruct();

// <---------------------------狗的echo----------------------------------------------->
$obj = new CDog(5, 500);
$obj->makeNoise();
echo $obj->getWeight(), "<br>";
echo $obj->getPrice(), "<br>";


// <---------------------------動物的類別----------------------------------------------->
class CAnimal {
 
    function __construct($weightValue = 0) {
        echo "Object Created.<br>";
        $this->setWeight($weightValue);
    }
 
    private $_weight = 1;
 
    public function makeNoise() {
        echo "Animal: ...<br />";
    }
 
    public function setWeight($value)
    {
        if ($value >= 0)
            $this->_weight = $value;
    }
   
    public function getWeight()
    {
        return $this->_weight;
    }
 
}


// <---------------------------狗繼承動物的內容繼續改----------------------------------------------->
// extends parent::
class CDog extends CAnimal {
    function __construct($weightValue = 0, $priceValue = 0) {
        parent::__construct($weightValue);
        $this->setPrice($priceValue);
    } 
    private $_price = 0;
    public function setPrice($value)
    {
        if ($value >= 0)
            $this->_price = $value;
    }
    public function getPrice()
    {
        return $this->_price;
    }
 
    public function makeNoise() {
        parent::makeNoise();
        echo "Dog: Wan! Wan!<br />";
    }
}
 