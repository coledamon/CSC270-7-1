<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="reset.css"> -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <?php include "header.php" ?>
    <title>Media Library</title>
</head>
<?php include 'nav.php' ?>

<body>
    <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) {
        echo "This is how the program knows if a user is logged in or not";
    }
    ?>
    <h2 class="title text-center">Categories</h2>

    <br>
    <div class="d-flex flex-column justify-content-center">
        <div class="row justify-content-center ">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Create +</button>
        </div>
        <br>
        <div id="wrapper" class="row justify-content-center"></div>
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


</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

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
            const categoryDiv = createCategory(category.Name);
            wrapper.append(categoryDiv);
        })
    }

    const createCategory = (categoryName) => {
        const clickCategory = document.createElement('a');
        clickCategory.setAttribute('href', `categoryPage.php?name=${categoryName}`);
        clickCategory.classList.add('category-btn');
        clickCategory.classList.add('col-md-4.5');
        clickCategory.classList.add('m-4');

        const categoryDiv = document.createElement('div');
        categoryDiv.setAttribute('id', categoryName);
        // categoryDiv.classList.add('align-content-center');

        const category = document.createElement('h3');
        category.textContent = categoryName;
        // categoryDiv.append(category);
        clickCategory.append(category);
        // console.log(h3.textContent + " create");


        return clickCategory;
    }
</script>