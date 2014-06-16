<?php

require_once('tmhOAuth.php');

//TODO: openup the socket 
//TODO : read from the socket
//TODO : process the data


//lets open up the socket to read data from ..

//resouce url for making the connection
$url  = 'https://stream.twitter.com/1.1/statuses/filter.json';

set_time_limit(0);
$query_data = array('track' => 'facebook');
$user = 'I_riddle_dev';	// replace with your account
$pass = 'Luk34tac';	// replace with your account
$fp = fsockopen("ssl://stream.twitter.com", 80, $errno, $errstr, 30);
if(!$fp){
	echo "inside '!$ fp'";
	print "$errstr ($errno)\n";
} else {
	$request = "GET /1/statuses/filter.json?" . http_build_query($query_data) . " HTTP/1.1\r\n";
	$request .= "Host: stream.twitter.com\r\n";
	$request .= "Authorization: Basic " . base64_encode($user . ':' . $pass) . "\r\n\r\n";
	fwrite($fp, $request);
	while(!feof($fp)){
		$json = fgets($fp);
		$data = json_decode($json, true);
		if($data){
			//
			// Do something with the data!
			//
		var_dump($data);
		}
	}
	fclose($fp);
}



