<?php

/* MongoDB extension in php.ini and composer require mongodb -dont forget them*/

// connect to mongodb
//$m = new MongoClient(); bu eski
//$n = new \MongoDB\Driver\Manager(); bu yeni
$client = new MongoDB\Client("mongodb://localhost:27017"); //sen bunu kullan


// select a database
$db = $client->mydb;
echo "Database mydb selected";

// create collection
$collection = $db->createCollection("mycol");
echo "Collection created succsessfully";

/*
    MongoDB Nosql veri tabanı olduğu için tablo diye bir şey yok.
    DB oluşturuyoruz/seçiyoruz
    Collection oluşturuyoruz verilerimizi ona ekliyoruz
    yukarıdaki gibi bir kere db yi oluşturmak ve collection'u oluşturmak yeterli bu kodları bir kere çalıştırdıktan sonra
    silebiliriz mevzubahis db ve collection oluşturulmuş olur..
*/

//database'den collection kaldırmak için
$db->dropCollection('testCollection');

//insert
$document = array(
    "title" => "MongoDB",
    "description" => "database",
    "likes" => 100,
    "url" => "http://www.tutorialspoint.com/mongodb/",
    "by", "tutorials point"
);

$collection->insertOne($document);
echo "Document inserted successfully";


//select işlemi find ile yapılıyor
$data = $collection->find();
foreach ($data as $item) {
    var_dump($item);
}

/* phpdb database'inin collectionlarını görelim */
foreach ($client->phpdb->listCollections() as $item)
{
    var_dump($item);
}

//$client->database->collection

/* http://php.net/manual/en/mongodb-driver-manager.executequery.php - bu kullanımlar? */