<?php

	function connection() {
		$konekcija = mysqli_connect("localhost", "root", "", "drupal");
		if($konekcija == false) {
			echo "Greška, konekcija sa bazom podataka neuspešna.";
			echo mysqli_connect_error($konekcija);
		}
		
		return $konekcija;
	}

?>