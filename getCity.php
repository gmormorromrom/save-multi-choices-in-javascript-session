<?php

require_once 'db.php';
$state_id = $_GET['stateId'];
/* SQL query to get results from database */
$posts = array();
$query = "SELECT * FROM city WHERE state_id = :stateId";

$stmt = $db_con->prepare($query);
$stmt->bindParam(':stateId', $state_id, PDO::PARAM_INT);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $posts[] = $row;
}
/* send a JSON encded array to client */
header('Content-type: application/json');
echo json_encode($posts);
