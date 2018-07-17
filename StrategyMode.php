<?php

/*抽象的鸭子类*/
abstract class Duck
{
    /*FlyBehavior类型*/
    protected $flyBehavior;

    /*QuackBehavior 类型*/
    protected $quackBehavior;

    /*鸭子飞行的行为*/
    public function flyAction()
    {
        $this->flyBehavior->fly();
    }

    /*鸭子叫的行为*/
    public function quackAction()
    {
        $this->quackBehavior->quack();
    }

    public function setFlyBehavior(FlyBehavior $flyBehavior)
    {
        $this->flyBehavior = $flyBehavior;
    }

    public function setQuackBehavior(QuackBehavior $quackBehavior)
    {
        $this->quackBehavior = $quackBehavior;
    }
}

class ConcreteDuck extends Duck
{

}

interface FlyBehavior
{
    public function fly();
}

interface QuackBehavior
{
    public function quack();
}

/*具体的飞行行为*/
class ConcreteFlyBehavior implements FlyBehavior
{
    public function fly()
    {
        echo "一个具体的飞行行为<br/>";
    }
}

/*具体的飞行行为*/
class ConcreteQuackBehavior implements QuackBehavior
{
    public function quack()
    {
        echo "一个具体的呱呱叫行为<br/>";
    }
}

$duck = new ConcreteDuck();
$duck->setQuackBehavior(new ConcreteQuackBehavior());
$duck->setFlyBehavior(new ConcreteFlyBehavior());
$duck->flyAction();
$duck->quackAction();
