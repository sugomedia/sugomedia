<h3>Bizonylatok kezelése</h3>
<hr>
<?php
	echo '<a href="index.php?pg=termekek_felv" class="btn btn-primary">Új rekord</a>
	<a href="index.php?pg=bizonylatok_import" class="btn btn-primary">Clear Admin import</a>';
	$db->query("SELECT 
			bizonylatok.ID AS '@ID',
			statuszok.glyphicon AS 'Stát.',
			bizonylatok.bizonylatszam AS 'Bizonylatszám',
			bizonylatok.kib_nev AS 'Kibocsájtó',
			bizonylatok.vevo_nev AS 'Vásárló',
			bizonylatok.kelt AS 'Kelt.',
			bizonylatok.fizhat AS 'Fiz.hat',
			bizonylatok.netto AS 'Nettó',
			bizonylatok.brutto AS 'Bruttó'
		FROM bizonylatok 
		INNER JOIN statuszok ON  statuszok.ID = bizonylatok.statusz
		
	 ");
	$db->toTable("i|u|d");
?>