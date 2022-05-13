<?php include "header.php" ?>
    <title>Style Selection</title>
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
            <h2>Style Selection</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8" >
                <div class="row">
                    <p>Click one of the buttons below to select which style you'd like to use for the website</p>
                </div>
                <div class="row justify-content-center">
                    <a class="btn btn-color-1 col-3 mx-3" href="/front-end/index.php?style=1">Red</a>
                    <a class="btn btn-color-2 col-3 mx-3" href="/front-end/index.php?style=2">Blue</a>
                    <a class="btn btn-color-3 col-3 mx-3" href="/front-end/index.php?style=3">Green</a>
                </div>
            </div>
        </div>
    </div>
<?php include "footer.php" ?>