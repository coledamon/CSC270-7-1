<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <title>Document</title>
</head>

<body>

</body>

</html>

<!-- JavaScript Bundle with Popper -->
<script>
    const getCategoryPage = () => {
        fetch(`../back-end/category/getCategoryByName.php?name=<?php echo $_GET["name"] ?>`)
        .then(res => res.json())
        .then(data => {
            console.log(data);
        });
    }

    const getCategoryMedia = () => {
        fetch(`../back-end/media/getMediaByCategory.php?name=<?php echo $_GET["name"] ?>`)
        .then(res => res.json())
        .then(data => {
            console.log(data);
        });
    }

    const updateCategoryPage = () => {
        fetch("../back-end/category/updateCategoryPage.php", {
            body: new URLSearchParams(new FormData(document.getElementById("updateCategoryPageForm"))).toString(),
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

    const createMedia = () => {
        fetch("../back-end/media/createMedia.php", {
            body: new URLSearchParams(new FormData(document.getElementById("createMediaForm"))).toString(),
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

    const deleteMedia = (id) => {
        fetch(`../back-end/media/deleteMediaById.php?id=${id}`)
        .then(res => res.json())
        .then(data => {
            console.log(data);
        });
    }
</script>