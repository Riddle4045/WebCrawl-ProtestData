<?php 

$m = new MongoClient();

$db = $m->mydb;

$collection = $db->testdata;
// find everything in the collection
$cursor = $collection->find();

// iterate through the results
foreach ($cursor as $document) {
    print_r($document);
}
