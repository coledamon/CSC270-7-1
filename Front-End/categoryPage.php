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
    <h2>
        <?php echo $name ?>
    </h2>

    <div class="d-flex">
        <div id="wrapper" class="row justify-content-center m-4"></div>
    </div>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<script>
    let name = '<?php echo $name; ?>';

    const getCategoryByName = async () => {

        await fetch(`../back-end/category/getCategoryByName.php?name=${name}`)
            .then(res => res.json())
            .then(data => {
                console.log(data)
                getMediaById(data[0].id);
            });
    }

    const getMediaById = async (id) => {
        await fetch(`../back-end/media/getMediaById.php?id=${id}`)
            .then(res => res.json())
            .then(data => {
                console.log(data)
                displayMedia(data);
            });
    }

    getCategoryByName();

    const displayMedia = (media) => {
        const wrapper = document.getElementById('wrapper');
        media.forEach(media => {
            const mediaDiv = createMediaCard(media.Title, media.Year, media.Link, media.id);
            wrapper.append(mediaDiv);
        })
    }

    const createMediaCard = (title, year, link, id) => {
        const clickMedia = document.createElement('a');
        clickMedia.setAttribute('href', `mediaPage.php?id=${id}`);
        clickMedia.classList.add('media-card');

        const mediaDiv = document.createElement('div');
        mediaDiv.setAttribute('id', id);

        const movieTitle = document.createElement('h4');
        movieTitle.textContent = title;
        const movieYear = document.createElement('h4');
        movieYear.textContent = `Released: ${year}`;


        mediaDiv.append(movieTitle, movieYear);
        clickMedia.append(mediaDiv);

        return clickMedia;
    }
</script>