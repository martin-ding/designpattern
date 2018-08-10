<?php 

/*使用Closure完成装饰器

    Closure 有两个特性
    特性1 . 可以包含调用的上下文
    特性2 . 延迟执行

    下面是一个简单的使用Closure 来完成一个pipleline [管道] 
    
    思路来源 Laravel Pipleline 源代码
*/
class Espresso
{  
    public $cost = 2.5;
    public function cost()
    {  
        return $this->cost;  
    }  
}

class Dressing 
{    
    public function cost(Espresso $espresso,  Closure $closure)
    {  
        return ($espresso);
    }  
}  
class Whip extends Dressing 
{  
    public function cost(Espresso $espresso, Closure $closure)
    {  
        $espresso->cost = $espresso->cost() + 0.1;  
        
        return $closure($espresso);
    }  
} 
class Mocha extends Dressing 
{   
    public function cost(Espresso $espresso, Closure $closure)
    {  
        $espresso->cost = $espresso->cost() + 0.5;  
        
        return $closure($espresso);
    }  
}

$func0 = function($coffee)
{
    return $coffee;
};

$func = function($fun, $dressing){
    return function($coffee) use ($fun, $dressing){
        return $dressing->cost($coffee,$fun);
    };
};

$coffee = array_reduce([new Whip(), new Mocha()],$func,$func0); // 最精彩的就是这句代码

/**
 * http://php.net/manual/zh/function.array-reduce.php
 * mixed array_reduce ( array $array , callable $callback [, mixed $initial = NULL ] )
 *
 * callback 有两个参数 一个是上一个callback执行的返回值，另外一个是本次的item
 *
 * initial 第一次第一个参数 就是这个 
 */
var_dump($coffee(new Espresso()));