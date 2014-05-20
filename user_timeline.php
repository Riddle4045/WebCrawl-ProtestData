<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "2451534170-ISETliFOuTR2BYoVSLCqZO8tRrOmSX7SfMcuECa",
    'oauth_access_token_secret' => "mRB9c9deqEdSIjblXf6wgm05N6fizKJohNFykYfjFuWYx",
    'consumer_key' => "isYSRFHsJGZeklzczLtNXbA8V",
    'consumer_secret' => "YAW2RhMjHiWJ3V3YJnm9yf5AZ2HdstszxTLJpAdaOq9j2Todon"
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/blocks/create.json';
$requestMethod = 'POST';

/** POST fields required by the URL above. See relevant docs as above **/
$postfields = array(
    'screen_name' => 'I_riddle_dev', 
    'skip_status' => '1'
);

/** Perform a POST request and echo the response **/
$twitter = new TwitterAPIExchange($settings);
//echo $twitter->buildOauth($url, $requestMethod)
//             ->setPostfields($postfields)
 //            ->performRequest();

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
/**
$url = 'https://api.twitter.com/1.1/followers/ids.json';
$getfield = '?screen_name=J7mbo';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
echo $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
**/

//URL for searching tweets using hashtags
//$url = 'https://api.twitter.com/1.1/search/tweets.json';

//URL for retrieveing tweets for a user (user_d)

$url  = 'https://api.twitter.com/1.1/statuses/user_timeline.json';


//combiging the getfield in a string array , well just add the hashtags and then query them one by one.
//$getfield = array(1=>'?q=#KXLDissent',2=>'?q=#RejectandProtect',3=>'?q=#CowboyIndianAlliance',4=>'?q=#nokxl',5=>'?q=#OilSands',6=>'?q=#KeystoneXL');
//$getfield = '?q=#KXLDissent';
//$getfield = '?q=#RejectandProtect';
//$getfield = '?q=#CowboyIndianAlliance';
//$getfield = '?q=#nokxl';
//$getfield   = '?q=#OilSands';
//$getfield  = '?q=#KeystoneXL';
//$getfield = array(1=>'?q=#testwithImage');

//The following getfield is set for retrieving all the tweets from a user 

$screen_name = $argv[1];

$getfield = '?screen_name=I_riddle_dev&count=200&include_rts=1';
echo $getfield;

/*foreach( $getfield as $k => $v){
//		echo $v;	
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($v)
                    ->buildOauth($url, $requestMethod)
                   ->performRequest();
//var_dump(json_decode($response));
$json_data = json_decode($response);
var_dump($json_data);
foreach( $json_data->statuses as $status ) {
		//echo $status->created_at;
		echo "\n";
		$hashstring = $status->created_at;
	//	echo $hashstring;
		//echo "\n";
		$hashValue = hash("md5",$hashstring);
		echo '"';
		echo   $hashValue ; echo '" : "';
		echo $status->text; echo '"';
		echo "\n";
		if ( array_key_exists("media",$status->entities)) 
						{	
		foreach($status->entities->media as $images)	
						{ 
				if ( $images->media_url != ""){
 			      			$mediaUrl = $images->media_url;
        				        $cmd = "wget --quiet -O\t".$hashValue.".png\t". $mediaUrl;
        		  	                exec($cmd); echo "\n";
			}

}
}
	//	$mediaUrl = $status->media->media_url;
	//	$cmd = "wget -O".$hashValue.".png". $mediaUrl;
	//	echo $cmd;
}*/

$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                   ->performRequest();
//var_dump(json_decode($response));
$json_data = json_decode($response);
var_dump($json_data);


  
