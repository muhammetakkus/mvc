1- config.php 'deki $root_directory tanımlanmak zorunda

2- template @yield(x) - @section(x) - @stop şeklindedir
3- root() arasında yazılan url roter'da tanınlanmış olmalıdır. sadece root() -> / demektir
4- ASSET -> href="ASSET/css/x.css"  �eklinde kullan�l�r

5- cache kullanımı Cache::set(KEY,VALUE,TIME) şeklindedir. -- Cache::get("key"); ile oluşturulan değerin valuesine ulaşılır
    cache kullanmak için önce if(Cache::get("key") == false) ile key kontrolü yapılır key yok ise sorgu yapılıp dönen değer set edilir
    daha sonra değer set edilerek view'a gönderilir

6-CSRF-TOKEN her post formunda olmak zorunda yoksa csrf kontrolüne takılıyor -bunu opsiyonel yapamadım daha sonra bakılacak
  kullanmak için forma ->  <input type="hidden" name="=_token" value="<?php App\Core\Src\Token::create(); ?>" /> şeklinde dahil edilir