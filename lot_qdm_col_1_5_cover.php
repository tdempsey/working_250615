<?php

	ini_set('implicit_flush', 1);

	// add tables population for combos, pairs
	// add test for missing draws
	// recalculate draw includes
	// add db class
	// error checking - all modules
	// fix pair count
	#CREATE TABLE recipes_new LIKE production.recipes;
	#INSERT INTO recipes_new SELECT * FROM production.recipes;
	#$random_row = mysqli_fetch_row(mysqli_query("select * from YOUR_TABLE order by rand() limit 1"));
	// Game ----------------------------- Game
	$game = 1; // Georgia Fantasy 5
	#$game = 2; // Mega Millions
	//$game = 3; // Georgia 5
	#$game = 4; // Jumbo
	#$game = 5; // Florida Mega Money
	#$game = 6; // Florida Lotto
	#$game = 7; // Powerball
	// Game ----------------------------- Game

	$hml = 0;
	#$hml = 1;		#= high
	#$hml = 2;		#= medium
	#$hml = 3;		#= low
	#$hml = 4;		#= min
	#$hml = 5;		#= max
	#$hml = 110;	

	set_time_limit(0);

	$debug = 1;

	if ($debug)
	{
		ini_set('display_errors', '1');
		ini_set('display_startup_errors', '1');
		error_reporting(E_ALL);
	}

	set_time_limit(0);

	require ("includes/games_switch.incl");

	require ("includes/mysqli.php");
	#require ("includes/db.class");
	require ('includes/db.class.php');

	require ("includes/even_odd.php");
	require ("includes/build_rank_table.php");
	require ("includes/calculate_draw.php"); 
	require ("includes/calculate_rank.php");
	require ("includes/first_draw_unix.php");
	require ("includes/last_draw_unix.php");
	require ("includes/last_draws.php");
	require ("includes/next_draw.php");
	#require ("includes_ga_f5/combin.incl");
	require_once ("$game_includes/calc_devsq.php");
	require ("includes/calculate_50_50.php");
	require ("includes/calculate_drange4.php");
	require ("includes/calculate_drange5.php");
	require ("includes/calculate_drange6.php");
	require ("includes/calculate_drange7.php");
	require ("includes/calculate_drange8.php");
	require ("includes/calculate_drange9.php");
	require ("includes/calculate_drange10.php");
	require ("includes/display_sumeo.php");
	#require ("includes_ga_f5/split_draws_2.php");
	require ("includes_ga_f5/split_sumeo_2.php");
	require ("includes_ga_f5/split_sumeo_3.php");
	require ("includes_ga_f5/split_sumeo_4.php");
	require ("includes_ga_f5/split_sumeo_5.php");
	require ("includes_ga_f5/update_combo_sumeo_5.php");
	require ("includes/print_column_test_sumeo.php"); #200915
	#require ("includes_ga_f5/update_combo_sumeo_4.php");
	#require ("includes_ga_f5/update_combo_sumeo_3.php");
	#require ("includes_ga_f5/update_combo_sumeo_2.php");
	require ("includes_ga_f5/combin_sumeo.incl");

	require_once ("includes/dateDiffInDays.php");
	require_once ("includes/unix.incl");
	require_once ("includes/print_sumeo_drange.incl");	###220413

	date_default_timezone_set('America/New_York');

	require_once ("includes/hml_switch.incl");	

	// ----------------------------------------------------------------------------------
	function print_draw_summary($sum,$even,$odd)
	{
		global $draw_table_name, $balls, $balls_drawn, $draw_prefix, $col1_select, $hml, $range_low, $range_high, $game; 

		require ("includes/unix.incl");

		require ("includes/mysqli.php");
	
		require ("includes/calculate_draw_summary_sumeo.incl");

		require ("includes/print_draw_summary_sumeo.incl");

		#echo "add range & summary<br>";

		#print "<h3>Table <font color=\"#ff0000\">{$draw_prefix}sum</font> Updated!</h3>";
	}

	// ----------------------------------------------------------------------------------
	function print_sum_grid_sum4_sumeo($combin,$sumeo_sum,$sumeo_even,$sumeo_odd)
	{
		global $draw_table_name, $balls, $balls_drawn, $draw_prefix, $col1_select, $hml, $range_low, $range_high; 

		require ("includes/mysqli.php");
	
		require ("includes/calculate_sum_count_sum4_sumeo.incl");

		require ("includes/print_sum_table_sum4_sumeo.incl");

		#require ("includes/print_sum_table_sum_top25_4_sumeo.incl");

		#print "<h3>Table <font color=\"#ff0000\">{$draw_prefix}sum $combin</font> Updated!</h3>";
	}

	// ----------------------------------------------------------------------------------
	function print_sum_grid_sum3_sumeo($combin,$sumeo_sum,$sumeo_even,$sumeo_odd)
	{
		global $draw_table_name, $balls, $balls_drawn, $draw_prefix, $col1_select, $hml, $range_low, $range_high; 

		require ("includes/mysqli.php");
	
		require ("includes/calculate_sum_count_sum3_sumeo.incl");

		require ("includes/print_sum_table_sum3_sumeo.incl");

		#require ("includes/print_sum_table_sum_top25_4_sumeo.incl");

		#print "<h3>Table <font color=\"#ff0000\">{$draw_prefix}sum $combin</font> Updated!</h3>";
	}

	// ----------------------------------------------------------------------------------
	function print_sum_grid_sum2_sumeo($combin,$sumeo_sum,$sumeo_even,$sumeo_odd)
	{
		global $draw_table_name, $balls, $balls_drawn, $draw_prefix, $col1_select, $hml, $range_low, $range_high; 

		require ("includes/mysqli.php");
	
		require ("includes/calculate_sum_count_sum2_sumeo.incl");

		require ("includes/print_sum_table_sum2_sumeo.incl");

		#require ("includes/print_sum_table_sum_top25_4_sumeo.incl");

		#print "<h3>Table <font color=\"#ff0000\">{$draw_prefix}sum $combin</font> Updated!</h3>";
	}

	//start HTML page
	print("<HTML>\n");
	print("<HEAD>\n");
	print("<TITLE>$game_name Quick Draw Machine - $game_name</TITLE>\n");
	print("</HEAD>\n");
	
	print("<BODY>\n");

	print "<h3><a href=\"#26\">Limit 26</a> | <a href=\"#5000\">Limit 5000</a></h3>";

	################################################################################################

	$curr_date = date('Y-m-d');

	$date = strtotime($curr_date);
    #$date = strtotime("-1 day", $date);
    $last_updated = date('y-m-d', $date);

	##echo "$last_updated<br>";

	$date = explode('-', $last_updated);

	$lastupdated = $date[0];
	$lastupdated .= $date[1];
	$lastupdated .= $date[2];

	$sumeo = 5; 
	$rebuild_counts = 0;

	if ($rebuild_counts)
	{
		$query1 = "SELECT * FROM `ga_f5_sum_count_sum`  ";
		$query1 .= "ORDER BY `ga_f5_sum_count_sum`.`month3` DESC, `month6` DESC, `year1` DESC ";
		$query1 .= "LIMIT 25 ";

		##echo "$query1<br>";
	
		$mysqli_result_1 = mysqli_query($mysqli_link, $query1) or die (mysqli_error($mysqli_link));

		while($row6 = mysqli_fetch_array($mysqli_result_1))
		{
			#echo "<h2>*** SumEO = $row6[1],$row6[2],$row6[3] - sumeo $sumeo</h2>";
			
			$sum = $row6[1];
			$even = $row6[2];
			$odd = $row6[3];

			print_draw_summary($sum,$even,$odd);

			for ($col = 1; $col <= 5; $col++)
			{
				print_column_test_sumeo($col, $row6[1], $row6[2], $row6[3]); #200915
			}

			split_sumeo_5 ($sum,$even,$odd);

			split_sumeo_4 ($sum,$even,$odd);

			split_sumeo_3 ($row6[1],$row6[2],$row6[3]);

			split_sumeo_2 ($row6[1],$row6[2],$row6[3]);

			for ($s = 1; $s <= 5; $s++)
			{
				print_sum_grid_sum4_sumeo($combin=$s,$row6[1],$row6[2],$row6[3]);
			}

			for ($s = 1; $s <= 10; $s++)
			{
				print_sum_grid_sum3_sumeo($combin=$s,$row6[1],$row6[2],$row6[3]);
			}

			for ($s = 1; $s <= 10; $s++)
			{
				print_sum_grid_sum2_sumeo($combin=$s,$row6[1],$row6[2],$row6[3]);
			}
		}
	}

	###################################################################################################################

	$temp_table1 = 'temp2_column_sumeo_summary' . '_' . $date[0] . $date[1] . $date[2]; 

	$query4 = "DROP TABLE IF EXISTS $temp_table1 ";

	##echo "$query4<p>";

	$mysqli_result4 = mysqli_query($mysqli_link, $query4) or die (mysqli_error($mysqli_link));

	$query4 = "CREATE TABLE $temp_table1 (";
	$query4 .= " `id` int(10) unsigned NOT NULL auto_increment, ";
	$query4 .= "`sum` tinyint(3) unsigned NOT NULL,";
	$query4 .= "`even` tinyint(3) unsigned NOT NULL,";
	$query4 .= "`odd` tinyint(3) unsigned NOT NULL,";
	$query4 .= "`column` tinyint(3) unsigned NOT NULL,";
	$query4 .= "`num` tinyint(3) unsigned NOT NULL,";
	$query4 .= "day1 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "week1 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "week2 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "month1 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "month3 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "month6 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "year1 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "year2 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "year3 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "year4 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "year5 int(5) unsigned NOT NULL default '0', ";
	$query4 .= "year6 int(5) unsigned NOT NULL default '0', ";
	$query4 .= "year7 int(5) unsigned NOT NULL default '0', ";
	$query4 .= "year8 int(5) unsigned NOT NULL default '0', ";
	$query4 .= "year9 int(5) unsigned NOT NULL default '0', ";
	$query4 .= "year10 int(5) unsigned NOT NULL default '0', ";
	$query4 .= "count int(5) unsigned NOT NULL default '0', ";
	$query4 .= "percent_y1 float(5,3) unsigned NOT NULL default '0', ";
	$query4 .= "percent_y5 float(5,3) unsigned NOT NULL default '0', ";
	$query4 .= "percent_wa float(5,3) unsigned NOT NULL default '0', ";
	$query4 .= "  PRIMARY KEY  (`id`) ";
	$query4 .= ") ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 "; 

	##echo "$query4<p>";

	$mysqli_result4 = mysqli_query($mysqli_link, $query4) or die (mysqli_error($mysqli_link));

	$query1 = "SELECT * FROM `ga_f5_sum_count_sum`  ";
	$query1 .= "ORDER BY `ga_f5_sum_count_sum`.`month3` DESC, `month6` DESC, `year1` DESC ";
	$query1 .= "LIMIT 25 ";

	#echo "$query1<br>";

	$mysqli_result_1 = mysqli_query($mysqli_link, $query1) or die (mysqli_error($mysqli_link));

	while($row1 = mysqli_fetch_array($mysqli_result_1))
	{
		for ($col = 1; $col<= 5; $col++)
		{
			$temp_table2 = 'temp2_column_sumeo_' . $row1[1] . '_' . $row1[2] . '_' . $row1[3] . '_' . $col;

			$query3 = "SELECT * FROM $temp_table2 ";
			$query3 .= "WHERE percent_wa > 0.00 ";

			#echo "$query3<br>";

			$mysqli_result_3 = mysqli_query($mysqli_link, $query3) or die (mysqli_error($mysqli_link));

			while($row3 = mysqli_fetch_array($mysqli_result_3))
			{
				$query5 = "INSERT INTO $temp_table1 ";
				$query5 .= "VALUES ('0', ";
				$query5 .= "'$row1[1]', ";
				$query5 .= "'$row1[2]', ";
				$query5 .= "'$row1[3]', ";
				$query5 .= "'$col', ";
				$query5 .= "'$row3[0]', ";
				
				for ($d = 1; $d <= 19; $d++) 
				{
					$query5 .= "'$row3[$d]', ";
				}
				$query5 .= "'$row3[20]') ";

				#echo "$query5<br>";
			
				$mysqli_result_5 = mysqli_query($mysqli_link, $query5) or die (mysqli_error($mysqli_link));
			}
		}
	}

	###################################################################################################################

	$temp_table1 = 'temp2_column_sumeo_summary' . '_' . $date[0] . $date[1] . $date[2]; 

	$query4 = "DROP TABLE IF EXISTS $temp_table1 ";

	##echo "$query4<p>";

	$mysqli_result4 = mysqli_query($mysqli_link, $query4) or die (mysqli_error($mysqli_link));

	$query4 = "CREATE TABLE $temp_table1 (";
	$query4 .= "  `id` int(10) unsigned NOT NULL auto_increment, ";
	$query4 .= "`sum` tinyint(3) unsigned NOT NULL,";
	$query4 .= "`even` tinyint(3) unsigned NOT NULL,";
	$query4 .= "`odd` tinyint(3) unsigned NOT NULL,";
	$query4 .= "`column` tinyint(3) unsigned NOT NULL,";
	$query4 .= "`num` tinyint(3) unsigned NOT NULL,";
	$query4 .= "day1 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "week1 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "week2 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "month1 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "month3 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "month6 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "year1 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "year2 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "year3 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "year4 tinyint(3) unsigned NOT NULL default '0', ";
	$query4 .= "year5 int(5) unsigned NOT NULL default '0', ";
	$query4 .= "year6 int(5) unsigned NOT NULL default '0', ";
	$query4 .= "year7 int(5) unsigned NOT NULL default '0', ";
	$query4 .= "year8 int(5) unsigned NOT NULL default '0', ";
	$query4 .= "year9 int(5) unsigned NOT NULL default '0', ";
	$query4 .= "year10 int(5) unsigned NOT NULL default '0', ";
	$query4 .= "count int(5) unsigned NOT NULL default '0', ";
	$query4 .= "percent_y1 float(5,3) unsigned NOT NULL default '0', ";
	$query4 .= "percent_y5 float(5,3) unsigned NOT NULL default '0', ";
	$query4 .= "percent_wa float(5,3) unsigned NOT NULL default '0', ";
	$query4 .= "  PRIMARY KEY  (`id`) ";
	$query4 .= ") ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 "; 

	##echo "$query4<p>";

	$mysqli_result4 = mysqli_query($mysqli_link, $query4) or die (mysqli_error($mysqli_link));

	$query1 = "SELECT * FROM `ga_f5_sum_count_sum`  ";
	$query1 .= "ORDER BY `ga_f5_sum_count_sum`.`month3` DESC, `month6` DESC, `year1` DESC ";
	$query1 .= "LIMIT 25 ";

	#echo "$query1<br>";

	$mysqli_result_1 = mysqli_query($mysqli_link, $query1) or die (mysqli_error($mysqli_link));

	while($row1 = mysqli_fetch_array($mysqli_result_1))
	{
		for ($col = 1; $col<= 5; $col++)
		{
			$temp_table2 = 'temp2_column_sumeo_' . $row1[1] . '_' . $row1[2] . '_' . $row1[3] . '_' . $col;

			$query3 = "SELECT * FROM $temp_table2 ";
			$query3 .= "WHERE percent_wa > 0.00 ";

			#echo "$query3<br>";

			$mysqli_result_3 = mysqli_query($mysqli_link, $query3) or die (mysqli_error($mysqli_link));

			while($row3 = mysqli_fetch_array($mysqli_result_3))
			{
				$query5 = "INSERT INTO $temp_table1 ";
				$query5 .= "VALUES ('0', ";
				$query5 .= "'$row1[1]', ";
				$query5 .= "'$row1[2]', ";
				$query5 .= "'$row1[3]', ";
				$query5 .= "'$col', ";
				$query5 .= "'$row3[0]', ";
				
				for ($d = 1; $d <= 19; $d++) 
				{
					$query5 .= "'$row3[$d]', ";
				}
				$query5 .= "'$row3[20]') ";

				#echo "$query5<br>";
			
				$mysqli_result_5 = mysqli_query($mysqli_link, $query5) or die (mysqli_error($mysqli_link));
			}
		}
	}

	###################################################################################################################

	$temp_table1 = 'temp2_column_sumeo_col_2_summary' . '_' . $date[0] . $date[1] . $date[2]; 

	$query4 = "DROP TABLE IF EXISTS $temp_table1 ";

	#echo "$query4<p>";

	$mysqli_result4 = mysqli_query($mysqli_link, $query4) or die (mysqli_error($mysqli_link));

	$query4 = "CREATE TABLE $temp_table1 (";
	$query4 .= "`id` int(10) unsigned NOT NULL auto_increment, ";
	$query4 .= "`sum` tinyint(3) unsigned NOT NULL,";
	$query4 .= "`even` tinyint(1) unsigned NOT NULL,";
	$query4 .= "`odd` tinyint(1) unsigned NOT NULL,";
	$query4 .= "`col1` tinyint(1) unsigned NOT NULL,";
	$query4 .= "`col2` tinyint(1) unsigned NOT NULL,";
	$query4 .= "`num1` tinyint(2) unsigned NOT NULL,";
	$query4 .= "`num2` tinyint(2) unsigned NOT NULL,";
	$query4 .= "`count` mediumint(4) unsigned NOT NULL,";
	$query4 .= " y1_sum float(5,3) unsigned NOT NULL default '0', ";
	$query4 .= "  PRIMARY KEY  (`id`) ";
	$query4 .= ") ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 "; 

	#echo "$query4<p>";

	$mysqli_result4 = mysqli_query($mysqli_link, $query4) or die (mysqli_error($mysqli_link));

	$query1 = "SELECT * FROM `ga_f5_sum_count_sum`  ";
	$query1 .= "ORDER BY `ga_f5_sum_count_sum`.`month3` DESC, `month6` DESC, `year1` DESC ";
	$query1 .= "LIMIT 25 ";

	#echo "$query1<br>";

	$mysqli_result_1 = mysqli_query($mysqli_link, $query1) or die (mysqli_error($mysqli_link));

	while($row1 = mysqli_fetch_array($mysqli_result_1))
	{
		for ($a = 1; $a<= 4; $a++)
		{
			for ($b = $a+1; $b<= 5; $b++)
			{
				$temp_table2 = 'temp_split_count_' . $a . '_' . $b . '_' .$row1[1] . '_' . $row1[2] . '_' . $row1[3];

				$query3 = "SELECT * FROM $temp_table2 ";
				$query3 .= "WHERE y1_sum > 0.00 ";

				#echo "$query3<br>";

				$mysqli_result_3 = mysqli_query($mysqli_link, $query3) or die (mysqli_error($mysqli_link));

				while($row3 = mysqli_fetch_array($mysqli_result_3))
				{
					$query5 = "INSERT INTO $temp_table1 ";
					$query5 .= "VALUES ('0', ";
					$query5 .= "'$row1[1]', ";
					$query5 .= "'$row1[2]', ";
					$query5 .= "'$row1[3]', ";
					$query5 .= "'$a', ";
					$query5 .= "'$b', ";
					$query5 .= "'$row3[1]', ";
					$query5 .= "'$row3[2]', ";
					$query5 .= "'$row3[3]', ";
					$query5 .= "'$row3[4]') ";

					#echo "$query5<br>";
				
					$mysqli_result_5 = mysqli_query($mysqli_link, $query5) or die (mysqli_error($mysqli_link));
				}
			}
		}
	}
	###################################################################################################################

	$temp_table1 = 'temp2_column_sumeo_col_3_summary' . '_' . $date[0] . $date[1] . $date[2]; 

	$query4 = "DROP TABLE IF EXISTS $temp_table1 ";

	#echo "$query4<p>";

	$mysqli_result4 = mysqli_query($mysqli_link, $query4) or die (mysqli_error($mysqli_link));

	$query4 = "CREATE TABLE $temp_table1 (";
	$query4 .= "`id` int(10) unsigned NOT NULL auto_increment, ";
	$query4 .= "`sum` tinyint(3) unsigned NOT NULL,";
	$query4 .= "`even` tinyint(1) unsigned NOT NULL,";
	$query4 .= "`odd` tinyint(1) unsigned NOT NULL,";
	$query4 .= "`col1` tinyint(1) unsigned NOT NULL,";
	$query4 .= "`col2` tinyint(1) unsigned NOT NULL,";
	$query4 .= "`col3` tinyint(1) unsigned NOT NULL,";
	$query4 .= "`num1` tinyint(2) unsigned NOT NULL,";
	$query4 .= "`num2` tinyint(2) unsigned NOT NULL,";
	$query4 .= "`num3` tinyint(2) unsigned NOT NULL,";
	$query4 .= "`count` mediumint(4) unsigned NOT NULL,";
	$query4 .= " y1_sum float(5,3) unsigned NOT NULL default '0', ";
	$query4 .= "  PRIMARY KEY  (`id`) ";
	$query4 .= ") ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 "; 

	#echo "$query4<p>";

	$mysqli_result4 = mysqli_query($mysqli_link, $query4) or die (mysqli_error($mysqli_link));

	$query1 = "SELECT * FROM `ga_f5_sum_count_sum`  ";
	$query1 .= "ORDER BY `ga_f5_sum_count_sum`.`month3` DESC, `month6` DESC, `year1` DESC ";
	$query1 .= "LIMIT 25 ";

	#echo "$query1<br>";

	$mysqli_result_1 = mysqli_query($mysqli_link, $query1) or die (mysqli_error($mysqli_link));

	while($row1 = mysqli_fetch_array($mysqli_result_1))
	{
		for ($a = 1; $a<= 3; $a++)
		{
			for ($b = $a+1; $b<= 4; $b++)
			{
				for ($c = $b+1; $c<= 5; $c++)
				{
					$temp_table2 = 'temp_split_count_' . $a . '_' . $b . '_' . $c . '_' . $row1[1] . '_' . $row1[2] . '_' . $row1[3];

					$query3 = "SELECT * FROM $temp_table2 ";
					$query3 .= "WHERE y1_sum > 0.00 ";

					#echo "$query3<br>";

					$mysqli_result_3 = mysqli_query($mysqli_link, $query3) or die (mysqli_error($mysqli_link));

					while($row3 = mysqli_fetch_array($mysqli_result_3))
					{
						$query5 = "INSERT INTO $temp_table1 ";
						$query5 .= "VALUES ('0', ";
						$query5 .= "'$row1[1]', ";
						$query5 .= "'$row1[2]', ";
						$query5 .= "'$row1[3]', ";
						$query5 .= "'$a', ";
						$query5 .= "'$b', ";
						$query5 .= "'$c', ";
						$query5 .= "'$row3[1]', ";
						$query5 .= "'$row3[2]', ";
						$query5 .= "'$row3[3]', ";
						$query5 .= "'$row3[4]', ";
						$query5 .= "'$row3[5]') ";

						#echo "$query5<br>";
					
						$mysqli_result_5 = mysqli_query($mysqli_link, $query5) or die (mysqli_error($mysqli_link));
					}
				}
			}
		}
	}

	die();

	mysqli_data_seek($mysqli_result_1, 0);
	
	
	print("</BODY>\n");
?>
