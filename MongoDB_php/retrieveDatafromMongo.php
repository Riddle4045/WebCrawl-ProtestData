
<?php

	
		$n =  new MongoClient(); 	
		$dbname = "wsd"; 	
		$db = $n->$dbname; //get the collections.. 
		$list = $db->listCollections();
	 //	$collection = $db->raretweets; 
	//	$collection2 = $db->tweets;



		//make the regex object that contiains the qyery 
		//in this case the request is the text containg keyword.
        //$keywords = array("band","bank","bass","crane","mouse","chip","tank","plant");
		$keywords = array("bass","face","mouse","speaker","watch"); //new keywords that are used in Dr. Kate's paper.
		foreach($keywords as $keyword){
			writeTexttoFile($list,$keyword);
		}		




  // the function takes in a list of collections a keyword 
 // it searches for the query object agains the collection  gets the text back and writes it to a file
		function writeTexttoFile($list,$keyword){		
		$regex = "/".$keyword."/i";
        $regexObj = new MongoRegex($regex);
        $where = array("text" => $regexObj);

     
	//browse through all the collections that we want to search
        foreach ($list as $collection) {
                if ( $collection == 'wsd.raretweets' || $collection == 'wsd.tweets ' || $collection == 'wsd.new_data'){ 
                $cursor =$collection->find($where);
				$cursor->timeout(-1);
                while ( $cursor->hasNext() ) {
                        $document = $cursor->getNext();
                        $text = $document['text'];
						$tweet = $text;

/**						$result = preg_replace("/[^a-zA-Z0-9]+/", " ", $tweet);
						$resutl =  preg_replace('/\s+/', ' ',$result);
						$result =  str_replace(' ', '_',$result);  **/
						//str_replace(" ","_",$tweet);
//						echo $tweet;
//						echo "\n";
						$text = $text."\n";
						$numWords = getWordLength($text);
						$entities = $document['entities'];
	//					downLoadImage($entities,$text,$keyword);	
						$path = $keyword.".txt";
						$user = $document['user'];
						$lang = $document['lang'];
	//					print_r($lang);	
					//get the text and append it to a file $keyword.txt , where keywords are different words we are looking for.
						if ( $lang == "en") {
								$id = $document['id'];
								$text = $id." : ".$text;
								echo $text;
								//file_put_contents($path,$text,FILE_APPEND);
								if(hasImage($entities)){
									//	downLoadImage($entities,$result,$keyword);
								}
					}
						
						    
    }
}
}
	return $frequencies;
}
//get number of words in a sentence.
function getWordLength($text) {

			$num  = str_word_count($text);
			return $num;

	}
function hasImage($entities){
			if ( $entities['media'] != NULL ){
						$media = $entities['media'];
						foreach ( $media as $data){
									if ( $data['media_url'] != ""){
												return true;
									}
						}
						
			}
			return false;
}

function downLoadImage($entities,$id,$keyword) {
		

		if( $entities['media'] != NULL){
						$media = $entities['media'];
						foreach ( $media as $data)  {
									if ( $data["media_url"] != "" ){
									$mediaUrl = $media[0]["media_url"];
         						   $cmd = "wget --quiet -O\t" . $keyword . "_" . $id . ".jpg\t" . $mediaUrl;
         						   	echo $cmd;
         						 // exec($cmd);
       							     echo "\n";
        
    }
}
}
}

?>

