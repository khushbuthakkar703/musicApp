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
    if(!empty($countryData)) {
        $country_id = $countryData->id;
        foreach($row['provinces']['results'] as $state) {
            $stmt_state = $conn->prepare("SELECT * FROM states WHERE name=? and country_id=? limit 1");
            $stmt_state->bind_param('ss', $state['Subdivision_Name'], $country_id);
            $stmt_state->execute();
            $result = $stmt_state->get_result();
            $stateData = $result->fetch_object();
            if(empty($stateData)) {
                $sth = $conn->prepare("INSERT INTO states(name, country_id) VALUES (?, ?)");
                $sth->bind_param("ss", $state['Subdivision_Name'], $country_id);
                $sth->execute();
                echo 'Insert';
            }
            else {
                echo 'State already exits';
            }
        }
    }
}
?>