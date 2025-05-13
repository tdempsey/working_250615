#include <iostream>
#include <string>
#include <mysql/mysql.h>

using namespace std;

int main() {
  // Create a MySQL connection object.
  MYSQL *conn = mysql_init(NULL);

  // Connect to the MySQL database.
  if (!mysql_real_connect(conn, "localhost", "root", "password", "my_database", 0, NULL, 0)) {
    cout << "Failed to connect to MySQL: " << mysql_error(conn) << endl;
    return 1;
  }

  // Create a method to call the MySQL database.
  void call_mysql_db() {
    // Create a query string.
    string query = "SELECT * FROM my_table";

    // Execute the query.
    MYSQL_RES *result = mysql_query(conn, query.c_str());

    // Iterate over the results.
    if (result) {
      MYSQL_ROW row;
      while ((row = mysql_fetch_row(result))) {
        // Print the row data.
        for (int i = 0; i < mysql_num_fields(result); i++) {
          cout << row[i] << " ";
        }
        cout << endl;
      }
    }
  }

  // Call the method.
  call_mysql_db();

  // Close the MySQL connection.
  mysql_close(conn);

  return 0;
}
