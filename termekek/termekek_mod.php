<h3>Árukészlet kezelése</h3>
<hr>
<h4>Termékadatok módosítása</h4>
<?php
	$id = $_GET['id'];

	if (isset($_POST['modosit']))
	{
		$katID = $_POST['kategoriak'];
		$gyartoID = $_POST['gyartok'];
		$nev = escapeshellcmd($_POST['nev']);
		$tipus = escapeshellcmd($_POST['tipus']);
		$gy_cikkszam = escapeshellcmd($_POST['gy_cikkszam']);
		$ar = escapeshellcmd($_POST['ar']);
		$menny = escapeshellcmd($_POST['menny']);
		$minmenny = escapeshellcmd($_POST['minmenny']);
		$garido = escapeshellcmd($_POST['gar']);
		$suly = escapeshellcmd($_POST['suly']);
		$vkod = escapeshellcmd($_POST['vkod']);
		$link = escapeshellcmd($_POST['link']);
		$vtsz = escapeshellcmd($_POST['vtsz']);
		$specifikacio = escapeshellcmd($_POST['spec']);
		$leiras1 = escapeshellcmd($_POST['leiras1']);
		if (empty($katID) || empty($gyartoID) || empty($nev) || empty($tipus)  || empty($ar))
		{
			showError('Hiba! Nem adtál meg minden adatot!');
		}
		else
		{
			if (empty($_POST['minmenny']))
				$minmenny = 0;
			if (empty($_POST['suly']))
				$suly = 0;			
			$db->query("UPDATE termekek SET 
					gy_cikkszam='$gy_cikkszam',
					katID=$katID,
					gyartoID=gyartoID,
					nev='$nev',
					tipus='$tipus',
					leiras1='$leiras1',
					link='$link',
					ar=$ar,
					garido=$garido,
					menny=$menny,
					minmenny=$minmenny,
					vkod='$vkod',
					suly=$suly,
					vtsz='$vtsz',
					specifikacio='$specifikacio'

					WHERE ID=".$id);
			
			header("location: index.php?pg=".$dir);
		}
	}

	$db->query("SELECT * FROM termekek WHERE ID=".$id);
	$res = $db->fetchAll();
	$_POST['kategoriak'] = $res[0]['katID'];
	$_POST['gyartok'] = $res[0]['gyartoID'];
	

	echo'
	<form method="POST" action="index.php?pg='.$page.'&id='.$id.'">
		<div class="form-group">
			<label>Kategória:</label><em>*</em>';
			$db->query("SELECT * FROM kategoriak ORDER BY kategoria ASC");
			$db->toSelect('ID','kategoria', '');
			echo '
		</div>
		<div class="form-group">
			<label>Gyártó:</label><em>*</em>';
			$db->query("SELECT * FROM gyartok ORDER BY nev ASC");
			$db->toSelect('ID','nev', '');
			echo '
		</div>		
		<div class="form-group">
			<label>Termék neve:</label><em>*</em>
			<input type="text" name="nev" class="form-control" value="'.$res[0]['nev'].'">
		</div>	
		<div class="form-group">
			<label>Típus:</label><em>*</em>
			<input type="text" name="tipus" class="form-control" value="'.$res[0]['tipus'].'">
		</div>	
		<div class="form-group">
			<label>Gyártói cikkszám:</label>
			<input type="text" name="gy_cikkszam" class="form-control" value="'.$res[0]['gy_cikkszam'].'">
		</div>	
		<div class="form-group">
			<label>Nettó besz.ár:</label><em>*</em>
			<input type="number" name="ar" class="form-control" value="'.$res[0]['ar'].'">
		</div>	
		<div class="form-group">
			<label>Mennyiség:</label><em>*</em>
			<input type="number" name="menny" class="form-control" value="'.$res[0]['menny'].'">
		</div>	
		<div class="form-group">
			<label>Min.mennyiség:</label>
			<input type="number" name="minmenny" class="form-control" value="'.$res[0]['minmenny'].'">
		</div>	
		<div class="form-group">
			<label>Garancia (hónap):</label><em>*</em>
			<input type="number" name="gar" class="form-control" value="'.$res[0]['garido'].'">
		</div>
		<div class="form-group">
			<label>Súly:</label>
			<input type="number" name="suly" class="form-control" value="'.$res[0]['suly'].'">
		</div>		
		<div class="form-group">
			<label>Vonalkód:</label>
			<input type="number" name="vkod" class="form-control" value="'.$res[0]['vkod'].'">
		</div>	
		<div class="form-group">
			<label>Gyártói link:</label>
				<input type="text" name="link" class="form-control" value="'.$res[0]['link'].'">
		</div>
		<div class="form-group">	
			<label>VTSZ:</label>
			<input type="text" name="vtsz" class="form-control" value="'.$res[0]['vtsz'].'">
		</div>
		<div class="form-group">	
			<label>Specifikáció:</label>
			<textarea name="spec" class="form-control">'.$res[0]['specifikacio'].'</textarea>
		</div>	
		<div class="form-group">	
			<label>Termékleírás:</label>
			<textarea name="leiras1" class="form-control">'.$res[0]['leiras1'].'</textarea>
		</div>			
		<div class="form-group">
			<input type="submit" name="modosit" value="Rekord módosítása" class="btn btn-primary">
			<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához</a>
		</div>	
	</form>';

?>