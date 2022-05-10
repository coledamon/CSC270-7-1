<?php
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function getCategories($dbConn) {

    $query = "SELECT JSON_OBJECT(
                'id', c.id,
                'Name', c.category_name,
                'Used',  If(c.used, cast(true as json), cast(false as json))) as Category
                FROM Category c";

    return @mysqli_query($dbConn, $query);
}
$json = formatRecords(getCategories($dbConn));
connClose($dbConn);

echo $json;
?>
