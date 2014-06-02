<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');




//TODO : retireve @user from retweets
//TODO : INCLUDE stopping condition
//TODO : beig iterating over  @user_data


/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
 $settings = array(
    'oauth_access_token' => "2451534170-ISETliFOuTR2BYoVSLCqZO8tRrOmSX7SfMcuECa",
    'oauth_access_token_secret' => "mRB9c9deqEdSIjblXf6wgm05N6fizKJohNFykYfjFuWYx",
    'consumer_key' => "isYSRFHsJGZeklzczLtNXbA8V",
    'consumer_secret' => "YAW2RhMjHiWJ3V3YJnm9yf5AZ2HdstszxTLJpAdaOq9j2Todon"
);

//URL for retrieveing tweets for a user (user_d)
$url  = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$max_id = 0;


/**
 * Currently only first 200 tweets are retireveed using the "count" parameter. 
 * Use the  "since_id" and "max_id" parameters and make repeated requests to  to get  all the tweets. 
 * refer to the following link for the statergy :https:dev.twitter.com/docs/working-with-timelines use the code from index.php to download all the media w.r.t to a twe
 * 
 * 
 * first_getfield is call without the max_id or since ID , once we get a json object from the first call
 * the max_id and since_id are determined 
 */
$num_tweets = 0;
$num_images = 0;
$new_users = array();
$pattern = "/[@][A-Za-z0-9]+/";
$processed_users = array();
$processed_user_count = 0;
$num_elements_in_new_user= count($new_users);
function addNewUsers($string){
	$user_list = array();
	//$pattern = "/[@][A-Za-z0-9]+/";
	if ($GLOBALS['num_elements_in_new_user'] < 500 ) {
			if( preg_match_all($GLOBALS['pattern'],$string,$matches)){
	     				 foreach($matches[0] as $k => $v ) {
							//getAllData($v);
							$list_size = array_push($user_list,$v);											          	    $GLOBALS['num_elements_in_new_user'] =array_push($GLOBALS['new_users'],$v);
							}
}
}
}

$users = array(1=>'@CamThompsonWNEW',2=>'@Organizerx',3=>'@Cool_Revolution',4=>'@johnzangas',5=>'@rousseau_ist',6=>'@Gen_Knoxx',7=>'@jamesFTinternet',8=>'@Agent350',9=>'@ARStrasser',10=>'@johnzangas',11=>'@350',11=>'@bri_xy');
$keywords = array(1=>'?q=#KXLDissent',2=>'?q=#RejectandProtect',3=>'?q=#CowboyIndianAlliance',4=>'?q=#nokxl',5=>'?q=#OilSands',6=>'?q=#KeystoneXL',7=>'#NoKXL');


foreach($users as $user){
	if ( ! in_array($user,$GLOBALS['processed_users'])){
 //			   echo "Processing user...".$user;
			   getAllData($user);
}
}

//print_r($new_users);

function processData($json_data,$user){

foreach( $json_data as $status ) {
        //echo $status->created_at;
        //echo "\n";
        $hashstring = $status->created_at;
    //  echo $hashstring;
        //echo "\n";
        if ( $status->id >$GLOBALS['max_id'] ) {
                        $max_id = $status->id;
        }
        
        $is_keyStone = false;
        foreach ( $GLOBALS['keywords'] as $keyword ){
                    if (strpos($status->text , $keyword)) {
				
								$is_keyStone = true;
}
        }
        if ($is_keyStone){
        $hashValue = hash("md5",$hashstring);
        echo "\n";
	echo '"';
        echo   $hashValue ; echo '" : "';
        echo $status->text; echo '"';
        echo "\n";
	$GLOBALS['num_tweets'] = $GLOBALS['num_tweets']  + 1;
	$processed_user_count = array_push($GLOBALS['processed_users'],$user);
	addNewUsers($status->text);
        if ( array_key_exists("media",$status->entities))
                        {
        foreach($status->entities->media as $images)
                        {
                if ( $images->media_url != ""){
                            $mediaUrl = $images->media_url;
                                $cmd = "wget --quiet -O\t".$hashValue.".png\t". $mediaUrl;
                                exec($cmd); echo "\n";
				$GLOBALS['num_images'] = $GLOBALS['num_images'] + 1;
			 
            }

}
}
} }

}

function getAllData($user) {
$first_getfield = '?screen_name='.$user.'&count=200&include_rts=1';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($GLOBALS['settings']);
$response = $twitter->setGetfield($first_getfield)->buildOauth($GLOBALS['url'], $requestMethod)->performRequest();
$json_data = json_decode($response);

if ( !empty($json_data) ) {
processData($json_data,$user);
}
/**
 * getfield including the max_id for subsequent calls 
 */

if($GLOBALS['max_id'] != 0 ) {
        $new_getfield = '?screen_name='.$user.'&max_id='.$max_id.'&count=200&include_rts=1';
       // echo $new_getfield;
}else {
        $new_getfield = $first_getfield;
        $new_max_id  =  $GLOBALS['max_id'];
}


while (count((array)$json_data)&& $new_max_id != 0){
                $requestMethod = 'GET';
                $twitter = new TwitterAPIExchange($GLOBALS['settings']);
                $response = $twitter->setGetfield($new_getfield)->buildOauth($GLOBALS['url'], $requestMethod)->performRequest();
                $new_json_data = json_decode($response);
                if ( count((array)$new_json_data)){
                                    $new_max_id = $new_json_data[0]->id;
                                    $new_getfield = '?screen_name='.$user.'&count=200&include_rts=1&max_id='.$new_max_id;
                                //    echo $new_getfield;
                                    processData($new_json_data);
				
                }
}
}


foreach($new_users as $user) {
        if ( ! in_array($user,$GLOBALS['processed_users'],$user)){
    getAllData($user);
}
	
}

