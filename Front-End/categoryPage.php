<?php
include_once 'Front-End/landingPage.php';
$name = $_GET['cat'];
$title = $_GET['cat'] . " Category";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>
        <?php echo $title ?>
    </title>
</head>

<header>
    <?php include 'header.php' ?>
</header>

<body>
    <h2 class="title text-center">
        <?php echo $name ?>
    </h2>

    <div class="d-flex">
        <div id="wrapper" class="row justify-content-center m-4"></div>
    </div>
</body>

</html>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script>
    const getCategoryPage = async () => {
        await fetch(`../back-end/category/getCategoryByName.php?name=<?php echo $_GET["name"] ?>`)
        .then(res => res.json())
        .then(data => {
            console.log(data);
            //take the data and display title && body && use name for header
        });
    }

    const getCategoryMedia = async () => {
        await fetch(`../back-end/media/getMediaByCategory.php?name=<?php echo $_GET["name"] ?>`)
        .then(res => res.json())
        .then(data => {
            console.log(data);
            displayMedia(data);
        });
    }

    getCategoryPage();
    getCategoryMedia();

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
    
    const displayMedia = (media) => {
        const wrapper = document.getElementById('wrapper');
        media.forEach(media => {
            const mediaDiv = createMediaCard(media.Title, media.Creator, media.Genre, media.Year, media.Link, media.id);
            wrapper.append(mediaDiv);
        })
    }

    const createMediaCard = (title, creator, genre, year, link, id) => {
        const clickMedia = document.createElement('a');
        clickMedia.setAttribute('href', `mediaPage.php?id=${id}`);
        clickMedia.classList.add('media-card');


        const mediaDiv = document.createElement('div');
        mediaDiv.setAttribute('id', id);

        const mediaTitle = document.createElement('h4');
        mediaTitle.textContent = title;
        mediaTitle.classList.add('text-center');

        const mediaCreator = document.createElement('h5');
        mediaCreator.textContent = `Creator: ${creator}`;

        const mediaGenre = document.createElement('h5');
        mediaGenre.textContent = `Genre: ${genre}`;

        const mediaYear = document.createElement('h5');
        mediaYear.textContent = `Released: ${year}`;


        mediaDiv.append(mediaTitle, mediaCreator, mediaGenre, mediaYear);
        clickMedia.append(mediaDiv);

        return clickMedia;
    }
</script>

 <!-- JavaScript Bundle with Popper -->
<!-- <script>
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
    
</script> -->