<?php
   function LastxDraws($date,$limit)
   {		
		global $debug;

		require ("includes/mysql.php");

		// get everything from catalog table
		$query_ld = "SELECT * FROM pb_draws ";
		$query_ld .= "WHERE date < '$date' ";
		$query_ld .= "ORDER BY date DESC ";
		$query_ld .= "LIMIT $limit ";
		
		$mysql_result_ld = mysql_query($query_ld, $mysql_link) or die (mysql_error());
	
		#$array[0] = 0;
		$array = array (0);
		$x = 1;

		while($row = mysql_fetch_array($mysql_result_ld))
		{
		
			for ($index = 1; $index <= 5; $index++)
			{
				$array[$x] = $row[$index];
				$x++;
			}
		}

		sort ($array);

		for ($y = 0; $y <= count($array)-2; $y++)
		{
			if ($array[$y] == $array[$y+1])
			{
				array_splice($array,$y,1);
				$y--;
				$x--;
			}
		}

		return $array;
   }
?>