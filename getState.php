<?php
require_once 'db.php'; 
$country_id =$_GET['countryId'];
$posts = array();
$query = "SELECT * FROM state WHERE country_id = :countryId";

$stmt = $db_con->prepare($query);
$stmt->bindParam(':countryId', $country_id, PDO::PARAM_INT);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $posts[] = $row;
}
/* send a JSON encded array to client */
header('Content-type: application/json');
echo json_encode($posts);
