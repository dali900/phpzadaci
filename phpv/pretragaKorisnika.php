<?php
	
	$konekcija = connection();
	
	$sql_result_korisnici = "";
	
	if(isset($_POST['ime'])) {
		$imePrezimeKorisnik = $_POST['ime'];
		
		$WHERE = "";
		if($imePrezimeKorisnik != "") {
			$WHERE .= "WHERE ime = '$imePrezimeKorisnik'";
		}
		
		$sql_query_korisnici = "SELECT * FROM zaposleni";
		$sql_result_korisnici = mysqli_query($konekcija, $sql_query_korisnici)
		OR die(mysqli_error($konekcija));
	}

?>