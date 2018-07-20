<?php

/**
 * java中实现单例模式要注意的点
 * 多线程的使用问题 推荐使用两个判断 加一个锁的实现方式 并且使用关键字volatile 来实现
 * java 如果想要实现 单例的继承可以使用Register [暂时没有研究]
 */

class Singleton
{
    private static $instance;
    private static $hasInstance = false;

    /*不允许clone*/
    public function __clone()
    {
        throw new Exception("Can not be clone", 1);
    }

    // 不允许serialize
    public function __wake()
    {
        throw new Exception("Can not be Serialize", 2);
    }

    private function __construct()
    {
        /*这个是为了防止反射*/
        if (self::$hasInstance) {
            throw new Exception("Can not be reflection", 3);
        }
        self::$hasInstance = true;
    }

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

