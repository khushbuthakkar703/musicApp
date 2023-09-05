<?php
$servername = "localhost";
$username = "root";
$password = "";               
$dbname = "musicapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$path = __DIR__ .'\csc.json';
$data = json_decode(file_get_contents($path), true);
foreach($data['data']['countries']['results'] as $row) {
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name=? limit 1");
    $stmt->bind_param('s', $row['name']);
    $stmt->execute();
    $result = $stmt->get_result();
    $countryData = $result->fetch_object();
    if(empty($countryData)) {
        $sortname = '';
        $sth = $conn->prepare("INSERT INTO countries(sortname, name, phonecode) VALUES (?, ?, ?)");
        $sth->bind_param("sss", $sortname, $row['name'], $row['phone']);
        $sth->execute();
        echo 'Insert';
    }
    else {
        echo 'Country already exits';
    }
}
?>