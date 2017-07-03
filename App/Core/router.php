<?php

namespace App\Core\Router;

use App\Core\Src\Call;
use App\Core\Src\Token;

class Route {

    /**
     * @var bool $status
     */
    private $status;

    function __construct()
    {
        /* Eğer sayfa başarı ile çağrılırsa true olacak */
        $this->status = false;
    }

    /**
     * route.php Sayfasında Kullanılan route metodu
     *
     * metoda gelen roterlar($pattern) öncelikle parametreli mi değil mi diye bakılıyor ilk if sorgusu parametrelileri match ediyor.
     * parametresizler oluğu gibi URL ile karşılaştırılıp match olan roter'ın controller'ı çağrılıyor.[ilk if sorgusunun else kısmı]
     * parametrelide ise öncelikle parametresiz kısım $router değişkenine çekiliyor.
     *
     * parametreden arındırılan kısım($route) URL ile explode ediliyor ve URL'den parametrelerin olduğu kısım çekiliyor ($par)
     * $parameters değişkenine array şeklinde parametreler aktrılıyor
     *
     * explode ile parametre kısmını önce $par'a almıştık
     * router ile url 'yi match etmek için url'nin parametresiz haline ihtiyaç var bunun için parametre($par) ile URL'yi explode ediyoruz
     * öncesinde eğer url'ye parametresiz giriş yapılmışsa $new_path'e direk URL'yi aldık eğer parametre varsa üst satırda bahsedilen işlem yapılıyor.
     *
     * @param $request GET|POST
     * @param $pattern /test | /profile/user/34
     * @param $callable HomeController@index | Closure
     */

    //$pattern değişkeni nasıl dizi oluyor? - değişken falan değil var olan her route için bu metod çalışıyor
    public function route($request, $pattern, $callable)
    {
        global $route; //bu ne şimdi?

        $path_info = isset($_GET['url']) ? "/" . rtrim($_GET['url'], "/") :  '/';

        if (preg_match('@(.*)\w+\/{@', $pattern, $r) && $route && $_SERVER['REQUEST_METHOD'] == $request) {

            /* üstteki preg url yi parametreden istediğim gibi arındırmıyor var_dump($r); */
            $q = explode("{", $r[0]);
            $router = rtrim($q[0], "/");

            @list($full_url, $par) = explode($router, $path_info); //buradaki hatayı incele
             $parameters = explode("/", $par); //bu hatayı irdele
            array_shift($parameters);

            if(empty($par))
            {
                $new_path = $path_info;
            }else {
                /**
                 * @array $par
                 */
                list($new_path,$_t) = explode($par, $path_info);
            }

            if (preg_match("~^$router$~s", $new_path, $param) && $route && $_SERVER['REQUEST_METHOD'] == $request)
            {
                /* CSRF Validation */
                Token::check($request);

                /* Call Pages and Run Controller */
                Call::calling($callable, $parameters);

                $this->status = true;
            }

        }else {

            /* route sayfasından gönderilen url, path_info[get] değişkenindeki url ile eşleşirse sayfa çağrılıyor */
            if (preg_match("~^$pattern$~s", $path_info, $param) && $route && $_SERVER['REQUEST_METHOD'] == $request)
            {
                /* CSRF Validation */
                Token::check($request);

                /* Call Pages and Run Controller */
                Call::calling($callable);

                $this->status = true;
            }

        }

    }

    function __destruct()
    {
        if ($this->status === false)
        {
            /* Gelen URL'ye karşılık bir sayfa çağrılmamış demektir. */
            echo "böyle bir router yok";
        }
    }

}

?>
