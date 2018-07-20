<?php

/* 装饰器模式实例*/

/*饮料父类*/
abstract class Beverage
{
    abstract function getDescription();
    abstract function cost();
}

abstract class Decorator extends  Beverage
{
    /*Beverage var */
    protected $beverage;

    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }
}

/*黑咖啡*/
class BlackCoffee extends Beverage
{
    public function getDescription()
    {
        return "BlackCoffee ";
    }

    public function cost()
    {
        return 12;
    }
}

/*绿茶*/
class GreenTea extends Beverage
{
    public function getDescription()
    {
        return "BlackCoffee ";
    }

    public function cost()
    {
        return 10;
    }
}

/*豆浆*/
class DoujiangDecorator extends Decorator
{
    public function cost()
    {
        return 4 + $this->beverage->cost();
    }

    public function getDescription()
    {
        return $this->beverage->getDescription() . " with Doujiang";
    }
}

/*牛奶*/
class MilkDecorator extends Decorator
{
    public function cost()
    {
        return 8 + $this->beverage->cost();
    }

    public function getDescription()
    {
        return $this->beverage->getDescription() . " with Milk";
    }
}

$beverage = new BlackCoffee(); #点了一杯咖啡
$beverage = new DoujiangDecorator($beverage); #加了一份豆浆
$beverage = new DoujiangDecorator($beverage); #又了一份豆浆
var_dump($beverage->cost());
var_dump($beverage->getDescription());

