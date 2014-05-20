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


//URL for retrieveing tweets for a user (user_d)
$url  = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

//The following getfield is set for retrieving all the tweets from a user 
$getfield = '?screen_name=I_riddle_dev&count=200&include_rts=1';

//TODO : get all the tweets
//Currently only first 200 tweets are retireveed using the "count" parameter.
//Use the  "since_id" and "max_id" parameters and make repeated requests to  to get  all the tweets
//refer to the following link for the statergy :https://dev.twitter.com/docs/working-with-timelines
//use the code from index.php to download all the media w.r.t to a tweet 
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                   ->performRequest();
//var_dump(json_decode($response));
$json_data = json_decode($response);
var_dump($json_data);


  
