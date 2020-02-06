<h3>Felhasználók kezelése</h3>
<hr>
<?php
	$id = $_GET['id'];
	if (isset($_POST['torol']))
	{
		$db->query("DELETE FROM beszallitok WHERE ID=".$id);
		header("location:index.php?pg=".$dir);
	}

	$db->query("SELECT 
		ID AS 'Azonosító:',
		nev	AS 'Név:',
		cim AS 'Cím:',
		kapcsolattarto AS 'Kapcsolattartó:',
		email AS 'E-mail cím:',
		tel AS 'Telefonszám:',
		ado AS 'Adószám:',
		bank AS 'Bankszámlaszám:',
		megjegyzes AS 'Megjegyzés:'
	 FROM beszallitok 
	WHERE ID=".$id);

	echo 'Biztosan törli az alábbi rekordot?';
	$db->showRekord();
	echo '<form method="POST" action="index.php?pg='.$page.'&id='.$id.'">
		<div class="form-group">
			<input type="submit" name="torol" value="Rekord törlése" class="btn btn-primary">
			<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához</a>
		</div>
	</form>';
?>
