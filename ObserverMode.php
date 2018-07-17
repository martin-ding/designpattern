<?php

/**
 * 这个是一个观察者模式的实现
*/

/*主题*/
abstract class Subject
{
    /*Observer 对象*/
    protected $observers;
    protected $tempature;
    protected $humidity;
    protected $pressure;

    public function addObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function removeObserver(Observer $observer)
    {
        foreach ($this->observers as $key => $value) {
            if ($value === $observer) {
                unset($this->observers[$key]);
            }
        }
        return true;
    }

    /*这个是一个温度数据发生变化的方法将会触发 notifyObserver*/
    public function updateTempature()
    {
        $this->notifyObserver();
    }

    public function setTempatureInfo($tempature, $humidity, $pressure)
    {
        $this->tempature = $tempature;
        $this->humidity  = $humidity;
        $this->pressure  = $pressure;
        $this->updateTempature();
    }

    public function notifyObserver()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this->tempature, $this->humidity, $this->pressure);
        }
    }
}

class ConcreteSubject extends Subject
{

}

/*显示接口*/
interface DisplayElement
{
    public function display($tempature, $humidity, $pressure);
}

/*具体的显示功能*/

class ConcreteDisplayElement implements DisplayElement
{
    public function display($tempature, $humidity, $pressure)
    {
        echo $tempature . " " . $humidity . " " . $pressure . "<br/>";
    }
}

class ConcreteDisplayElement2 implements DisplayElement
{
    public function display($tempature, $humidity, $pressure)
    {
        echo $tempature . " " . $humidity . " " . $pressure . "........<br/>";
    }
}

/*观察者模式*/
abstract class Observer
{
    protected $subject;
    protected $displayElement;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
        $this->subject->addObserver($this);
    }

    public function setDisplayElement(DisplayElement $displayElement)
    {
        $this->displayElement = $displayElement;
    }

    abstract public function selfupdate($tempature, $humidity, $pressure);

    public function update($tempature, $humidity, $pressure)
    {
        $this->selfupdate($tempature, $humidity, $pressure);
        if ($this->displayElement) { 
            $this->displayElement->display($tempature, $humidity, $pressure);
        }
    }
}

/*具体的观察者*/
class ConcreteObserver extends Observer
{
    public function selfupdate($tempature, $humidity, $pressure)
    {
        echo "本身的显示1  <br/>";
    }
}

/*具体的观察者*/
class ConcreteObserver2 extends Observer
{
    public function selfupdate($tempature, $humidity, $pressure)
    {
        echo "本身的显示 <br/>";
    }
}

$concreteSubject = new ConcreteSubject();
new ConcreteObserver($concreteSubject);
(new ConcreteObserver2($concreteSubject))->setDisplayElement(new ConcreteDisplayElement2());
$concreteSubject->setTempatureInfo(22.3, 21, 12);
$concreteSubject->setTempatureInfo(22.3, 21, 192);

/*
《设计模式》中用于显示功能的使用了另外一个接口实现display功能
所有的Observer子类都要实现这个接口 然后实现这个display方法
可以借助于 策略模式 来完成 即Observer 不再是接口而是抽象类
里面设置一个setter方法用来接收 DisplayElement接口注入
 */
