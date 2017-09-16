<?php 
# Uspostavlja konekciju sa bazom
$sql_konekcija = mysqli_connect("localhost", "root","","fakultet");

if ($sql_konekcija == false) {
	echo "Greska, konekcija sa bazom nije uspela. ";
	echo mysqli_error($sql_konekcija);
}

 ?>