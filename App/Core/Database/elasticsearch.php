<?php
/* cliente bağlantı kuruluyor ancak kullanımda  tamamen url'ye bağlı bir durum var sanırım?? */
use Elasticsearch\ClientBuilder;

$client = ClientBuilder::create()->setHosts(["127.0.0.1:80"])->build();

//
$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id',
    'body' => ['testField' => 'abc']
];

$response = $client->index($params);
print_r($response);
