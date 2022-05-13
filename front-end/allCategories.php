<?php include "header.php" ?>
    <title>All Categories</title>
</head>
<?php 
if(!(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"])) {
    header("Location: ./");
    exit();
}
?>
<body>
    <?php include "nav.php" ?>

    <div class="container">
        <div class="row justify-content-center my-4">
            <h2>Category List</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <p>As an Admin, you have the ability to add or remove any one of these categories from the users' eyes through the buttons on the home and category pages.</p>
                <ul id="categoryList">

                </ul>
            </div>
        </div>
    </div>
<script>
    const getCategories = () => {
        fetch("../back-end/category/getCategories.php")
        .then(res => res.json())
        .then(data => {
            const catList = document.getElementById("categoryList");
            data.forEach(cat => {
                catList.innerHTML += `<li>${cat.Name}</li>`
            });
        });
    }
    getCategories();
</script>
<?php include "footer.php" ?>