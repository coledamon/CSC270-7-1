<?php
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function getMediaById($dbConn, $id) {
    $query = "SELECT JSON_OBJECT(
                'id', m.id,
                'Name', m.media_name,
                'Year', m.year,
                'Creator', m.creator,
                'Genre', m.genre,
                'Link', m.link,
                'Title', mp.title,
                'Heading', mp.heading,
                'Body', mp.body) as Media
                FROM Media m
                LEFT JOIN MediaPage mp 
                    ON mp.media_id = m.id
                WHERE m.id = ".$id.";";
    $result = @mysqli_query($dbConn, $query);
    return $result? $result : @mysqli_error($dbConn);
}
if(isset($_GET["id"]) && $_GET["id"]) {
    $id = sanitizeInput($_GET["id"]);
    if(is_numeric($id)) {
        $id = (int)$id;
        $json = formatRecords(getMediaById($dbConn, $id));
        if($json == "null") {
            echo json_encode(json_decode('{"error": "Invalid Id"}'));
        }
        else {
            echo $json;
        }
        connClose($dbConn);
    }
    else {
        echo json_encode(json_decode('{"error": "Invalid Id"}'));
    }
}
else {
    echo json_encode(json_decode('{"error": "No Id"}'));
}
?>
