<?php
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function updateMedia($dbConn, $id, $name, $year, $creator, $genre, $link) {
    $queryUpdate = "UPDATE Media
                    SET ";
    $queryWhere=  " WHERE id=".$id;
    $queryUpdate .= ($name != null) ? "media_name=\"".$name."\", " : "";
    $queryUpdate .= ($year != null) ? "year=".$year.", " : "";
    $queryUpdate .= ($creator != null) ? "creator=\"".$creator."\", " : "";
    $queryUpdate .= ($genre != null) ? "genre=\"".$genre."\", " : "";
    $queryUpdate .= ($link != null) ? "link=\"".$link."\", " : "";
    $queryUpdate = substr($queryUpdate, 0, strripos($queryUpdate, ","));
    $result = @mysqli_query($dbConn, $queryUpdate.$queryWhere);
    return $result? $result : @mysqli_error($dbConn);
}

function updateMediaPage($dbConn, $id, $title, $heading, $body) {
    $queryUpdate = "UPDATE MediaPage
                    SET ";
    $queryWhere=  " WHERE media_id=".$id;
    $queryUpdate .= ($title != null) ? "title =\"".$title."\", " : "";
    $queryUpdate .= ($heading != null) ? "heading =\"".$heading."\", " : "";
    $queryUpdate .= ($body != null) ? "body=\"".$body."\", " : "";
    $queryUpdate = substr($queryUpdate, 0, strripos($queryUpdate, ","));
    $result = @mysqli_query($dbConn, $queryUpdate.$queryWhere);
    return $result? $result : @mysqli_error($dbConn);
}
if(isset($_POST["id"]) && $_POST["id"]) {
    if(is_numeric($_POST["id"])) {
        $updatedMedia = false;
        if((isset($_POST["name"]) || isset($_POST["creator"]) || isset($_POST["year"]) || isset($_POST["genre"]) || isset($_POST["link"])) && ($_POST["name"] || $_POST["creator"]|| $_POST["year"]||$_POST["genre"]||$_POST["link"])) {
            $id = (int)sanitizeInput($_POST["id"]);
            $name = isset($_POST["name"]) ? sanitizeInput($_POST["name"]): null;
            $creator = isset($_POST["creator"]) ? sanitizeInput($_POST["creator"]): null;
            $year = isset($_POST["year"]) ? sanitizeInput($_POST["year"]): null;
            $genre = isset($_POST["genre"]) ? sanitizeInput($_POST["genre"]): null;
            $link= isset($_POST["link"]) ? sanitizeInput($_POST["link"]): null;

            $result = updateMedia($dbConn, $id, $name, $year, $creator, $genre, $link);
            if($result != 1) {
                echo json_encode(json_decode('{"error": "'.$result.'"}'));
            }
            $updatedMedia = true;
        }
        if((isset($_POST["title"]) || isset($_POST["heading"]) ||isset($_POST["body"])) && ($_POST["title"] || $_POST["heading"] || $_POST["body"])) {
            $id = (int)sanitizeInput($_POST["id"]);
            $title = isset($_POST["title"]) ? sanitizeInput($_POST["title"]): null;
            $heading = isset($_POST["heading"]) ? sanitizeInput($_POST["heading"]): null;
            $body= isset($_POST["body"]) ? sanitizeInput($_POST["body"]): null;

            $result2 = updateMediaPage($dbConn, $id, $title, $heading, $body);
            if($result2 != 1) {
                echo json_encode(json_decode('{"error": "'.$result.'"}'));
            }
            else if ($result){
                echo true;
            }
        }
        else if(!$updatedMedia) {
            echo json_encode(json_decode('{"error": "'.var_dump($_POST).'"}'));
        }
        else {
            echo true;
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
