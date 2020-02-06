<h3>Beszállítók kezelése</h3>
<hr>
<?php
	echo '<a href="index.php?pg=beszallitok_felv" class="btn btn-primary">Új rekord</a>';
	$db->query("SELECT 
		ID AS '@ID',
		nev	AS 'Név',
		cim AS 'Cím',
		kapcsolattarto AS 'Kapcsolattartó',
		tel AS 'Telefonszám'
	 FROM beszallitok");
	$db->toTable("i|u|d");
?>