<?php
	class compmarket{
		 public function __construct() 
		 {

		 }

		 public function fromXML($xmlfile)
		 {
		 	$xml = simplexml_load_file($xmlfile) or die("Error: Cannot create object");
		 	foreach ($xml as $key => $value) 
		 	{
		 		# code...
		 	}
			echo $xml->book[0]->title . "<br>";
			echo $xml->book[1]->title; 
		 }
	}
?>	




		/*
  		foreach ($xml->termek as $value) 
	 	{
	 		$sql = '';
	 		$sql .= $value->cikkszam.', ';
	 		$sql .= "'".$value->gy_cikkszam."', ";
			$sql .= $value->kategoria_id.', ';
			$sql .= $value->gyarto_id.', ';
			$sql .= "'".$value->nev."', ";
			$sql .= "'".$value->tipus."', ";
			$sql .= "'".$value->leiras1."', ";
			$sql .= "'', ";
			$sql .= "'".$value->link."', ";
			$sql .= doubleval($value->ar).", ";
			$sql .= intval($value->garido).", ";
			$sql .= "'".$value->keszlet."', ";
			$sql .= "0, ";
			$sql .= "0, ";
			$sql .= "'".$value->vkod."', ";
			$sql .= doubleval($value->suly).", ";
			$sql .= "'".$value->beerkezes."', ";
			$sql .= "'".$value->vtsz."', ";
			$sql .= "'".$value->specifikacio."' ";

			echo $sql.'<hr>';

			foreach ($value->szeriaszamok->szeriaszam as $value2) 
			{
				$db->query("INSERT INTO szeriaszamok VALUES(".$value->cikkszam.",".$value2.")");
			}


	 		$db->query("INSERT IGNORE INTO kategoriak VALUES(".$value->kategoria_id.", '".$value->kategoria."', 1)");
	 		$db->query("INSERT IGNORE INTO gyartok VALUES(".$value->gyarto_id.", '".$value->gyarto."')");
	
			$db->query("INSERT INTO termekek VALUES(".$sql.")");
	 		echo '<li>'.$sql.'</li>';
	 	}*/