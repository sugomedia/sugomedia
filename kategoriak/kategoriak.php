<h3>Kategóriák kezelése</h3>
<hr>
<?php
	echo '<a href="index.php?pg=kategoriak_felv" class="btn btn-primary">Új rekord</a>
	<a href="index.php?pg=termekek" class="btn btn-primary">Árukészlet</a>';
	$db->query("SELECT 
		ID AS '@ID',
		kategoria	AS 'Kategória név',
		(SELECT COUNT(*) FROM termekek WHERE katID=kategoriak.ID) AS 'Termékszám'
	 FROM kategoriak 
	 WHERE ID<>0 ORDER BY kategoria ASC");
	$db->toTable("u|d");
?>