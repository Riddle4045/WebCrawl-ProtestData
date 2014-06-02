<?php 
$input  = "f7ce1d1b7e46657cb3cb7955c612af99 : RT : #RejectAndProtect #NoKXL #OCAM #DC 11AM EDT http://t.co/apgQnAkTHu @GlobalRevLive @RisePDX @UnToldCarlisle @Arlington_…";
$pattern = "/[@][A-Za-z0-9]+/";
$is_match =  preg_match_all($pattern,$input,$matches);
//echo $is_match;
print_r($matches);

foreach($matches[0] as $k => $v ) {
		echo $v ;
		}
