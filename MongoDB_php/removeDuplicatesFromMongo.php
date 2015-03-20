
<?php

	
		$n =  new MongoClient(); 	
		$dbname = "wsd"; 	
		$db = $n->$dbname; //get the collections.. 
		$list = $db->listCollections();
	 //	$collection = $db->raretweets; 
	//	$collection2 = $db->tweets;
		$frequencies = array();


		//make the regex object that contiains the qyery 
		//in this case the request is the text containg keyword.
        //$keywords = array("band","bank","bass","crane","mouse","chip","tank","plant");
		$keywords = array("bass","face","mouse","speaker","watch"); //new keywords that are used in Dr. Kate's paper.
		foreach($keywords as $keyword){
				removeDuplicates($list,$keyword);
		}		

		print_r($frequencies);


/**
* Function to remove Retweets i.e tweets with same content.
**/
function removeDuplicates($list,$keyword){

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
						$id = (string)$document['_id'];
						$isReTweet = preg_match('/\s*RT/',$tweet);
						if ( $isReTweet == 1){
									echo "inside if: ".$tweet."\n";
									removeEntryFromMongo($id,$collection);
						}
    }
}
}
}

function removeEntryFromMongo($id,$collection){
			echo "Removing mongoID :" . $id."\n";
			$del = $collection->remove(array('_id' =>  new mongoID($id)),array("justOne"=>true));
			var_dump($del);
} 	

?>

