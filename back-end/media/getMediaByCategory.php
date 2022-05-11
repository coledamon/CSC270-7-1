<?php
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function getMediaByCategory($dbConn, $name) {
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
                JOIN Category c
                    ON m.category_id = c.id
                LEFT JOIN MediaPage mp
                    ON mp.media_id = m.id
                WHERE c.category_name = \"".$name."\";";
    $result = @mysqli_query($dbConn, $query);
    return $result? $result : @mysqli_error($dbConn);
}
if(isset($_GET["name"]) && $_GET["name"]) {
    $name = sanitizeInput($_GET["name"]);
    $json = formatRecords(getMediaByCategory($dbConn, $name));
    if($json == "null") {
        echo json_encode(json_decode('{"error": "Invalid Category Name"}'));
    }
    else {
        echo $json;
    }
    connClose($dbConn);
}
else {
    echo json_encode(json_decode('{"error": "No Category Name"}'));
}
?>
