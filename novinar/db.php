<?php 
# Uspostavlja konekciju sa bazom
$sql_konekcija = mysqli_connect("localhost", "root","","novinar");

if (!$sql_konekcija) {
	echo "Greska, konekcija sa bazom nije uspela. ";	
	echo mysqli_connect_error($sql_konekcija);
	echo " Tip greske ".mysqli_connect_errno($sql_konekcija); 
}

 ?>

