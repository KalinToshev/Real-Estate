<?php
session_start();
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "real_estate";

$conn = new mysqli($servername, $username, $password, $dbname);

class Database
{
    public $conn;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
    }

    public function getFilteredData($property_type, $price_range, $city)
    {
        $query = "SELECT * FROM properties WHERE 1";

        if ($property_type != "") {
            $query .= " AND ptype = '{$property_type}'";
        }

        if ($price_range != "") {
            $price_range_values = explode('-', $price_range);

            if (count($price_range_values) == 2) {
                $min_price = intval($price_range_values[0]);
                $max_price = intval($price_range_values[1]);
                $query .= " AND price BETWEEN {$min_price} AND {$max_price}";
            } elseif (substr($price_range, -1) == "+") {
                $min_price = intval(substr($price_range, 0, -1));
                $query .= " AND price >= {$min_price}";
            }
        }

        if ($city != "") {
            $query .= " AND city = '{$city}'";
        }

        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            echo "Error: " . mysqli_error($this->conn);
        }

        return $result;
    }
}

$database = new Database($servername, $username, $password, $dbname);
?>