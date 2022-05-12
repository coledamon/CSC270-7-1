<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Media Library</title>
</head>
<header>
    <?php include 'nav.php' ?>
</header>

<body>
    <h2 class="title text-center">Categories</h2>

    <div class="d-flex justify-content-center">
        <div id="wrapper" class="row m-4"></div>
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

        const h3 = document.createElement('h3');
        h3.textContent = categoryName;
        categoryDiv.append(h3);
        clickCategory.append(categoryDiv);
        console.log(h3.textContent + " create");
        

        return clickCategory;
    }

</script>