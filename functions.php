<?php
	// adatbázis kapcsolódás
	function connectdb($dbhost, $dbuser, $dbpass, $dbname)
	{
		if (!$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
		{
			die('Hiba az adatbázis kapcsolat felépítése közben! (Hibakód: '.mysqli_connect_errno().')'); //vagy mysqli_connect_error is használható
		}
		else
		{
			mysqli_query($connection, "SET NAMES utf8");
		}
		return $connection;
	}

	// adatbázis lekérdezés
	function dbquery($sql, $database)
	{
		if (!$result = mysqli_query($database, $sql))
		{
			die('Hiba az adatbázis lekérdezés közben! (Hiba: )'); 
		}
		return $result;
	}

	// bejelentkezés ellenőrzése
	function logincheck()
	{
		if (!isset($_SESSION['uid']))
		{
			header("location: index.php");
		}
	}

	// piros színű üzenet
	function showError($hiba)
	{
		echo '<div class="alert alert-danger">'.$hiba.'</div>';
	}
	// kék színű üzenet
	function showInfo($info)
	{
		echo '<div class="alert alert-info">'.$info.'</div>';
	}
	// sárga színű üzenet
	function showWarning($warning)
	{
		echo '<div class="alert alert-warning">'.$warning.'</div>';
	}
	// zöld színű üzenet
	function showSuccess($success)
	{
		echo '<div class="alert alert-success">'.$success.'</div>';
	}

	//számkiírás normális formában
	function szamkiir($szam)
	{
		return number_format($szam, $GLOBALS['tizedes'], $GLOBALS['tizedeselv'], $GLOBALS['ezreselv']);
	}

	// fájlfeltöltés
	function fajlfeltolt($mit, $param)
	{
		// a feltöltendő fájl kiterjesztésének a kinyerése
		$ext = strtolower(pathinfo($mit['name'], PATHINFO_EXTENSION));

		//feldolgozzuk a paraméterlistát
		$params = explode('|', $param);
		foreach ($params as $parameter) 
		{
			$data = explode(':', $parameter);

			switch ($data[0]) 
			{
				case 'target':
					$target_dir = $data[1];
					// ha nem létezik a könyvtár, akkor hozza létre
					if (!is_dir($target_dir))
					{
						mkdir($target_dir);
					}
					break;
				case 'maxsize':
					$maxsize = $data[1]*1024*1024;
					break;
				case 'allow':
					$allowedtypes = explode(',', $data[1]);
					break;								
				case 'filename':
					$filename = $data[1].'.'.$ext;
					break;				
			}
		}
		// ha már fel van töltve egy ilyen nevű fájl
		if (!file_exists( $target_dir.'/'.$filename))
		{
			// ha túl nagy a mérete
			if ($mit['size'] <= $maxsize)
			{
				// ha a megengedett formátumok közt van
				if (in_array($ext, $allowedtypes))
				{
					if(move_uploaded_file($mit['tmp_name'], $target_dir.'/'.$filename))
					{
						echo 'Feltöltve!';
					}
					else
					{
						echo 'Hiba a feltöltéskor!';
						$filename = '';
					}
				}
				else
				{
					echo 'Nem megfelelő fájltípus!';
					$filename = '';
				}
			}
			else
			{
				echo 'Túl nagy a mérete!';
				$filename = '';
			}
		}
		else
		{
			echo 'A fájl már létezik!';
			$filename = '';
		}
		return $filename;
	}

	function moderalas($mit, $szavak)
	{
		foreach ($szavak as $tiltottszo) 
		{
			$mit = str_replace($tiltottszo, "***", $mit);
		}
		return $mit;
	}
?>