<?php
require_once 'db.php'; 
$posts = array();
$query = "SELECT * FROM country ";

$stmt = $db_con->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $posts[] = $row;
}
/* send a JSON encded array to client */
header('Content-type: application/json');
echo json_encode($posts);
