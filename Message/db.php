<?php 
# Uspostavlja konekciju sa bazom
$sql_konekcija = mysqli_connect("localhost", "root","","dbCRF");

if ($sql_konekcija == false) {
	echo "Greska, konekcija sa bazom nije uspela. ";
	echo mysqli_connect_error($sql_konekcija);
}

 ?>