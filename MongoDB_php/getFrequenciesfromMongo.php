


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
	//	writeTexttoFile($list,$keyword);
		$frequencies = getFrequencies($list,$keyword,$frequencies);
		}		

		print_r($frequencies);


//$list : list of collecitons in the mongo DB.
//$keywords : list of keywords we are looking for 
function getFrequencies($list,$keyword,$frequencies){
//get the frequencies of all the keywords..
		$regex = "/".$keyword."/i";
        $regexObj = new MongoRegex($regex);
        $where = array("text" => $regexObj);
		$count = 0;
		//browse through all the collections that we want to search
        foreach ($list as $collection) {
                if ( $collection == 'wsd.raretweets' || $collection == 'wsd.tweets ' || $collection == 'wsd.new_data'){ 
                $cursor =$collection->find($where);
				$cursor->timeout(-1);
                while ( $cursor->hasNext() ) {
                        $document = $cursor->getNext();
                        $text = $document['text'];
						$tweet = $text;
						$text = $text."\n";
						$entities = $document['entities'];
						$path = $keyword.".txt";
						$user = $document['user'];
						$lang = $document['lang'];
					//get the text and append it to a file $keyword.txt , where keywords are different words we are looking for.
						if ( $lang == "en") {
								$id = $document['id'];
								$text = $id." : ".$text;
								$count = $count + 1;
								$frequencies[$keyword] = $count;
								//file_put_contents($path,$text,FILE_APPEND);
					}
						
						    
    }
}
}
	return $frequencies;

}

?>
