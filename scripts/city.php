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
            $result_state = $stmt_state->get_result();
            $stateData = $result_state->fetch_object();
            if(!empty($stateData)) {
                $state_id = $stateData->id;
                foreach($state['cities']['results'] as $city) {
                    $stmt_city = $conn->prepare("SELECT * FROM cities WHERE name=? and state_id=? limit 1");
                    $stmt_city->bind_param('ss', $city['name'], $state_id);
                    $stmt_city->execute();
                    $result_city = $stmt_city->get_result();
                    $cityData = $result_city->fetch_object();
                    if(empty($cityData)) {
                        $sth = $conn->prepare("INSERT INTO cities(name, state_id) VALUES (?, ?)");
                        $sth->bind_param("ss", $city['name'], $state_id);
                        $sth->execute();
                        echo 'Insert';
                    }
                    else {
                        echo 'City already exits';
                    }
                }
            }
        }
    }
}
?>