<h3>Árukészlet kezelése</h3>
<hr>
<h4>Új termék felvétele</h4>
<?php

	if (isset($_POST['felvesz']))
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

	echo'
	<form method="POST" action="index.php?pg='.$page.'">
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
			<input type="text" name="nev" class="form-control" value="'.$_POST['nev'].'">
		</div>	
		<div class="form-group">
			<label>Típus:</label><em>*</em>
			<input type="text" name="tipus" class="form-control" value="'.$_POST['tipus'].'">
		</div>	
		<div class="form-group">
			<label>Gyártói cikkszám:</label>
			<input type="text" name="gy_cikkszam" class="form-control" value="'.$_POST['gy_cikkszam'].'">
		</div>	
		<div class="form-group">
			<label>Nettó besz.ár:</label><em>*</em>
			<input type="number" name="ar" class="form-control" value="'.$_POST['ar'].'">
		</div>	
		<div class="form-group">
			<label>Mennyiség:</label><em>*</em>
			<input type="number" name="menny" class="form-control" value="'.$_POST['menny'].'">
		</div>	
		<div class="form-group">
			<label>Min.mennyiség:</label>
			<input type="number" name="minmenny" class="form-control" value="'.$_POST['minmenny'].'">
		</div>	
		<div class="form-group">
			<label>Garancia (hónap):</label><em>*</em>
			<input type="number" name="gar" class="form-control" value="'.$_POST['gar'].'">
		</div>
		<div class="form-group">
			<label>Súly:</label>
			<input type="number" name="suly" class="form-control" value="'.$_POST['suly'].'">
		</div>		
		<div class="form-group">
			<label>Vonalkód:</label>
			<input type="number" name="vkod" class="form-control" value="'.$_POST['vkod'].'">
		</div>	
		<div class="form-group">
			<label>Gyártói link:</label>
				<input type="text" name="link" class="form-control" value="'.$_POST['link'].'">
		</div>
		<div class="form-group">	
			<label>VTSZ:</label>
			<input type="text" name="vtsz" class="form-control" value="'.$_POST['vtsz'].'">
		</div>
		<div class="form-group">	
			<label>Specifikáció:</label>
			<textarea name="spec" class="form-control">'.$_POST['spec'].'</textarea>
		</div>	
		<div class="form-group">	
			<label>Termékleírás:</label>
			<textarea name="leiras1" class="form-control">'.$_POST['leiras1'].'</textarea>
		</div>			
		<div class="form-group">
			<input type="submit" name="felvesz" value="Rekord rögzítése" class="btn btn-primary">
			<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához</a>
		</div>	
	</form>';

?>