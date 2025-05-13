#include <iostream>
#include <string>

using namespace std;

int main() {
  // Create a new table called `sumeo_drange_summary`.
  string query = "CREATE TABLE sumeo_drange_summary (";
  query += "`id` mediumint UNSIGNED NOT NULL auto_increment,";
  query += "sum tinyint(3) unsigned NOT NULL default '0',";
  query += "even tinyint(1) unsigned NOT NULL default '0',";
  query += "odd  tinyint(1) unsigned NOT NULL default '0',";
  query += "drange tinyint(1) unsigned NOT NULL default '0',";
  query += "d_1 tinyint(3) unsigned NOT NULL default '0',";
  query += "d_2 tinyint(3) unsigned NOT NULL default '0',";
  query += "d_3 tinyint(3) unsigned NOT NULL default '0',";
  query += "d_4 tinyint(3) unsigned NOT NULL default '0',";
  query += "d_5 tinyint(3) unsigned NOT NULL default '0',";
  query += "d_6 tinyint(3) unsigned NOT NULL default '0',";
  query += "d_7 tinyint(3) unsigned NOT NULL default '0',";
  query += "dcount int(5) unsigned NOT NULL,";
  query += "percent_y1 float(5,3) unsigned NOT NULL,";
  query += "percent_y5 float(5,3) unsigned NOT NULL,";
  query += "percent_wa float(5,3) unsigned NOT NULL,";
  query += "PRIMARY KEY  (id),";
  query += "UNIQUE KEY `id_2` (id),";
  query += "KEY id (id)";
  query += ") ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

  cout << query << endl;

  // Insert data into the table from two other tables: `sum_count_sum` and `sumeo_drange`.
  query = "INSERT INTO sumeo_drange_summary (";
  query += "sum, even, odd, drange, d_1, d_2, d_3, d_4, d_5, d_6, d_7, dcount, percent_y1, percent_y5, percent_wa";
  query += ") SELECT sum, even, odd, 0, d_1, d_2, d_3, d_4, d_5, d_6, d_7, year5, percent_y1, percent_y5, percent_wa";
  query += "FROM sum_count_sum";
  query += "ORDER BY month3 DESC, month1 DESC, week2 DESC";
  query += "LIMIT 40";

  cout << query << endl;

  // Create a new table called `temp_date` that is a copy of the `sumeo_drange_summary` table.
  query = "DROP TABLE IF EXISTS temp_date";
  cout << query << endl;

  query = "CREATE TABLE temp_date SELECT * FROM sumeo_drange_summary";
  cout << query << endl;

  return 0;
}