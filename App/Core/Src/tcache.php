<?php
/**
 * Pratik Önbellekleme (Cache) Sınıfı
 * @author Yılmaz Demir
 * @link http://yilmazdemir.com.tr
 * @version 0.1
 */

class Cache {
    /**
     * Önbellek dosyalarının depolandığı klasör dizgesi
     * @var string
     */
    public $path;

    /**
     * Önbellek dosyasının adı
     * @var string
     */
    public $name;

    /**
     * Sınıf başlatıcı
     * @param array $config
     * @return void
     */
    public function __construct($conf = array())
    {
        if (!empty($conf) && is_array($conf)) {
            $this->path = $conf['path'];
            $this->name = $conf['name'];
        } else {
            throw new Exception('Önbellek ayarları yapılmamış');
        }
    }

    /**
     * Yeni önbellek tanımlama metodu
     * @param string $key Anahtar adı
     * @param mixed $value Anahtar değeri
     * @param int $timestamp Anahtar depolama süresi
     * @return object
     */
    public function set($key, $value, $timestamp=0)
    {
        $setData = array(
            'time' => time(),
            'expire' => $timestamp,
            'data' => serialize($value)
        );

        $cacheData = $this->load(); //if exist  - file get contents($filename)
        if (is_array($this->load())) {
            $cacheData[$key] = $setData;
        } else {
            $cacheData = array($key => $setData);
        }

        $cacheData = json_encode($cacheData);

        file_put_contents($this->getDir(), $cacheData);
        return $this;
    }

    /**
     * Anahtara göre kontrol edip varsa anahtar değerini döndüren
     * yoksa oluşturup değeri döndüren method
     * @param string $key Anahtar adı
     * @param mixed $value Anahtar değeri
     * @param int $timestamp Anahtar depolama süresi
     * @return mixed Anahtar değeri
     */
    public function setOrGet($key, $value, $timestamp=0)
    {
        if ($this->has($key)) {
            return $this->get($key);
        } else {
            $this->set($key, $value, $timestamp);
            return $this->get($key);
        }
    }

    /**
     * Önbellek tanımlanmış mı kontrol eden method
     * @param string $key Anahtar adı
     * @return boolean
     */
    public function has($key)
    {
        if ($this->load()) {
            $data = $this->load();
            return isset($data[$key]['data']);
        }
        return false;
    }

    /**
     * Önbelleğe alınmış değeri ve zamanı döndüren method
     * @param string $key Anahtar adı
     * @param boolean $timestamp Zaman döndürme seçeneği
     * @return mixed
     */
    public function get($key, $timestamp = false)
    {
        $cacheData = $this->load();

        if (
            !isset($cacheData[$key]['data']) ||
            !isset($cacheData[$key]['time'])
        ) return null;

        if ($timestamp) {
            return $cacheData[$key]['time'];
        } else {
            return unserialize($cacheData[$key]['data']);
        }
    }

    /**
     * Önbelleğe alınmış değeri kaldıran method
     * @param string $key Anahtar adı
     * @return object
     */
    public function erase($key)
    {
        $cacheData = $this->load();
        if (is_array($cacheData)) {
            if (isset($cacheData[$key])) {
                unset($cacheData[$key]);
                $cacheData = json_encode($cacheData);
                file_put_contents($this->getDir(), $cacheData);
            } else {
                throw new Exception('Silinmek istenen önbelleğe erişilemedi.');
            }
        }
        return $this;
    }

    /**
     * Önbelleğe alınmış ve süresi geçmiş değerleri kaldıran method
     * @return int
     */
    public function eraseExpired()
    {
        $cacheData = $this->load();
        if (is_array($cacheData)) {
            $counter = 0;
            foreach ($cacheData as $key => $entry) {
                if ($this->checkExpired($entry['time'], $entry['expire'])) {
                    unset($cacheData[$key]);
                    $counter++;
                }
            }

            if ($counter > 0) {
                $cacheData = json_encode($cacheData);
                file_put_contents($this->getDir(), $cacheData);
            }
            return $counter;
        }
    }

    /**
     * Önbelleğe alınmış değerlerin hepsini kaldıran method
     * @return object
     */
    public function eraseAll()
    {
        $cacheDir = $this->getDir();
        if (file_exists($cacheDir)) {
            $cacheFile = fopen($cacheDir, 'w');
            fclose($cacheFile);
        }
        return $this;
    }

    /**
     * Önbelleğe alınmış dosyaları silen method
     * @return boolean
     */
    public function destroyAll()
    {
        if ($this->checkDir()) {
            foreach (new DirectoryIterator($this->path) as $fileInfo) {
                if(!$fileInfo->isDot()) {
                    unlink($fileInfo->getPathname());
                }
            }
            return true;
        }
    }

    /**
     * Verilen değerlere göre sürenin geçip geçmediğini kontrol eden metod
     * @param int $timestamp Zaman damgası
     * @param int $exp Silinme zamanı
     * @return boolean
     */
    private function checkExpired($timestamp, $exp)
    {
        $result = false;
        if ($exp !== 0) {
            $timeDiff = time() - $timestamp;
            $result = ($timeDiff > $exp) ? true : false;
        }
        return $result;
    }

    /**
     * Önbellek dosyasını döndürüp, değeri Json kodunu çözüp
     * dizi haline döndüren method
     * @return array|boolean
     */
    public function load()
    {
        if (file_exists($this->getDir())) {
            $file = file_get_contents($this->getDir());
            return json_decode($file, true);
        }
        return false;
    }

    /**
     * Önbellek dosyasının var olup olmadığını kontrol eden
     * ve dosyayın yerini döndüren metod
     * @return string|boolean
     */
    public function getDir()
    {
        if ($this->checkDir()) {
            return $this->path . '/' . $this->getHash($this->name) . '.cache';
        }
        return false;
    }

    /**
     * Önbellek dosyalarının depolandığı dizini kontrol eden metod
     * @return boolean
     */
    public function checkDir()
    {
        if (!is_dir($this->path)) {
            throw new Exception('Önbellek klasörü bulunamadı');
        } else if (!is_readable($this->path) || !is_writable($this->path)) {
            if (!chmod($this->path, 0775)) {
                throw new Exception('Önbellek klasörünün dosya sistemi izinleri uygun değil');
            }
        }
        return true;
    }

    /**
     * Gelen değer SHA1 ile şifreler
     * @param string $text
     * @return string
     */
    public function getHash($text)
    {
        return sha1($text);
    }

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}