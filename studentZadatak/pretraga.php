<?php 
# Ucitava konekciju sa bazom
include "db.php";

# Ucitava studente
$sql_query_studenti = "SELECT id,ime FROM studenti";
$sql_result_studenti = mysqli_query($sql_konekcija, $sql_query_studenti);


# Proverava da li je prosledjen input (okidac) 'pretraga'
if(isset($_POST['pretraga'])){
	$student_ime = $_POST['student_ime'];	# combobox student_ime
	$godina_upisa = $_POST['godina_upisa']; # input godina_upisa 
	$prosek = $_POST['prosek'];				# input prosek

	# Konstrukcija WHERE klauzule - ukoliko je neko od polja za pretragu prazno
	$WHERE = "WHERE 1 ";
	if ($student_ime != "") {
		$WHERE.="AND ime='$student_ime' ";
	}
	if ($godina_upisa != "") {
		$WHERE.="AND godup='$godina_upisa' ";
	}
	if ($prosek != "") {
		$WHERE.="AND prosek='$prosek' ";
	}

	$sql_query_pretraga = "SELECT id,ime,godup,prosek FROM studenti ".$WHERE; 

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

 	<select name="student_ime" >
 		<option selected hidden value="">STUDENT</option>
 		<?php while($student = mysqli_fetch_assoc($sql_result_studenti)) { ?> 
 			<option value="<?php echo $student['ime'];?>">	
 				<?php echo $student['ime'];?>
 			</option>
 		<?php } ?> 
 	</select>

 	<!-- Godina upisa -->
 	<input type="text" name="godina_upisa" placeholder="Godina upisa" value="">

 	<!-- Prosek -->
 	<input type="text" name="prosek" placeholder="Prosek" value="">

 	<!-- Okidac za pretragu -->
 	<input type="submit" name="pretraga" value="TRAZI">

 </form>

<?php if(isset($_POST['pretraga'])){ ?>
 <table>
 	<tr>	
 		<th>Ime</th><th>Godina upsia</th><th>Prosek</th><th>Polozeni ispiti</th>	
 	</tr>
 	<!-- Prikaz rezultata trazenog studenta -->
 	<?php while ($rezultat = mysqli_fetch_assoc($sql_result_pretraga)) { ?>
 		<tr>
 			<td><?php echo $rezultat['ime'];?>s</td>
 			<td><?php echo $rezultat['godup'];?></td>
 			<td><?php echo $rezultat['prosek'];?></td>

 			<!-- Polozeni ispiti za svakog pronadjenog studenta -->
 			<td>				
 				<?php 
	 				$sql_query_polozeni_ispiti = "SELECT ispiti.naziv FROM ispiti 
	 					LEFT JOIN polozeni_ispiti on ispiti.id=polozeni_ispiti.ispit_id
	 					WHERE polozeni_ispiti.student_id = $rezultat[id]";
	 				$sql_resutl_polozeni_ispiti = mysqli_query($sql_konekcija, $sql_query_polozeni_ispiti)
	 				OR die(mysqli_error($sql_konekcija));

	 				while ($pol_ispiti = mysqli_fetch_assoc($sql_resutl_polozeni_ispiti)) { 
	 			?>
 				
 					<div><?php echo $pol_ispiti['naziv']; ?></div>
 				
 				<?php } ?>
 				
 			</td>

 		</tr>
 	<?php } ?>
 </table>
<?php } ?>

 <!-- Linka za unos -->
 <a href="unos.php">Unos</a>
<br>
  <!-- Linka za xml -->
 <a href="xml.php">XML</a>