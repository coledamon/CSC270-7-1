<?php include "header.php" ?>
    <title>Media Library</title>
</head>
<?php include 'nav.php' ?>

<body>
    <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) {
        echo "This is how the program knows if a user is logged in or not";
    }
    ?>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <h2 class="text-center">Categories</h2>
        </div>
        <div class="row justify-content-end">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Add +</button>
        </div>
        <div id="wrapper" class="row justify-content-center my-2"></div>
    </div>
    <!-- <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-success create-btn" data-toggle="modal" data-target="#myModal">Create +</button>
        <div id="wrapper" class="row"></div>
    </div> -->

    <!-- The Modal -->
    <form id="createCategoryPageForm" method="POST" action="/" onsubmit="createCategoryPage(); return false;">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalLabel">Add Category</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="catSelect" class="form-control-label">Category:</label>
                                <select id="catSelect" name="categoryId" class="form-control">
                                
                                </select>
                                <span class="text-danger mb-1" id="errorTxt"></span>
                                <span class="text-success mb-1" id="succTxt"></span>
                            </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


<script>
    // const categoryName = document.getElementById('categoryName');

    const getCategoriesByUse = () => {
        fetch("../back-end/category/getCategoriesByUse.php?use=true")
            .then(res => res.json())
            .then(data => {
                console.log(data)
                displayCategories(data);
                // data.forEach(category => {
                //     console.log(category);
                // });
            });
        fetch("../back-end/category/getCategoriesByUse.php?use=false")
            .then(res => res.json())
            .then(data => {
                const catSelect = document.getElementById("catSelect")
                data.forEach(category => {
                    catSelect.innerHTML += `
                                            <option value=${category.id}>${category.Name}</option>
                                           `;
                });
            });
    }

    const createCategoryPage = () => {
        fetch("../back-end/category/createCategoryPage.php", {
                body: new URLSearchParams(new FormData(document.getElementById("createCategoryPageForm"))).toString(),
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
                    window.location.replace("./front-end");
                }
            });
    }

    const stopUseCategory = (id) => {
        fetch(`../back-end/category/stopUseCategory.php?id=${id}`)
            .then(res => res.json())
            .then(data => {
                console.log(data);
            });
    }

    getCategoriesByUse();

    const displayCategories = (categories) => {
        const wrapper = document.getElementById('wrapper');
        categories.forEach(category => {
            wrapper.innerHTML += `
                                <a class="category-btn btn-color-<?php echo $_SESSION["style"] ?> col-md-3 mx-4 mb-2 text-center" href="/front-end/categoryPage.php?name=${category.Name}">
                                    <div class="m-2"><h3>${category.Name}</h3></div>
                                </a>`;
        })
    }

</script>
<?php include "footer.php" ?>