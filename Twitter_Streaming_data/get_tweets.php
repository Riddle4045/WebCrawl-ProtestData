<?php


require_once('tmhOAuth.php');

//TODO: openup the socket 
//TODO : read from the socket
//TODO : process the data



//lets open up the socket to read data from ..
//resouce url for making the connection
$url = 'https://stream.twitter.com/1.1/statuses/filter.json';
$username = 'I_riddle_dev'; // replace with your account
$password = 'Luk34tac'; // replace with your account

$isLoginSucess = false;
$_keywords = array('#Bresil','#OpWorldCup','#OpWorldCup2014','#FIFAgoHome','#WorldCup2014','#NAOVAITERCOPA','#NaoVaiTerFIFA','#NoWorldCup','#WeNeedFoodNoFootball','#Brasil2014','#Brazil','#FIFA','#NaoWorldCup','#VemPraRua','#Weltmeisterschaft','#μουντιάλ','#mondiali','#mundial','#BecauseFutbol','#BoycottBrazil2014','#OpBoycottCup','#NÃOVAITERCOPA','#NOFIFA');

//setting up the Auth params
$_consumer_key = "isYSRFHsJGZeklzczLtNXbA8V";
$_consumer_secret = "YAW2RhMjHiWJ3V3YJnm9yf5AZ2HdstszxTLJpAdaOq9j2Todon";
$_token = " 2451534170-ISETliFOuTR2BYoVSLCqZO8tRrOmSX7SfMcuECa";
$_token_secret = "mRB9c9deqEdSIjblXf6wgm05N6fizKJohNFykYfjFuWYx";

//config required to construct the tmhOAuth object.

$config = array(
           'host'=> 'stream.twitter.com',
           'consumer_key'               => 'isYSRFHsJGZeklzczLtNXbA8V',
            'consumer_secret'            => 'YAW2RhMjHiWJ3V3YJnm9yf5AZ2HdstszxTLJpAdaOq9j2Todon',
            'token'                      => '2451534170-ISETliFOuTR2BYoVSLCqZO8tRrOmSX7SfMcuECa',
            'secret'                     => 'mRB9c9deqEdSIjblXf6wgm05N6fizKJohNFykYfjFuWYx');

$twitter = new tmhOAuth($config);

$method = 'POST';
$params = array('track'=>"facebook");
$twitter->streaming_request($method,$url,$params,'streamRequestCallBack');

function streamRequestCallBack($data) {
	var_dump($data);
}
