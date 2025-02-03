<?php

// -------------------------------------OBJ abstract=>抽象類別-----------------------------
abstract class Product
{
    // 先宣告，producted準備給子類別使用
    protected $name;
    protected $price;

    // 建構式函數
    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
    // 執行函式

    public function getName()
    {
        return $this->name;
    }
    public function getPrice()
    {
        return $this->price;
    }
    // 方法目前還沒定義，有抽象方法，就需要有抽象類別。
    abstract public function getDetails();
}

class Book extends Product
{
    private $author;

    public function __construct($name, $price, $author)
    {
        $this->name = $name;
        $this->price = $price;
        $this->author = $author;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getDetails()
    {
        return "Name:{$this->name};
        Price:{$this->price};
        Author:{$this->author}";
    }
}

class Seafood extends Product
{
    private $kind;

    public function __construct($name, $price, $kind)
    {
        $this->name = $name;
        $this->price = $price;
        $this->kind = $kind;
    }

    public function getKind()
    {
        return $this->kind;
    }

    public function getDetails()
    {
        return "Name:{$this->name};
        Price:{$this->price};
        Author:{$this->kind}";
    }
}

// -------------------------------------Interface=>定義規格-----------------------------

// 定義規格
interface DiscountStrategy
{
    public function setDiscount($price);
}
// 執行規格_固定折扣
class FixedDiscount implements DiscountStrategy
{
    private $amount;
    public function __construct($amount)
    {
        $this->amount = $amount;
    }
    public function setDiscount($price)
    {
        return max(1, $price - $this->amount);
    }
}
// 執行規格_比例折扣
class PercentageDiscount implements DiscountStrategy
{
    private $percentage; //50% =>50
    public function __construct($percentage)
    {
        $this->percentage = $percentage;
    }
    public function setDiscount($price)
    {
        return $price * $this->percentage / 100;
    }
}

// -------------------------------------購物車-----------------------------
class Cart
{
    private $items = []; //item is a product
    private $discountStrategy = null;  //不打折==>null

    public function addItem(Product $product)
    {
        $this->items[] = $product;
    }

    public function setDiscountStrategy(DiscountStrategy $strategy)
    {
        $this->discountStrategy = $strategy;
    }
    public function calcTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $price = $item->getPrice();
            if ($this->discountStrategy != null) {
                $price = $this->discountStrategy->setDiscount($price);
            }
            $total += $price;
        }

        return $total;
    }


    public function listItems()
    {
        foreach ($this->items as $item) {
            echo "{$item->getDetails()}<br />";
        }
    }
}
// -------------------------------------應用購物車-----------------------------
// 物件
$book1 = new Book('PHP 大全', 300, 'Brad');
$book2 = new Book('MySQL 大全', 400, 'Pig');
$fish = new Seafood('fish', 100, 'fish1');

// 加入購物車
$cart = new Cart();
$cart->addItem($book1);
$cart->addItem($book2);
$cart->addItem($fish);

// 列出購物車清單
$cart->listItems();
// echo 價錢
echo "Price1: {$cart->calcTotal()}<br />";

// echo 折扣
$cart->setDiscountStrategy(new FixedDiscount(10));
echo "Price2: {$cart->calcTotal()}<br />";

$cart->setDiscountStrategy(new PercentageDiscount(90));
echo "Price3: {$cart->calcTotal()}<br />";
