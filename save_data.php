<?php
$servername = "your_server_name";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    foreach ($data as $id => $rowData) {
        $column1 = $rowData[0];
        $column2 = $rowData[1];
        $column3 = $rowData[2];
        $column4 = $rowData[3];
        $column5 = $rowData[4];
        
        $sql = "INSERT INTO roaster_table (id, column1, column2, column3, column4, column5)
                VALUES ('$id', '$column1', '$column2', '$column3', '$column4', '$column5')
                ON DUPLICATE KEY UPDATE column1='$column1', column2='$column2', column3='$column3',
                column4='$column4', column5='$column5'";
        $conn->query($sql);
    }
}

$conn->close();
?>
