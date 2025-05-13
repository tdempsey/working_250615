<?php
function filter_chex($draw) 
{  
	global $curr_date_dash;

	$d2_1 = 0;
	$d2_2 = 0;
	$half = intval($max_draw/2);

	// error checking ----------------------------------------------------------------------------------------------
	if (count($draw) == 0)
	{
		exit("<h2>Error - function calculate_50_50.php - <font color=\"#FF0000\">draw undefined</font></h2>");
	}

	if (array_sum($draw) == 0)
	{
		exit("<h2>Error - function calculate_50_50.php - <font color=\"#FF0000\">draw array_sum = 0</font></h2>");
	}

	if (is_null($max_draw) || $max_draw == 0)
	{
		exit("<h2>Error - function calculate_50_50.php - <font color=\"#FF0000\">max_draw undefined - max_draw = $max_draw</font></h2>");
	}

	// error checking ----------------------------------------------------------------------------------------------
	
	reset ($draw); 

	$reject_code = 0;

	$count = count(array_filter($array, function($value) {
	  return $value > 0;
	}));

	echo "Count of values > 0: $count\n";

	### seq	2/3 ### -1

	### mod/modx ### -2

	### dc ### -3

	### dup ### -4

	### rank ### -5
	$num_rows_rank_limit = 0;

	$query = "SELECT * FROM $draw_prefix";
	$query .= "rank_limit ";
	$query .= "WHERE date = '$curr_date_dash' ";
	$query .= "AND draw_limit = '30' ";	### 240701 ###

	echo "$query<br>";

	$mysqli_result = mysqli_query($mysqli_link, $query) or die (mysqli_error($mysqli_link));

	$num_rows_rank_limit = mysqli_num_rows($mysqli_result);

	echo "num_rows_rank_limit - $num_rows_rank_limit<br>";

	if ($num_rows_rank_limit)
	{

	}
	
	
	foreach ($draw as $val) 
	{ 
		if ($val > $half) {
			$d2_2++;
		} else {
			$d2_1++;
		}
	} 

	if ($d2_1 == 0 && $d2_2 == 0)
	{
		exit("<font color=\"#FF0000\"><h2>Error - function calculate_50_50.php - d2_1/d2_2 = 0</h2></font>");
	}
	
	return $reject_code;
}
?>