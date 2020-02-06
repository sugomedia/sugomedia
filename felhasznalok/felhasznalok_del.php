<h3>Felhasználók kezelése</h3>
<hr>
<?php
	$id = $_GET['id'];
	if (isset($_POST['torol']))
	{
		$db->query("DELETE FROM felhasznalok WHERE ID=".$id);
		header("location:index.php?pg=".$dir);
	}

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

	echo 'Biztosan törli az alábbi rekordot?';
	$db->showRekord();
	echo '<form method="POST" action="index.php?pg='.$page.'&id='.$id.'">
		<div class="form-group">
			<input type="submit" name="torol" value="Rekord törlése" class="btn btn-primary">
			<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához</a>
		</div>
	</form>';
?>
