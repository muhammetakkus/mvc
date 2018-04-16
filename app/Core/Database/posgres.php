<?php
/* connect ve select çalışıyor fakat insert yapmıyor? */

/* PHP + Posgresql */
$dbconn = pg_connect("host=localhost dbname=testposgres user=postgres password=mhmmt28") or die('posgres-bağlanılamadı');

/* select */
$query = 'SELECT * FROM test_posgres_table';
$result = pg_query($dbconn, $query);
$arr = pg_fetch_array($result, NULL, PGSQL_ASSOC);
var_dump($arr);

//insert işlemi çalışmıyor?
$query1 = "INSERT INTO test_posgres_table(user_name,id) VALUES ('1','2')";
$result1 = pg_query($dbconn, $query1);
var_dump($result1);

// Closing connection
pg_close($dbconn);



/* PDO + Posgresql */
$db = new PDO("pgsql:dbname=testposgres;host=localhost", 'postgres', 'mhmmt28');
$db->beginTransaction();

/* insert yapmıyor? */
$astmt = $db->prepare("INSERT INTO test_posgres_table VALUES (?,?,?,?,?)");
$astmt->execute(array("2", "2","2", "1","2"));
$db->commit();

/* select */
$sql_get_depts = "SELECT * FROM test_posgres_table";
$stmt = $db->query($sql_get_depts);
foreach ($stmt as $item) {
    var_dump($item);
}