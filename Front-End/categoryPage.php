<?php
include_once 'Front-End/landingPage.php';
    $name = $_GET['cat'];
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Front-End/reset.css">
    <link rel="stylesheet" href="Front-End/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>

<header>
    <?php include 'header.php' ?>
</header>

<body>
<h2>
    <?php echo $name?>
    
</h2>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<script>

    
const getCategoryByName = () => {

        fetch(`../back-end/category/getCategoryByName.php?name=Movie`)
            .then(res => res.json())
            .then(data => {
                console.log(data)
                // displayCategories(data);
                // data.forEach(category => {
                //     console.log(category);
                // });
            });
    }

    getCategoryByName();


</script>

