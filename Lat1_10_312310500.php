<?php
$transportasi = array("Mobil", "Bus", "Truk", "Sepeda Motor", "Sepeda", "Becak", "Andong");


for ($i=0; $i < sizeof($transportasi); $i++){
	echo "$transportasi[$i] ";
}
echo "<br>";
	arsort($transportasi);
for ($i=0; $i < sizeof($transportasi); $i++){
	echo "$transportasi[$i] ";
}

echo "<br>";
	asort($transportasi);
for ($i=0; $i < sizeof($transportasi); $i++){
	echo "$transportasi[$i] ";
}
echo "<br>";
	ksort($transportasi);
for ($i=0; $i < sizeof($transportasi); $i++){
	echo "$transportasi[$i] ";
}
echo "<br>";
	rsort($transportasi);
for ($i=0; $i < sizeof($transportasi); $i++){
	echo "$transportasi[$i] ";
}
echo "<br>";
	arsort($transportasi);
for ($i=0; $i < sizeof($transportasi); $i++){
	echo "$transportasi[$i] ";
}
echo "<br>";
	krsort($transportasi);
for ($i=0; $i < sizeof($transportasi); $i++){
	echo "$transportasi[$i] ";
}
?>
