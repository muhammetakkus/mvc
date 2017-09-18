<?php

namespace App\Core\Src;

class Cookie
{
    static function set($name,$val,$time)
    {
        setcookie($name,$val,(time()+60) * $time);
        return $_COOKIE[$name];
    }

    static function destroy($name = null)
    {
        if(empty($name))
        {
            foreach ( $_COOKIE as $key => $value )
            {
                if ( $key != session_name() )
                {
                    setcookie( $key, "", time() - 60*60*365, '/' );
                }
            }
        }else {
            setcookie($name,"",time() - 60*60*365);
        }
    }
}