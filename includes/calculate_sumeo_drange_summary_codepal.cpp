#include <iostream>
#include <string>
#include <mysql/mysql.h>

int main() {
    MYSQL* conn;
    MYSQL_RES* res;
    MYSQL_ROW row;

    conn = mysql_init(NULL);
    if (!mysql_real_connect(conn, "localhost", "user", "password", "database", 0, NULL, 0)) {
        std::cout << "Connection error: " << mysql_error(conn) << std::endl;
        return 1;
    }

    std::string temp_summary = "temp_sumeo_drange_summary2";
    std::string draw_prefix = "draw_prefix";

    std::string query4 = "DROP TABLE IF EXISTS " + draw_prefix + "sumeo_drange_summary";
    if (mysql_query(conn, query4.c_str())) {
        std::cout << "Query error: " << mysql_error(conn) << std::endl;
        return 1;
    }

    query4 = "CREATE TABLE " + draw_prefix + "sumeo_drange_summary ("
             "`id` mediumint UNSIGNED NOT NULL auto_increment,"
             "sum tinyint(3) unsigned NOT NULL default '0',"
             "even tinyint(1) unsigned NOT NULL default '0',"
             "odd  tinyint(1) unsigned NOT NULL default '0',"
             "drange tinyint(1) unsigned NOT NULL default '0',"
             "d_1 tinyint(3) unsigned NOT NULL default '0',"
             "d_2 tinyint(3) unsigned NOT NULL default '0',"
             "d_3 tinyint(3) unsigned NOT NULL default '0',"
             "d_4 tinyint(3) unsigned NOT NULL default '0',"
             "d_5 tinyint(3) unsigned NOT NULL default '0',"
             "d_6 tinyint(3) unsigned NOT NULL default '0',"
             "d_7 tinyint(3) unsigned NOT NULL default '0',"
             "dcount int(5) unsigned NOT NULL,"
             "percent_y1 float(5,3) unsigned NOT NULL,"
             "percent_y5 float(5,3) unsigned NOT NULL,"
             "percent_wa float(5,3) unsigned NOT NULL,"
             "PRIMARY KEY  (id),"
             "UNIQUE KEY `id_2` (id),"
             "KEY id (id)"
             ") ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

    if (mysql_query(conn, query4.c_str())) {
        std::cout << "Query error: " << mysql_error(conn) << std::endl;
        return 1;
    }

    std::string query0 = "SELECT * FROM " + draw_prefix + "sum_count_sum "
                         "ORDER BY month3 DESC, month1 DESC, week2 DESC "
                         "LIMIT 40";

    std::cout << query0 << std::endl;

    if (mysql_query(conn, query0.c_str())) {
        std::cout << "Query error: " << mysql_error(conn) << std::endl;
        return 1;
    }

    res = mysql_use_result(conn);
    while ((row = mysql_fetch_row(res)) != NULL) {
        std::string querya = "INSERT INTO " + draw_prefix + "sumeo_drange_summary "
                             "VALUES ('0', '" + std::string(row[0]) + "', '" + std::string(row[1]) + "', '" + std::string(row[2]) + "', '0', '0', '0', '0', '0', '0', '0', '0', '" + std::string(row[3]) + "', '" + std::string(row[4]) + "', '" + std::string(row[5]) + "')";

        std::cout << querya << std::endl;

        if (mysql_query(conn, querya.c_str())) {
            std::cout << "Query error: " << mysql_error(conn) << std::endl;
            return 1;
        }

        for (int r = 2; r <= 7; r++) {
            std::string query3 = "SELECT * FROM " + draw_prefix + "sumeo_drange" + std::to_string(r) + " "
                                 "WHERE sum  = '" + std::string(row[0]) + "' "
                                 "AND   even = '" + std::string(row[1]) + "' "
                                 "AND   odd  = '" + std::string(row[2]) + "' "
                                 "AND   percent_wa >= 0.1 "
                                 "ORDER BY percent_y5 DESC, percent_y1 DESC, year1 DESC, month6 DESC, month3 DESC, month1 DESC";

            std::cout << query3 << std::endl;

            if (mysql_query(conn, query3.c_str())) {
                std::cout << "Query error: " << mysql_error(conn) << std::endl;
                return 1;
            }

            MYSQL_RES* res3 = mysql_use_result(conn);
            while ((row = mysql_fetch_row(res3)) != NULL) {
                std::string queryb = "INSERT INTO " + draw_prefix + "sumeo_drange_summary "
                                     "VALUES ('0', '" + std::string(row[0]) + "', '" + std::string(row[1]) + "', '" + std::string(row[2]) + "', '" + std::to_string(r) + "', '" + std::string(row[3]) + "', '" + std::string(row[4]) + "', '" + std::string(row[5]) + "', '" + std::string(row[6]) + "', '" + std::string(row[7]) + "', '" + std::string(row[8]) + "', '" + std::string(row[9]) + "', '" + std::string(row[10]) + "', '" + std::string(row[11]) + "', '" + std::string(row[12]) + "', '" + std::string(row[13]) + "', '" + std::string(row[14]) + "')";

                std::cout << queryb << std::endl;

                if (mysql_query(conn, queryb.c_str())) {
                    std::cout << "Query error: " << mysql_error(conn) << std::endl;
                    return 1;
                }
            }
            mysql_free_result(res3);
        }
    }
    mysql_free_result(res);

    std::string table_temp_summary = draw_prefix + "sumeo_drange_summary";
    std::string table_temp_date = temp_summary + "_" + dateDiff;

    std::string query = "DROP TABLE IF EXISTS " + table_temp_date;

    if (mysql_query(conn, query.c_str())) {
        std::cout << "Query error: " << mysql_error(conn) << std::endl;
        return 1;
    }

    std::string query_copy = "CREATE TABLE " + table_temp_date + " SELECT * FROM " + table_temp_summary;

    if (mysql_query(conn, query_copy.c_str())) {
        std::cout << "Query error: " << mysql_error(conn) << std::endl;
        return 1;
    }

    std::cout << "<h3>Table <font color=\"#ff0000\">" << table_temp_date << "</font> Updated!</h3>" << std::endl;

    mysql_close(conn);

    return 0;
}