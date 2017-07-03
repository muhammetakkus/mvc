<?php
namespace App\Core\Src;

class Token
{
    protected static $request;

    static function create()
    {
        echo $_SESSION['_token']  = bin2hex(openssl_random_pseudo_bytes(16));
    }

    /**
     * @param $request POST|GET
     */
    static function check($request)
    {
        self::$request = $request;

        /* TOKEN KULLANIMINI İSTEĞE BAĞLI HALE NASIL GETİRECEĞİZ? */
        /* if(isset($_POST["_token"])) şeklinde gelen token posttu varsa bu işlemi yap dediğimizde gelen token olsa bile dışarısan giriş yapılıyor?? */
        if (self::$request == "POST" && $_SERVER["REQUEST_METHOD"] == "POST")
        {
            if (!isset($_POST["_token"]) || $_POST["_token"] != $_SESSION['_token'])
            {
                die("Invalid CSRF Token");
            }
        }
    }
}