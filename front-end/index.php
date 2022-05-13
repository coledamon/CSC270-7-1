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
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Create +</button>
        </div>
        <div id="wrapper" class="row justify-content-center my-2"></div>
    </div>
    <!-- <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-success create-btn" data-toggle="modal" data-target="#myModal">Create +</button>
        <div id="wrapper" class="row"></div>
    </div> -->

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="createMediaForm" method="POST" action="./categoryPage.php?name=<?php echo $name ?>">
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <input type="category" class="form-control" placeholder="Enter category" id="category">
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="createMedia()">Submit</button>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

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
                                <a class="category-btn col-md-3 mx-4 text-center" href="/front-end/categoryPage.php?name=${category.Name}">
                                    <h3>${category.Name}</h3>
                                </a>`;
        })
    }

</script>
<?php include "footer.php" ?>