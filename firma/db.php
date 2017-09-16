<?php 
# 4 b)
# Uspostavlja konekciju sa bazom
function connection(){

	if ($sql_konekcija == false) {
		echo "Greska, konekcija sa bazom nije uspela. ";
		echo mysqli_error($sql_konekcija);
	}

	return $sql_konekcija = mysqli_connect("localhost", "root","","drupal");
}

$sql_konekcija = connection();

# 5 a)
# Proverava da li je prosledjen input (okidac) 'pretraga'
if(isset($_POST['pretraga'])){
	$ime = $_POST['ime'];	
	$min_plata = $_POST['min_plata'];  
	$max_plata = $_POST['max_plata'];			

	# Konstrukcija WHERE klauzule - ukoliko je neko od polja za pretragu prazno
	$WHERE = "WHERE 1 ";
	if ($student_ime != "") {
		$WHERE.="AND ime='$ime' ";
	}
	if ($godina_upisa != "") {
		$WHERE.="AND min_plata='$min_plata' ";
	}
	if ($prosek != "") {
		$WHERE.="AND max_plata='$max_plata' ";
	}

	$sql_query_pretraga = "SELECT id,ime,radno_mesto,min_plata,max_plata FROM zaposleni ".$WHERE; 

	$sql_result_pretraga = mysqli_query($sql_konekcija, $sql_query_pretraga) 
	# Ukoliko dodje do neke greske u SQL
	OR die(mysqli_error($sql_konekcija));


	
}

 ?>

<style>
	table, th, td {
	    border: 1px solid black;
	    border-collapse: collapse;
	}
</style>

 <form action="" method="POST">

 	<!-- Ime -->
 	<input type="text" name="ime" placeholder="ime" value="">

 	<!-- Min plata -->
 	<input type="text" name="min_plata" placeholder="Min plata" value="">

 	 	<!-- Max plata -->
 	<input type="text" name="max_plata" placeholder="Max plata" value="">

 	<!-- Okidac za pretragu -->
 	<input type="submit" name="pretraga" value="TRAZI">

 </form>

<?php if(isset($_POST['pretraga'])){ ?>
 <table>
 	<tr>	
 		<th>Ime</th><th>Min plata</th><th>Max plata</th>
 	</tr>
 	<!-- Prikaz rezultata trazenog studenta -->
 	<?php while ($rezultat = mysqli_fetch_assoc($sql_result_pretraga)) { ?>
 		<tr>
 			<td><?php echo $rezultat['ime'];?>s</td>
 			<td><?php echo $rezultat['min_plata'];?></td>
 			<td><?php echo $rezultat['max_plata'];?></td>
 		</tr>
 	<?php } ?>
 </table>
<?php } ?>