<?php
class Database {
    private $mysqli;

    public function __construct($host, $user, $pass, $db) {
        $this->mysqli = new mysqli($host, $user, $pass, $db);
        if ($this->mysqli->connect_error) {
            die('Connect Error (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
        }
    }

    public function query($sql) {
        return $this->mysqli->query($sql);
    }

    public function fetchAll($result) {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function escape($str) {
        return $this->mysqli->real_escape_string($str);
    }

    public function __destruct() {
        $this->mysqli->close();
    }
}
?>

/* usage 

require_once 'includes/Database.php';
$db = new Database('localhost', 'root', 'password', 'lotto_db');
$result = $db->query('SELECT * FROM ga_f5_draws');
$data = $db->fetchAll($result);

*/