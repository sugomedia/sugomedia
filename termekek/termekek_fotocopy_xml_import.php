<h3>Fotocopy XML import</h3>
<hr>
<?php
	echo '
	<form method="POST" action="index.php?pg='.$page.'" enctype="multipart/form-data">
		<div class="form-group">
			<label>XML fájl:</label>
			<input type="file" name="xmlfile" class="form-control">
		</div>
		<div class="form-group">
			<input type="submit" name="import" value="Importálás" class="btn btn-primary">
			<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához...</a>
		</div>
	</form>';

	if (isset($_POST['import']))
	{
		$xmlfile = $_FILES['xmlfile']['name'];
		$xml = simplexml_load_file($xmlfile) or die("Hiba az XML fájl beolvasása során!");
		$xml = $xml->szamlak->szamla;
  		echo '<h4>Importált termékek:</h4>';

  		$db->query("SELECT ID FROM bizonylatok WHERE bizonylatszam='".$xml->fej->bizonylatszam."'");
  		if ($db->numRows()>0)
  		{
  			showError("Ez a bizonylat már szerepel az adatbázisban!");
  		}
  		else
  		{
  			$db->query("SELECT * FROM beszallitok WHERE nev LIKE '%Fotocopy%'");
  			$kibocsato = $db->fetchAll();

  			$db->query("SELECT * FROM cegadatok WHERE ID=1");
  			$vevo = $db->fetchAll();

  			$xml->fej->devnetto = str_replace(',', '.', $xml->fej->devnetto);
			$xml->fej->devbrutto = str_replace(',', '.', $xml->fej->devbrutto);

	  		$db->query("INSERT INTO bizonylatok VALUES(
	  			null, 	
	  			'".$xml->fej->bizonylatszam."',
	  			'".$kibocsato[0]['nev']."',
	  			'".$kibocsato[0]['cim']."',
	  			'".$kibocsato[0]['ado']."',
	  			'".$kibocsato[0]['bank']."',
	  			'".$vevo[0]['rovidnev']."', 	
	  			'".$vevo[0]['szekhely']."', 	
	  			'".$vevo[0]['adoszam']."', 	
	  			'".$xml->fej->bizdatum."', 	
	  			'".$xml->fej->teljdatum."', 	
	  			'".$xml->fej->fizhat."', 	
	  			".$xml->fej->devnetto.",	
	  			".$xml->fej->devbrutto.", 	
	  			".($xml->fej->devbrutto - $xml->fej->devnetto).", 	
	  			'Átutalás', 
	  			'".$penznem."', 	
	  			1, 	
	  			'', 	
	  			'Bejövő számla', 	
	  			1 
	  		)");


	  		foreach ($xml->tetelek->tetel as $value) 
		 	{
		 		$value->cikkid = $value->cikkid+200000;
				$value->menny = str_replace(',', '.', $value->menny);
				$value->egysegar = str_replace(',', '.', $value->egysegar);

				$db->query("SELECT ID FROM termekek WHERE ID=".$value->cikkid);

				if ($db->numRows()>0)
				{
					
					$db->query("UPDATE termekek SET menny = menny + ".$value->menny.", ar=".$value->egysegar." WHERE ID=".$value->cikkid);
					echo '<span class="glyphicon glyphicon-refresh"> '.$value->cikknev.'</span><hr>';
				} 
				else
				{
					$gyartonev = substr($value->cikknev, 0, strpos($value->cikknev, ' '));
					$tipus = substr($value->cikknev, strpos($value->cikknev, ' ')+1);

					$db->query("SELECT ID FROM gyartok WHERE nev LIKE '".$gyartonev."%'");
					if ($db->numRows() > 0)
					{
						$res = $db->fetchAll();
						$gyartoID = $res[0]['ID'];
					}
					else
					{
						$db->query("INSERT IGNORE INTO gyartok VALUES(null, '$gyartonev')");
						$gyartoID = $db->lastID();
					}
					$sql = '';
			 		$sql .= $value->cikkid.', ';
			 		$sql .= '0, ';
			 		$sql .= $gyartoID.",";
					$sql .= "'".$value->cikknev."', ";
					$sql .= "'".$tipus."', ";
					$sql .= "0, ";
					$sql .= "'".$value->cikkazon."', ";
					$sql .= doubleval($value->menny).", ";
					$sql .= doubleval($value->egysegar).",";
					$sql .= "'Raktárkészleten',";
					$sql .= "CURRENT_DATE";

					echo '<span class="glyphicon glyphicon-plus"> '.$value->cikknev.'</span><hr>';

					$db->query("INSERT IGNORE INTO termekek (ID, katID, gyartoID, nev, tipus, garido, vkod, menny, ar, keszlet, beerkezes) VALUES(".$sql.")");

				}
				$db->query("INSERT IGNORE INTO termekarvaltozasok VALUES(null, ".$value->cikkid.", ".$value->egysegar.", CURRENT_DATE)");
				$szeriaszamok = '';
				foreach ($value->sorozatszamok->sorozatszam as $value2) 
				{
					$db->query("INSERT IGNORE INTO szeriaszamok VALUES(".$value->cikkid.",'".$value2."', '".$xml->fej->bizonylatszam."', '')");
					$szeriaszamok .= $value2.', ';

				}
				$szeriaszamok = rtrim($szeriaszamok, ',');

				$db->query("INSERT INTO bizonylattetelek VALUES(null,
					'".$xml->fej->bizonylatszam."',
					'".$value->cikknev."',
					".doubleval($value->menny).",
					".doubleval($value->egysegar).",
					".$def_afa.", 
					'".$value->cikkid."',
					'".$szeriaszamok."',
					'',
					'".$def_egys."',
					0,
					''
				)");
		 	}
		 }
	}	
?>