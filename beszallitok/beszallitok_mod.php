<h3>Beszállítók kezelése</h3>
<hr>
<?php
	$id = $_GET['id'];

	if (isset($_POST['modosit']))
	{
		$nev = escapeshellcmd($_POST['nev']);
		$email = escapeshellcmd($_POST['email']);
		$tel = escapeshellcmd($_POST['tel']);
		$ado = escapeshellcmd($_POST['ado']);
		$bank = escapeshellcmd($_POST['bank']);
		$kapcsnev = escapeshellcmd($_POST['kapcsnev']);
		$cim = escapeshellcmd($_POST['cim']);
		$megjegyzes = escapeshellcmd($_POST['megjegyzes']);

		if (empty($nev) || empty($email) || empty($tel) || empty($cim) || empty($kapcsnev))
		{
			showError('Hiba! Nem adtál meg minden kötelező adatot!');
		}
		else
		{
			$db->query("SELECT * FROM beszallitok WHERE nev='$nev' AND ID<>".$id);
			if ($db->numRows() != 0)
			{
				showError('Hiba! Ez a beszállító már regisztrálva van!');
			}
			else
			{
				$db->query("UPDATE beszallitok SET 
					nev='$nev',
					cim='$cim',
					email='$email',
					kapcsolattarto='$kapcsnev',
					tel='$tel',
					ado='$ado',
					bank='$bank',
					megjegyzes='$megjegyzes'
					WHERE ID=".$id);
				header("location: index.php?pg=".$dir);
			}
			
		}
	}

	$db->query("SELECT * FROM beszallitok WHERE ID=".$id);
	$res = $db->fetchAll();

	echo'
	<form method="POST" action="index.php?pg='.$page.'&id='.$id.'">
		<div class="form-group">
			<label>Cégnév:</label><em>*</em>
			<input type="text" name="nev" class="form-control" value="'.$res[0]['nev'].'">
		</div>
		<div class="form-group">
			<label>Postacím:</label><em>*</em>
			<input type="text" name="cim" class="form-control" value="'.$res[0]['cim'].'">
		</div>
		<div class="form-group">
			<label>E-mail cím:</label>
			<input type="text" name="email" class="form-control" value="'.$res[0]['email'].'">
		</div>
		<div class="form-group">
			<label>Telefonszám:</label>
			<input type="text" name="tel" class="form-control"  value="'.$res[0]['tel'].'">
		</div>
		<div class="form-group">
			<label>Adószám:</label>
			<input type="text" name="ado" class="form-control"  value="'.$res[0]['ado'].'">
		</div>
		<div class="form-group">
			<label>Bankszámlaszám:</label>
			<input type="text" name="bank" class="form-control"  value="'.$res[0]['bank'].'">
		</div>
		<div class="form-group">
			<label>Kapcsolattartó neve:</label>
			<input type="text" name="kapcsnev" class="form-control"  value="'.$res[0]['kapcsolattarto'].'">
		</div>
		<div class="form-group">
			<label>Megjegyzés:</label>
			<textarea name="megjegyzes" class="form-control">'.$res[0]['megjegyzes'].'</textarea>
		</div>			
		<div class="form-group">
			<input type="submit" name="modosit" value="Rekord módosítása" class="btn btn-primary">
			<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához</a>
		</div>	
	</form>';
?>