<?php

namespace Helper;

class Call
{
    /**
     * @param $callable - Closure Function | HomeController@index
     */
    protected  static $callable;

    static function calling($callable, array $par = [])
    {
        self::$callable = $callable;

        //is_callable verilen değer çağrılabilir bir fonksiyon mu diye kontrol eder. (Clojure)
        if (!is_callable(self::$callable))
        {
            $call = explode("@", self::$callable);

            if(file_exists(APP . "Controller/". strtolower($call[0]) .".php"))
            {
                include APP . "Controller/" . strtolower($call[0]) . ".php";
            }

            if(class_exists($call[0]))
            {

                $method = new $call[0];
                $_function = $call[1];

                call_user_func_array([$method, $_function], $par);
            }
        }else {
            call_user_func(self::$callable);
            /* ikisinin farkı? */
            //return call_user_func(self::$callable);
        }
    }
}
