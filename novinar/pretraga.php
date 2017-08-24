<?php 
# Ucitava konekciju sa bazom
include "db.php";

/**
 * [Pretrazuje vesti po zadatim kriterijumima]
 * @param  [string] $novinar [ime novinara]
 * @param  [string] $opis    [rec iz opisa]
 * @param  [object] $sql_konekcija [description]
 * @return [array] $vesti   [rezultat pretrage]
 */
function pretraga_vesti($novinar, $opis, $sql_konekcija){
	$sql_query_pretraga = "SELECT naslov,opis,ime,prezime FROM vesti 
						   LEFT JOIN novinar on vesti.novinar_id = novinar.id
						   WHERE opis LIKE '%$opis%' AND novinar.ime='$novinar'";
	$sql_result_pretraga = mysqli_query($sql_konekcija, $sql_query_pretraga)
	OR die(mysqli_error($sql_konekcija));
	# Vraca rezultat u niz 
	$vesti = mysqli_fetch_all($sql_result_pretraga, MYSQLI_ASSOC);
	return $vesti;
}

# Pozivanje funkcije i cuvanje rezultata
$vesti = pretraga_vesti("Petar", "Arsenal", $sql_konekcija);

foreach ($vesti as $vest) {
	echo $vest['naslov']." <br> ". $vest['opis']."<br>";
	echo "Novinar: ".$vest['ime']." ".$vest['prezime']."<hr>";
}



?>

 <!-- Linka za webstra -->
 <a href="webstrana.php">Web Strana</a>
<br>
