<?php
include "header.php";
$name = $_GET['name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="reset.css"> -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>
        <?php echo $_GET["name"] . " Category" ?>
    </title>
</head>

<body>
    <?php include 'nav.php' ?>

    <h2 class="title text-center">
        <?php echo $name ?>
    </h2>


    <div class="d-flex flex-column justify-content-center">
        <div class="row justify-content-center ">
            <button type="button" class="btn btn-success create-btn" data-toggle="modal" data-target="#myModal">Create +</button>
        </div>
        <br>
        <div id="wrapper" class="row justify-content-center"></div>
    </div>

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add <?php echo $name ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="createMediaForm" method="POST" action="/" onsubmit="createMedia(); return false;">
                        <div class="form-group">
                            <label for="name">Title:<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter title" id="name" required>
                        </div>
                        <input type="hidden" name="categoryId" id="categoryId" />
                        <div class="form-group">
                            <label for="year">Year:</label>
                            <input type="number" name="year" class="form-control" placeholder="Enter year" id="year">
                        </div>
                        <div class="form-group">
                            <label for="creator">Creator:</label>
                            <input type="text" name="creator" class="form-control" placeholder="Enter creator" id="creator" />
                        </div>
                        <div class="form-group">
                            <label for="genre">Genre:</label>
                            <input type="text" name="genre" class="form-control" placeholder="Enter genre" id="genre" />
                        </div>
                        <div class="form-group">
                            <label for="link">Link:</label>
                            <input type="text" name="link" class="form-control" placeholder="Enter link if applicable" id="link" />
                            <span class="text-danger mb-1" id="errorTxt"></span>
                            <span class="text-success mb-1" id="succTxt"></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

</body>

</html>

<script>
    const getCategoryPage = async () => {
        await fetch(`../back-end/category/getCategoryByName.php?name=<?php echo $_GET["name"] ?>`)
            .then(res => res.json())
            .then(data => {
                console.log(data);
                //take the data and display title && body && use name for header
                document.getElementById("categoryId").value = data.id;
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
                if (data.error) {
                    document.getElementById("errorTxt").innerHTML = data.error;
                    document.getElementById("succTxt").innerHTML = "";
                }
                else {
                    document.getElementById("errorTxt").innerHTML = "";
                    document.getElementById("succTxt").innerHTML = "Media Created";
                    window.location.replace("./categoryPage.php?name=<?php echo $name ?>");
                }
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
        const noRecords = document.createElement('h4');
        media.forEach(media => {
            if (!media.error) {
                const mediaDiv = createMediaCard(media.Name, media.Creator, media.Genre, media.Year, media.id);
                wrapper.append(mediaDiv);
            } else {
                noRecords.textContent = media.error;
                wrapper.append(noRecords);
            }
        })
    }

    const createMediaCard = (title, creator, genre, year, id) => {
        const clickMedia = document.createElement('a');
        clickMedia.setAttribute('href', `mediaPage.php?id=${id}`);
        clickMedia.classList.add('media-card');
        // clickMedia.classList.add('col-md')


        const mediaDiv = document.createElement('div');
        mediaDiv.setAttribute('id', id);
        mediaDiv.classList.add('media-data')

        const mediaTitle = document.createElement('h4');
        mediaTitle.textContent = title;
        mediaTitle.classList.add('text-center');

        const mediaCreator = document.createElement('p');
        mediaCreator.textContent = `Creator: ${creator}`;

        const mediaGenre = document.createElement('p');
        mediaGenre.textContent = `Genre: ${genre}`;

        const mediaYear = document.createElement('p');
        mediaYear.textContent = `Released: ${year}`;


        mediaDiv.append(mediaTitle, mediaCreator, mediaGenre, mediaYear);
        clickMedia.append(mediaDiv);

        return clickMedia;
    }
</script>
<?php include "footer.php" ?>