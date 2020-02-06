<h3>Gyártók kezelése</h3>
<hr>
<?php
	echo '
	<a href="index.php?pg=gyartok_felv" class="btn btn-primary">Új rekord</a>
	<a href="index.php?pg=termekek" class="btn btn-primary">Árukészlet</a>';
	$db->query("SELECT 
		ID AS '@ID',
		nev	AS 'Gyártó név',
		(SELECT COUNT(*) FROM termekek WHERE gyartoID=gyartok.ID) AS 'Termékszám'
	 FROM gyartok WHERE ID<>0 ORDER BY nev ASC");
	$db->toTable("u|d");
?>