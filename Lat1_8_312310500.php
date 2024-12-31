<?php
function mySum($numX, $numY){
	$total = $numX + $numY;
	return $total;
}

$myNumber = 0;
echo "Sebelum fungsi dijalankan, myNumber = ". $myNumber ."<br/>";
$myNumber = mySum(3, 4);
echo "Setelah fungsi dijalankan, myNumber = ". $myNumber ."<br/>";
?>
