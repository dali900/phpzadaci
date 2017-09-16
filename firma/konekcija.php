<?php 
function connection(){
	$sql_konekcija = mysqli_connect("localhost", "root","","drupal");
	if ($sql_konekcija == false) {
		echo "Greska, konekcija sa bazom nije uspela. ";
		echo mysqli_connect_error($sql_konekcija);
	}

	return $sql_konekcija;
}

# Prikaz nizova (nije potrebno)
function printr($data){
	echo "<pre>";
    print_r($data);
    echo "</pre>";
}

 ?>