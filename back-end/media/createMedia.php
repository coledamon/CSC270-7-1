<?php
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function createMedia($dbConn, $name, $year, $creator, $genre, $link, $category_id) {
    $queryInsert = "INSERT INTO Media(
                        category_id,
                        media_name";
    $queryValues=  "VALUES (
                    ".$category_id.",
                    \"".$name."\"";
    if($year != null) {
        $queryInsert .= ", year";
        $queryValues .= ", ".$year;
    }
    if($creator != null) {
        $queryInsert .= ", creator";
        $queryValues .= ", \"".$creator."\"";
    }
    if($genre != null) {
        $queryInsert .= ", genre";
        $queryValues .= ", \"".$genre."\"";
    }
    if($link != null) {
        $queryInsert .= ", link";
        $queryValues .= ", \"".$link."\"";
    }
    $queryInsert .= ") ";
    $queryValues .= ") ";
    $result = @mysqli_query($dbConn, $queryInsert.$queryValues);
    return $result? $result : @mysqli_error($dbConn);
}

function createMediaPage($dbConn, $media_id, $title, $heading, $body) {
    $queryInsert = "INSERT INTO MediaPage(
                        media_id";
    $queryValues=  "VALUES (
                    \"".$media_id."\"";
    if($title != null) {
        $queryInsert .= ", title";
        $queryValues .= ", \"".$title."\"";
    }
    if($heading!= null) {
        $queryInsert .= ", heading";
        $queryValues .= ", \"".$heading."\"";
    }
    if($body != null) {
        $queryInsert .= ", body";
        $queryValues .= ", \"".$body."\"";
    }
    $queryInsert .= ") ";
    $queryValues .= ") ";
    $result = @mysqli_query($dbConn, $queryInsert.$queryValues);
    return $result? $result : @mysqli_error($dbConn);
}

if(isset($_POST["name"]) && isset($_POST["categoryId"])) {
    if(is_numeric($_POST["categoryId"])) {
        $category_id = (int)sanitizeInput($_POST["categoryId"]);
        $name = sanitizeInput($_POST["name"]);
        $year = isset($_POST["year"]) && $_POST["year"] ? sanitizeInput($_POST["year"]) : null;
        $creator = isset($_POST["creator"])&& $_POST["creator"] ? sanitizeInput($_POST["creator"]) : null;
        $genre = isset($_POST["genre"])&& $_POST["genre"] ? sanitizeInput($_POST["genre"]) : null;
        $link = isset($_POST["link"])&& $_POST["link"] ? sanitizeInput($_POST["link"]) : null;

        $result = createMedia($dbConn, $name, $year, $creator, $genre, $link, $category_id);
        if($result != 1) {
            echo json_encode(json_decode('{"error": "'.$result.'"}'));
        }
        else {
            $title = isset($_POST["title"]) ? sanitizeInput($_POST["title"]) : null;
            $heading = isset($_POST["heading"]) ? sanitizeInput($_POST["heading"]) : null;
            $body = isset($_POST["body"]) ? sanitizeInput($_POST["body"]) : null;
            $a=@mysqli_query($dbConn, "SELECT JSON_OBJECT('id',LAST_INSERT_ID());");
            $b=@mysqli_fetch_all($a)[0];
            $media_id = json_decode($b[0])->id;
            echo $media_id;
            $result2 = createMediaPage($dbConn, $media_id, $title, $heading, $body);
            if($result2 != 1) {
                echo json_encode(json_decode('{"error": "'.$result2.'"}'));
            }
            else {
                echo true;
            }
        }
        connClose($dbConn);
    }
    else {
        echo json_encode(json_decode('{"error": "Invalid Id"}'));
    }
}
else {
    echo json_encode(json_decode('{"error": "All information is required"}'));
}
?>
