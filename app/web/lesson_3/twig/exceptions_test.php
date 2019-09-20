<?
$a = 5;
$b = 0;
try{
	$z = $a / $b;
}
catch(Exception $e){
    die ('ERROR: ' . $e->getMessage());	
}