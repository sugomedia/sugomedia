<h3>Felhasználók kezelése</h3>
<hr>
<?php
	echo '<a href="index.php?pg=felhasznalok_felv" class="btn btn-primary">Új rekord</a>';
	$db->query("SELECT 
	ID AS '@ID',
	nev AS 'Név',
	email AS 'E-mail cím',
	beosztas AS 'Beosztás',
	reg AS 'Regisztráció',
	utbelep AS 'Ut.belépés',
	status AS '@Státusz'
	 FROM felhasznalok");
	$db->toTable('s|i|u|d');
?>