<?php include "header.php"; ?>
    <title>Media Library</title>
</head>

<body>
<?php include 'nav.php' ?>
    <h2 class="title text-center">Categories</h2>

    <div class="d-flex">
        <div id="wrapper" class="row justify-content-center m-4"></div>
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
            const categoryDiv = createCategory(category.Name);
            wrapper.append(categoryDiv);
        })
    }

    const createCategory = (categoryName) => {
        const clickCategory = document.createElement('a');
        clickCategory.setAttribute('href', `./categoryPage.php?name=${categoryName}`);
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
<?php include "footer.php"?>