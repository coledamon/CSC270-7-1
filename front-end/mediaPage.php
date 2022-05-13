<?php include 'header.php';
$id = $_GET['id'];
?>
<title>Document</title>
</head>

<header>
    <?php include 'nav.php' ?>
</header>

<body>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <h2 id="title" class="text-center title"><?php echo $name ?></h2>
        </div>

        <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) {
            echo '
                        <div class="row justify-content-end">
                            <div class="col-auto">
                                <button type="button" class="btn btn-secondary" onclick="editOn();">Edit</button>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</button>
                            </div>
                        </div>
                        ';
        }
        ?>

        <!-- Display Media Content -->
        <div id="mediaContent" class="row justify-content-center">
            <h4 id="creator" class="m-4"></h4>
            <h4 id="genre" class="m-4"></h4>
            <h4 id="year" class="m-4"></h4>
        </div>

        <!-- EDIT FORM MODAL -->
        <div id="editOff" class="row justify-content-center m-4">
            <div class="col-md-10 text-center">
                <p id="mediaBody"></p>
            </div>
        </div>
        <div id="editOn" class="row justify-content-center d-none">
            <div class="col-md-10">
                <form id="updateMediaForm" method="POST" action="/" onsubmit="updateMedia(); return false;">
                    <input type="hidden" name="id" id="mediaId" />
                    <div class="form-group">
                        <label for="bodyEdit" class="form-control-label">Body: </label>
                        <textarea class="form-control" type="text" name="body" placeholder="Body" id="bodyEdit" cols="50" rows="3"></textarea>
                        <span class="text-danger mb-1" id="errorTxt"></span>
                        <span class="text-success mb-1" id="succTxt"></span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" onclick="editOff();" class="btn btn-danger float-right">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        

</body>

<script>
    const getMediaById = () => {
        fetch(`../back-end/media/getMediaById.php?id=<?php echo $_GET["id"]; ?>`)
            .then(res => res.json())
            .then(data => {
                console.log(data);
                document.getElementById('mediaId').value = data.id;
                document.getElementById('bodyEdit').value = data.Body;
                displayMedia(data);
            });
    }

    getMediaById();

    const displayMedia = (media) => {
        document.getElementById('title').innerHTML = media.Name;
        document.getElementById('mediaBody').innerHTML = media.Body;
        document.getElementById('creator').innerHTML = `Creator: ${media.Creator}`;
        document.getElementById('genre').innerHTML = `Genre: ${media.Genre}`;
        document.getElementById('year').innerHTML = `Year: ${media.Year}`;

    }

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
                if (data.error) {
                    document.getElementById("errorTxt").innerHTML = data.error;
                    document.getElementById("succTxt").innerHTML = "";
                } else {
                    document.getElementById("errorTxt").innerHTML = "";
                    document.getElementById("succTxt").innerHTML = "Updated";
                    window.location.replace("/front-end/mediaPage.php?id=<?php echo $id ?>");
                }
            });
    }

    const deleteMedia = () => {

    }

    const editOn = () => {
        document.getElementById("editOn").classList.remove("d-none");
        document.getElementById("editOff").classList.add("d-none");
    }
    const editOff = () => {
        document.getElementById("editOff").classList.remove("d-none");
        document.getElementById("editOn").classList.add("d-none");
    }
</script>
<?php include "footer.php" ?>