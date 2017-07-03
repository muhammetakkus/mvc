<?php

/*
 * should be extends to all Controller
 */

namespace App\Core;

class Controller
{
	public function model($model)
	{
		include_once MODEL . $model . '.php';
		return new $model;
	}

	public function view($file, array $data = array())
	{
		ob_start();
		extract($data, EXTR_SKIP);
		include VIEW . $file . '.php';
        //Geçerli sayfanın içeriğini döndürüp o içeriği siler
		//yani bir nevi içeriği değişkene almış oluyoruz
		//aslında şu ikisinin görevini yapıyor ob_get_contents() ve ob_end_clean()
		$content = ob_get_clean();
		if (ob_get_level() > 0) ob_flush();
		preg_match_all('/@section\((.*?)\)(.*?)@stop/ms', $content, $match);
		array_shift($match);
		$say = count($match);

		/*
		 * Buraya kadar sayfa çağrılıp var olan içerik $content değişkenine depolandı
		 * preg_match_all ile $match değişkenine içerikteki @section(x)'deki x değerleri ve eşleşen içeriği alındı
		 * ve for ile $c değişkenine x ve eşleşen değer ikilisi şeklinde array yapılıyor [content => html içeriği] gibi
		 * */
		for ($i = 0; $i < $say-1; $i++)
		{
			$c = array_combine($match[$i], $match[$i + 1]);
		}

		/*
		 * $c değişkenindeki key olan section keyleri ile eşleşen @yield(key) tanımları içerik ile değiştiriliyor
		 * */
		foreach ($c as $k => $v)
		{
      		$content = preg_replace("/@yield\($k\)/ms", $v, $content);
		}

		//@section ve @stop tanımları içerikten kaldırılıyor
		$content = preg_replace('/[\r\n]*@section.*?@stop[\r\n]*/ms', '', $content);
		
		//TAMPONLANAN ÇIKTI İÇERİĞİNDEKİ ASSET/ keywordünü ASSET define'ı ile değiştir
		$content = preg_replace('/ASSET\//ms', ASSET, $content);

		//TAMPONLANAN ÇIKTI İÇERİĞİNDEKİ roote() url lerini değiştir - route(burayı değişkene alıyor)
 		$content = preg_replace('/\broute\((.*)\)/', URL.'\1', $content);

		
		//@yield tanımları içerikten kaldırılıp ekrana basılıyor
    	echo preg_replace('/[\r\n]*@yield.*?\)[\r\n]*/ms', '', $content);

	}
}

?>
