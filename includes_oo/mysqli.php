<?php

echo "<h3>using mysqli_oop</h3>";

class Database {
    private $mysqli_link;

    public function __construct($game) {
        switch ($game) {
            case 1:
                $this->connect("ga_f5_lotto", "root", "");
                break;
            case 2:
                $this->connect("megamillions", "root", "wef5esuv");
                break;
            // Add other cases here
            default:
                $this->connect("default_database", "root", "");
                break;
        }
    }

    private function connect($dbName, $user, $password) {
        $this->mysqli_link = new mysqli("localhost", $user, $password, $dbName);
        if ($this->mysqli_link->connect_errno) {
            printf("Connect failed: %s\n", $this->mysqli_link->connect_error);
            exit();
        }
    }

    public function getLink() {
        return $this->mysqli_link;
    }
}

// Usage
$game = 1; // This can be set dynamically as per your requirement
$db = new Database($game);
$mysqli_link = $db->getLink();

// Rest of your code that uses $mysqli_link
?>
