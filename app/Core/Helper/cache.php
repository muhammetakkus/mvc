<?php
namespace Helper;

/* Sorun1 = üstte get tanımlayıp altta kontrol yapılıyor.
            Sayfayı ilk açıldığında set işlemi olduğu için değer geti alan değişkene depolanamıyor
            ve ekrana ilk açıldığında bir şey basılamıyor sadece set işlemi yapılıyor
            2. açılışta key olduğu için get işlemi datayı dönderiyor ekrana basılabiliyor */

/* Sorun2 = set'e gönderilen key değerlerini tutan array sadece set içerisinde keyleri tutuyor
            örneğin __construct'a var olan keyleri bas diyemiyoruz? glob() ile ekrana basıyor ancak boş?

 * */
/*
    $cache = new Cache();

    $val = $cache->get("test_key",30);

    if(!$val)
    {
        $user = "test user name or array?";

        $cache->set('test_key', $name);
    }

    echo $val;
 */

class Cache
{
    public $cacheData;
    private $cacheDirectory = APP . "Cache";
    private $cacheExp = 900; /* 15 minutes */

    function __destruct()
    {
        var_dump($this->cacheData);
    }

    /* set işlemi yaparken kontrol yapmadan yazıyoruz - get($key,$exp) fonksiyonunun false olduğu durumda kullanılacak */
    public function set($key,$value,$expiration = null)
    {
        /* Eğer süre verilmişse cache süresi tutan varaible verilen süre olsun  */
        if ($expiration != null)
            $this->cacheExp = $expiration;

        /* setData değişkeni gelen cache süresi ve cache datasını serialize ederek tutuyor */
        $setData = array(
            'expire' => $this->cacheExp,
            'data' => serialize($value)
        );

        /* her key cacheData değişkeninin anahtarı olarak 2 value-key li setData arrayını tutsun */
        $this->cacheData[$key] = $setData;

        if ($this->write($key)) {
            //başarılı ise devam edipte alttaki false ile bitmesin diye func. burada bitiriyoruz
            return true;
        }

        return false;
    }

    public function get($key, $expiration = null)
    {
        if ($expiration != null)
            $this->cacheExp = $expiration;

        if(file_exists($this->getDir($key)))
        {
            if($this->is_expire($key, $this->cacheExp))
            {
                $content = unserialize(file_get_contents($this->getDir($key)));
                return $content;
            }
        }

        return false;
    }

    /**
     * @param $key
     * @return string cache file path
     */
    public function getDir($key)
    {
        return $this->cacheDirectory . DIRECTORY_SEPARATOR . md5($key) . ".html";
    }

    /**
     * @param $key
     * write the value on the cache file
     */
    public function write($key)
    {
        file_put_contents($this->getDir($key), $this->cacheData[$key]['data'], LOCK_EX);
        return true;
    }

    /**
     * @param $key
     * @return boolean is file exp?
     */
    public function is_expire($key, $exp)
    {
        /* eğer cache süresi bitmemişse - hala cache tutulacaksa */
        if(time() < filemtime($this->getDir($key)) + $exp)
        {
            return true;
        }

        return false;
    }

}
