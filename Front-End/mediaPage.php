<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>

<header>
    <?php include 'header.php' ?>
</header>

<body>
    
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script>
    const getMediaById = () => {
            fetch(`../back-end/media/getMediaById.php?id=<?php echo $_GET["id"];?>`)
        .then(res => res.json())
        .then(data => {
            console.log(data);
        });
    }

    getMediaById();

    const updateMedia = () => {
        fetch("../back-end/media/updateMedia.php", {
            body: new URLSearchParams(new FormData(document.getElementById("updateMediaForm"))).toString(),
            headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
            },
            method: "post"
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
        });
    }
</script>
