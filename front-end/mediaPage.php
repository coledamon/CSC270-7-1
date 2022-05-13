<?php include 'header.php'; 
      $id = $_GET['id'];
?>
    <title id="medTitle"></title>
</head>

<header>
    <?php include 'nav.php' ?>
</header>

<body>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <h2 class="text-center" id="medHeading"></h2>
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
        <div id="editOff" class="row justify-content-center">
            <div class="col-md-10 text-center">
                <p id="medBody"></p>
            </div>
        </div>
        <div id="editOn" class="row justify-content-center d-none">
            <div class="col-md-10">
                <form id="updateMediaForm" method="POST" action="/" onsubmit="updateMedia(); return false;">
                    <input type="hidden" name="id" id="mediaId" />
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="titleEdit" class="form-control-label">Title: </label>
                            <input class="form-control" type="text" name="title" placeholder="Page Title" id="titleEdit" />
                        </div>
                        <div class="col-6">
                            <label for="headingEdit" class="form-control-label">Heading: </label>
                            <input class="form-control" type="text" name="heading" placeholder="Page Heading" id="headingEdit" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bodyEdit" class="form-control-label">Body: </label>
                        <textarea class="form-control" type="text" name="body" placeholder="Body" id="bodyEdit" cols="50" rows="3"></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="nameEdit" class="form-control-label">Name:<span class="text-danger">*</span> </label>
                            <input class="form-control" type="text" name="name" placeholder="Media Name" id="nameEdit" />
                        </div>
                        <div class="col-6">
                            <label for="yearEdit" class="form-control-label">Year: </label>
                            <input class="form-control" type="text" name="year" placeholder="Creation Year" id="yearEdit" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label for="creatorEdit" class="form-control-label">Creator: </label>
                            <input class="form-control" type="text" name="creator" placeholder="Creator's' Name" id="creatorEdit" />
                        </div>
                        <div class="col-6">
                            <label for="genreEdit" class="form-control-label">Genre: </label>
                            <input class="form-control" type="text" name="genre" placeholder="Genre" id="genreEdit" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="linkEdit" class="form-control-label">Link: </label>
                        <input class="form-control" type="text" name="link" placeholder="Link (if applicable)" id="linkEdit" />
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
        <div id="wrapper" class="row justify-content-center my-2"></div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="delModalLabel">Delete Media</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center">
                                <p>Are you sure you want to delete <span id="name"></span>?</p>
                                <div id="catName" class="d-none"></div>
                                <span class="text-danger mb-1" id="errorTxt"></span>
                                <span class="text-success mb-1" id="succTxt"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-danger" onclick="deleteMedia();">Delete</button>
                                <button type="button" class="btn btn-secondary float-right" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

<script>
    const getMediaById = () => {
            fetch(`../back-end/media/getMediaById.php?id=<?php echo $_GET["id"];?>`)
        .then(res => res.json())
        .then(data => {
            console.log(data);
            document.getElementById("name").innerHTML = data.Name;
            document.getElementById("mediaId").value = data.id;
            document.getElementById("titleEdit").value = data.Title;
            document.getElementById("headingEdit").value = data.Heading;
            document.getElementById("bodyEdit").value = data.Body;
            document.getElementById("nameEdit").value = data.Name;
            document.getElementById("yearEdit").value = data.Year;
            document.getElementById("creatorEdit").value = data.Creator;
            document.getElementById("genreEdit").value = data.Genre;
            document.getElementById("linkEdit").value = data.Link;

            document.getElementById("medTitle").innerHTML = data.Title;

            if (data.Heading === null) {
                document.getElementById("medHeading").innerHTML = data.Name;
            } else {
                document.getElementById("medHeading").innerHTML = data.Heading;
            }
            
            document.getElementById("medBody").innerHTML = data.Body;

            document.getElementById("catName").innerHTML = data.Category;

            document.getElementById("wrapper").innerHTML = `
                                                            <div class="col-6 card p-3">
                                                                <div class="row mb-2">
                                                                    <div class="col-6">
                                                                        <div class="row">
                                                                            <div class="col-12 font-weight-bold">
                                                                                Name:
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                &nbsp;${data.Name}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="row">
                                                                            <div class="col-12 font-weight-bold">
                                                                                Year Created:
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                &nbsp;${data.Year}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-6">
                                                                        <div class="row">
                                                                            <div class="col-12 font-weight-bold">
                                                                                Creator's Name:
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                &nbsp;${data.Creator}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="row">
                                                                            <div class="col-12 font-weight-bold">
                                                                                Genre/type:
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                &nbsp;${data.Genre}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-12 font-weight-bold">
                                                                                Link:
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                &nbsp;${data.Link ? "<a href=\""+data.Link+"\" target=\"_blank\">"+data.Name+"</a>" : "No Link"}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           `;
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
            if (data.error) {
                document.getElementById("errorTxt").innerHTML = data.error;
                document.getElementById("succTxt").innerHTML = "";
            }
            else {
                document.getElementById("errorTxt").innerHTML = "";
                document.getElementById("succTxt").innerHTML = "Media Updated";
                window.location.replace("/front-end/mediaPage.php?id=<?php echo $id ?>");
            }
        });
    }


    const deleteMedia = () => {
        fetch(`../back-end/media/deleteMediaById.php?id=${document.getElementById("mediaId").value}`)
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
                    window.location.replace(`/front-end/categoryPage.php?name=${document.getElementById("catName").innerHTML}`);
                }
            });
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