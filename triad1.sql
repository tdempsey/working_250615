$sql = "SELECT DISTINCT `d1`,`d2`,`d3`,`combo`,`combo_count`,`draw_sum` FROM `aon_3_24` WHERE `combo` = 1 AND `draw_sum` >= 140 AND `draw_sum` <= 149 ORDER BY `aon_3_24`.`combo_count` DESC";
