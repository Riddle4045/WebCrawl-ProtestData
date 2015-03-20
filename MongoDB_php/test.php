<?php
		$a  =  "RT @missnatalienunn: On facetime CRACKIN UP !! Making moves work work work watch us make these REAL BAD GIRL MOVES! http://t.co/aJ9rPojZ83";
		$pattern  = "RT";
		$matches = array();
		$ye = preg_match('/\s*RT/', $a ,$matches); 
		echo $ye;
		var_dump($matches);
?>
