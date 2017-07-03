<?php
namespace App\Core\Src;

class Cache
{
    public $key;
    public $value;
    public $time;
    public $cacheKey;

   /*
    $cache = new Cache();

    if($cache->get("user-name") == false)
    {
        $name = "test name";
        $cache->set("user-name",$name,"60");
    }

    $data = $cache->get("user-name");
   */

    public function set($key,$value,$expiration = 0)
    {
        $this->key = $key;
        $this->value = $value;
        $this->time = $expiration;

        if(in_array($this->key, $this->cacheKey) == false)
        {
            $this->cacheKey[$this->key] = $this->time;
        }

        $cacheFile = APP . "Cache/" . md5($this->key) . ".html";

        if(file_exists($cacheFile))
        {
            unlink($cacheFile);
        }

        $data = serialize($this->value);

        //file_put_contents ~=  fopen(), fwrite() ve fclose()-eğer dosya yoksa oluşturur
        file_put_contents($cacheFile, $data, LOCK_EX);
    }

    public function get($key)
    {
        $this->key = $key;

        $cacheFile = APP . "Cache/" . md5($this->key) . ".html";

        if(file_exists($cacheFile))
        {
            if(time() > @filemtime($cacheFile) + $this->cacheKey[$this->key])
            {
                echo "cache var";
                $content = unserialize(file_get_contents($cacheFile));
                return $content;
            }else {
                unset($cacheFile);
            }
        }else {
            return false;
        }
    }

}