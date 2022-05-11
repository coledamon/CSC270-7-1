<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Front-End/reset.css">
    <link rel="stylesheet" href="Front-End/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Media Library</title>
</head>
<header>
    <?php include 'header.php' ?>

</header>

<body>
    <div class="d-flex">
        <div id="wrapper" class="row justify-content-center m-4"></div>
    </div>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<script>
    // const categoryName = document.getElementById('categoryName');

    const getCategories = () => {
        fetch("../back-end/category/getCategories.php")
            .then(res => res.json())
            .then(data => {
                console.log(data)
                displayCategories(data);
                // data.forEach(category => {
                //     console.log(category);
                // });
            });
    }

    getCategories();

    const displayCategories = (categories) => {
        const wrapper = document.getElementById('wrapper');
        categories.forEach(category => {
            const categoryDiv = createCategory(category.Name);
            wrapper.append(categoryDiv);
        })
    }

    const createCategory = (categoryName) => {
        const clickCategory = document.createElement('a');
        clickCategory.setAttribute('href', `Front-End/categoryPage.php?cat=${categoryName}`);
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