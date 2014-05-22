<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
 $settings = array(
    'oauth_access_token' => "..-..",
    'oauth_access_token_secret' => "..",
    'consumer_key' => "..",
    'consumer_secret' => ".."
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

$users = array(1=>'CamThompsonWNEW',2=>'Organizerx',3=>'Cool_Revolution',4=>'johnzangas',5=>'rousseau_ist',6=>'Gen_Knoxx',7=>'jamesFTinternet',7=>'@Agent350',8=>'ARStrasser',9=>'johnzangas',10=>'350',10=>'bri_xy');
$keywords = array(1=>'?q=#KXLDissent',2=>'?q=#RejectandProtect',3=>'?q=#CowboyIndianAlliance',4=>'?q=#nokxl',5=>'?q=#OilSands',6=>'?q=#KeystoneXL',7=>'#NoKXL');
foreach($users as $user){
    getAllData($user);
}
function processData($json_data){
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
} }
}

function getAllData($user) {
$first_getfield = '?screen_name='.$user.'&count=200&include_rts=1';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($GLOBALS['settings']);
$response = $twitter->setGetfield($first_getfield)->buildOauth($GLOBALS['url'], $requestMethod)->performRequest();
$json_data = json_decode($response);


processData($json_data);

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
