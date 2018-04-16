<?php
/* Bu  Bir DBAL yani Veritabanı Soyutlama Katmanı Örneğidir */
/* bir veritabanı driver'ını üzerine çeken  bir sınıf oluşturup orada özelleştirilmiş metodlarda oluşturup o sınıfı kullanırız */

/* Singleton PDO Class Örneği */

namespace Core\Database;
/*namespace ile kullanmaya başlayınca  '..name is already in use..' hatası veriyordu
  use PDO ekleyince başka sayfalarda namespace ile çalıştı*/
use PDO;

class DB
{
    private static $instance = null;

    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "";
    private static $dbname = "test_slim_pdo";

    private function __construct()
    {

    }

    public static function getInstancePDO()
    {
        if(!self::$instance)
        {
            echo "asdasd";
            self::$instance = new PDO('mysql:host='.self::$host.";dbname=".self::$dbname, self::$user, self::$pass);
            self::$instance->exec("SET NAMES utf-8");
            return self::$instance;
        }

        return self::$instance;
    }


    public static function add()
    {
        self::$instance->query("INSERT INTO users('user_name') VALUES ('testttt')");
    }

     private function __clone(){ }
     private function __wakeup(){ }
}

$db = DB::getInstancePDO();
/*
 * bu iki insert çalışmadı?
$db->query("INSERT INTO users('user_name') VALUES ('testttt')");
-veya-
$statement = $db->prepare("INSERT INTO users VALUES(:isim)");
$statement->execute(array(
    "isim" => "Bob"
));*/

/* insert3 - bu çalışıyor
$statement2 = $db->prepare("INSERT INTO users (user_name)
    VALUES(?)");
$statement2->execute(array("Bob"));
*/


/* buna neden ulaşamıyoruz? */
//$db->add();


/* Diğer sayfalarda kullanım */
/*
use App\Core\Database\DB;

$db = DB::getInstancePDO();

$ls = $db->query("SELECT * FROM users");
    foreach ($ls as $l) {
    var_dump($l);
}

 */
