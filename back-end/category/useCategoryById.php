<?php
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function useCategory($dbConn, $id) {
    $query = "UPDATE Media
                    SET used = 1
                    WHERE id =".$id;
    $result = @mysqli_query($dbConn, $query);
    return $result? $result : @mysqli_error($dbConn);
}

if(isset($_POST["id"]) && $_POST["id"]) {
    if(is_numeric($_POST["id"])) {
        $id = (int)sanitizeInput($_POST["id"]);

        $result = useCategory($dbConn, $id);
        if($result != 1) {
            echo json_encode(json_decode('{"error": "'.$result.'"}'));
        }
        else {
            echo "{}";
        }
        connClose($dbConn);
    }
    else {
        echo json_encode(json_decode('{"error": "Invalid Id"}'));
    }
}
else {
    echo json_encode(json_decode('{"error": "No Id Provided"}'));
}
?>
