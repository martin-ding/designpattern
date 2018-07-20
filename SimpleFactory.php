<?php

/* 使用简单工厂生产披萨 */

abstract class Store
{
    /*var 简单工厂*/
    protected $factory;

    public function  __construct(SimplePizzaFactory $factory)
    {
        $this->factory = $factory;
    }

    /*根据传入的参数来确认具体订购的是哪一个披萨*/
    public function orderPizza($type)
    {
        $this->pizza = $this->factory->createPizza($type);
        $this->pizza->prepare();
        $this->pizza->bake();
        $this->pizza->cut();
        $this->pizza->box();
    }
}

class ConcreteStore extends Store
{

}

/*定义一个简单工厂*/
class SimplePizzaFactory
{
    public function createPizza($type)
    {
        switch ($type) {
            case 'china1':
                return new ChinaPizza("china1");
                break;
            case 'china2':
                return new ChinaPizza2("china2");
                break;
            case 'usa':
                return new UsaPizza("usa");
                break;
        }
        
    }
}


abstract class Pizza
{
    /*披萨的名字*/
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function prepare()
    {
        echo "准备材料<br/>";
    }

    public function bake()
    {
        echo "烘焙30分钟<br/>";
    }

    public function cut()
    {
        echo "切割披萨<br/>";
    }

    public function box()
    {
        echo "给披萨打包<br/>";
    }

    /*获取pizza名称*/
    public function getName()
    {
        return $this->name;
    }
}

class ChinaPizza extends Pizza
{
    public function prepare()
    {
        parent::prepare();
        echo "--------假如中国元素--------<br/>";
    }
}

class ChinaPizza2 extends Pizza
{
    public function prepare()
    {
        parent::prepare();
        echo "--------假如中国元素22222--------<br/>";
    }
}

class UsaPizza extends Pizza
{
    public function prepare()
    {
        parent::prepare();
        echo "--------假如美国元素--------<br/>";
    }
}


$store = new ConcreteStore(new SimplePizzaFactory());
$store->orderPizza("china1");
$store->orderPizza("china2");
