<h3>Felhasználók kezelése</h3>
<hr>
<?php
	$id = $_GET['id'];

	$db->query("SELECT 
		felhasznalok.ID AS 'ID',
		felhasznalok.nev AS 'Név',
		felhasznalok.email AS 'E-mail cím',
		felhasznalok.beosztas AS 'Beosztás',
		felhasznalok.reg AS 'Regisztráció dátuma',
		felhasznalok.utbelep AS 'Ut.belépés dátuma',
		felhasznalok.logincount AS 'Belépések száma',
		allapotok.nev AS 'Állapot',
		statuszok.nev AS 'Státusz'
	FROM felhasznalok 
	INNER JOIN allapotok ON allapotok.ID = felhasznalok.allapot
	INNER JOIN statuszok ON statuszok.ID = felhasznalok.status
	WHERE felhasznalok.ID=".$id);
	/*
	echo '
<table>
<tr>';
	if (!empty($result[0]['profilkep']))
	{
		echo '<td><img src="images/'.$result[0]['profilkep'].'" class="img-thumbnail" ></td>';
	}
	else
	{
		echo '<td><img src="images/user.png" class="img-thumbnail"></td>';
	}

	echo '</tr>
	</table>
*/

	$db->showRekord();

	$db->query("SELECT profilkep, jogosultsag FROM felhasznalok WHERE ID=$id");
	$result = $db->fetchAll();
	echo '<table class="table table-responsive">
	<tr><td>
		<label>Jogosultságok:</label>
		<div class="form-group"><input type="checkbox" name="jog0" disabled';
		if ($result[0]['jogosultsag'][0] == 1) echo ' checked';
		echo '> Árukészlet kezelés</div>
		<div class="form-group"><input type="checkbox" name="jog1" disabled';
		if ($result[0]['jogosultsag'][1] == 1) echo ' checked';
		echo '> Bizonylat kezelés</div>
		<div class="form-group"><input type="checkbox" name="jog2" disabled';
		if ($result[0]['jogosultsag'][2] == 1) echo ' checked';
		echo '> Árajánlat kezelés</div>
		<div class="form-group"><input type="checkbox" name="jog3" disabled';
		if ($result[0]['jogosultsag'][3] == 1) echo ' checked';
		echo '> Foglalás kezelés</div>
		<div class="form-group"><input type="checkbox" name="jog4" disabled';
		if ($result[0]['jogosultsag'][4] == 1) echo ' checked';
		echo '> Munkalap kezelés</div>
		<div class="form-group"><input type="checkbox" name="jog5" disabled';
		if ($result[0]['jogosultsag'][5] == 1) echo ' checked';
		echo '> Garancia kezelés</div>
		<div class="form-group"><input type="checkbox" name="jog6" disabled';
		if ($result[0]['jogosultsag'][6] == 1) echo ' checked';
		echo '> Vásárló kezelés</div>
		<div class="form-group"><input type="checkbox" name="jog7" disabled';
		if ($result[0]['jogosultsag'][7] == 1) echo ' checked';
		echo '> Beszállító kezelés</div>
		<div class="form-group"><input type="checkbox" name="jog8" disabled';
		if ($result[0]['jogosultsag'][8] == 1) echo ' checked';
		echo '> Felhasználó kezelés</div>
		<div class="form-group"><input type="checkbox" name="jog9" disabled';
		if ($result[0]['jogosultsag'][9] == 1) echo ' checked';
		echo '> Cégadat kezelés</div>
		<div class="form-group"><input type="checkbox" name="jog10" disabled';
		if ($result[0]['jogosultsag'][10] == 1) echo ' checked';
		echo '> Statisztika kezelés</div>
		</td>
	</tr></table>';
	echo '

	<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához...</a>';
?>

