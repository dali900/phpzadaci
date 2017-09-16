<?php 
include "konekcija.php";
$sql_konekcija = connection();

$sql_query_zaposleni  = "SELECT szaposleni FROM zaposleni";
$sql_result_zaposleni = mysqli_query($sql_konekcija, $sql_query_zaposleni);
# Cuvanje rezultate query-a u niz
$zaposleni_db = mysqli_fetch_all($sql_result_zaposleni, MYSQLI_ASSOC);

# Ucitava XML fajl
$zaposleni_xml = simplexml_load_file("zaposleni.xml");

# Rezultat array_column funkcije
// print_r(array_column($zaposleni_db,'szaposleni'));

foreach ($zaposleni_xml->radnik as $radnik_xml) {
	# Tamo gde imamo istu sifru zaposlenog u tabeli ZAPOSLENI i XML fajlu vrsimo azuriranje tabele zaposleni (UPDATE)
	# u suprotnom, unosimo novi red u tabeli (INSERT)
	# array_column(niz, kolona) - php funkcija koja koja cuva sve vrednosti iz kolone 'szaposleni' u novi niz
	# array_search(podatak_za_pretragu, niz) - php funkcija koja pretrazuje niz, vraca broj indexa pronadjenog 
	#elementa, ne vraca nista u koliko nema rezultata

	$trazi_zaposlenog = array_search($radnik_xml->szaposleni, array_column($zaposleni_db,'szaposleni'));

	# Potrebno je dodati i uslov (===) ukoliko je jednako 0 tj. ako je array_search() svoj element pronasao u 
	#prvom 'nulti index' elementu niza, u suprotnom if nulu cita kao false
	if ($trazi_zaposlenog === 0 || $trazi_zaposlenog !='') {  
		$sql_query_update = "UPDATE zaposleni 
							 SET ime = '".$radnik_xml->ime."',
							 	 radno_mesto = '".$radnik_xml->radno_mesto."',
							 	 plata = '".$radnik_xml->plata."'
							 WHERE szaposleni = ".$radnik_xml->szaposleni;
		mysqli_query($sql_konekcija, $sql_query_update) or die(mysqli_error($sql_konekcija));
		echo "AZURIRAN: ".$radnik_xml->ime." ".$radnik_xml->szaposleni."<br>";
	} else {
		$sql_query_insert = "INSERT INTO zaposleni 
							 VALUES (	
							 			'".$radnik_xml->szaposleni."',
							 			'".$radnik_xml->ime."',
										'".$radnik_xml->radno_mesto."',
										'".$radnik_xml->plata."'
									)"; 
		mysqli_query($sql_konekcija, $sql_query_insert) or die(mysqli_error($sql_konekcija));
		echo "SACUVAN: ".$radnik_xml->ime." ".$radnik_xml->szaposleni."<br>";
	}
}

 ?>
<br>
<br>

<a href="prikaz.php">Prikaz svih zaposlenih</a><br>
<a href="index.php">Pocetna</a>
