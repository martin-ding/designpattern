<?php

/*工厂方法模式，定义了一个创建对象的接口，但由子类决定要实例化的类是哪一个。
工厂方法让类把实例化推迟到子类*/

/* 所谓的工厂方法就是创建对象的接口 */

/* 抽象方法 披萨
 *  pizza 的准备 prepare()
 *  烘焙 bake()
 *  切割 cut()
 *  打包 box()
 *  获取名称 getName()
 */
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

/*卖pizza的店铺
里面使用了工厂方法 createPizza 根据传入的参数获取不同的披萨
*/
abstract class Store
{
    protected $pizza;

    abstract function createPizza($type);

    /**
     * 订购pizza
     * @param  String $type [订购什么样的pizza]
     * @return Pizza        [返回披萨]
     */
    public function orderPizza($type)
    {
        $this->pizza = $this->createPizza($type);
        echo $this->pizza->getName()."<br/> ";
        $this->pizza->prepare();
        $this->pizza->bake();
        $this->pizza->cut();
        $this->pizza->box();
    }
}

class PizzaStore1 extends Store
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
        }
    }
}

class PizzaStore2 extends Store
{
    public function createPizza($type)
    {
        switch ($type) {
            case 'usa':
                return new UsaPizza("usa");
                break;
        }
    }
}

$store = new PizzaStore1();
$pizza = $store->orderPizza("china1");
echo str_repeat("-", 30)."<br/>";
$pizza2 = $store->orderPizza("china2");



