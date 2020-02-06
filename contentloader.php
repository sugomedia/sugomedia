<?php
	$page = @$_GET['pg'];
	if (!empty($page))
	{
		$pos = strpos($page, '_');
		if ($pos > 0)
		{
			$dir = substr($page, 0, $pos);
		}
		else
		{
			$dir = $page;
		}
		if (is_dir($dir))
		{
			include($dir.'/'.$page.'.php');
		}
		else
		{
			include($page.'.php');
		}
	}
	else
	{
		include('hirek/hirek.php');
	}
?>