<?php
namespace App\Core\Src;

class Cache
{
    public $cacheData;

    function __destruct()
    {
        var_dump($this->cacheData);
    }

    public function set($key,$value,$expiration = 0)
    {
        $file = $this->getDir($key);

        unset($this->cacheData[$key]);

        $setData = array(
            'expire' => $expiration,
            'data' => serialize($value)
        );

        $this->cacheData[$key] = $setData;

        if(is_array($this->cacheData[$key]))
        {
            if(file_exists($file))
            {
                //dosya varsa dosyanın son değiştirilme tarihine bakıyoruz cache süresi geçmişse yeniden yazıyor
                if($this->is_expire($key) == false) //!file_exist($file)
                {
                    unlink($file);
                    //file_put_contents ~=  fopen(), fwrite() ve fclose()-eğer dosya yoksa oluşturur
                    $this->write($key);
                }
            }else {
                //dosya yoksa set geldiğinde dosya ilk defa oluşturulmuş olacak
                $this->write($key);
            }
        }
    }

    public function get($key)
    {
        $file = $this->getDir($key);

        if(file_exists($file))
        {
            if($this->is_expire($key))
            {
                echo "-cache var </br>";
                $content = unserialize(file_get_contents($file));
                return $content;
            }else {
                return false;
            }
        }else {
            return false;
        }
    }

    /**
     * @param $key
     * @return string cache file path
     */
    public function getDir($key)
    {
        return APP . "Cache/" . md5($key) . ".html";
    }

    /**
     * @param $key
     * write the value on the cache file
     */
    public function write($key)
    {
        file_put_contents($this->getDir($key), $this->cacheData[$key]['data'], LOCK_EX);
    }

    /**
     * @param $key
     * @return boolean is file exp?
     */
    public function is_expire($key)
    {
        if(time() < filemtime($this->getDir($key)) + $this->cacheData[$key]['expire'])
        {
            return true;
        }

        return false;
    }

}