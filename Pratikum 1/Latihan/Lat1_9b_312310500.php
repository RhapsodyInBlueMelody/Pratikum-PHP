<?php

function kuadrat(int $x, int $y){
	$hasil = 1;
	for($i = 0; $i < $y; $i++){
		$hasil *= $x;
	}
	return $hasil;
}


echo kuadrat(5, 3);

?>
