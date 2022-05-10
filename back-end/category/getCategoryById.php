<?php
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function getCategoryById($dbConn, $id) {
    $query = "SELECT JSON_OBJECT(
                'id', c.id,
                'Name', c.category_name,
                'Used',  If(c.used, cast(true as json), cast(false as json)),
                'Title', cp.title,
                'Body', cp.body) as Category
                FROM Category c
                JOIN CategoryPage cp
                    ON cp.category_id = c.id
                WHERE c.id = ".$id.";";
    $result = @mysqli_query($dbConn, $query);
    return $result? $result : @mysqli_error($dbConn);
}
if(isset($_GET["id"]) && $_GET["id"]) {
    $id = sanitizeInput($_GET["id"]);
    if(is_numeric($id)) {
        $id = (int)$id;
        $json = formatRecords(getCategoryById($dbConn, $id));
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
