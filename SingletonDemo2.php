    <?php

/*版本1存在的问题在于 在php中 即使你是私有构造器
* 还是可以被子类继承
**/
class Singleton
{
    protected static $instance;
    protected static $hasInstance = false;

    /*不允许clone*/
    public function __clone()
    {
        throw new Exception("Can not be clone", 1);
    }

    // 不允许serialize
    // 一种clone 对象的方式可以使用 serizalize 和 unserialize
    public function __wake()
    {
        throw new Exception("Can not be Serialize", 2);
    }

    private function __construct()
    {
        /*这个是为了防止反射*/
        if (static::$hasInstance) {
            throw new Exception("Can not be reflection", 3);
        }
        static::$hasInstance = true;
    }

    public static function getInstance()
    {
        if (! static::$instance instanceof static) {
            static::$instance = new static();
        }
        return static::$instance;
    }
}

/*单例模式继承*/
class Singleton1 extends Singleton
{

}


var_dump(Singleton1::getInstance());
var_dump(Singleton1::getInstance());