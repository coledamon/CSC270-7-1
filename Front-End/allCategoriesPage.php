<?php include "header.php" ?>
    <title>All Categories</title>
</head>
<body>
    <?php include "nav.php" ?>

<script>
    const getCategories = () => {
        fetch("../back-end/category/getCategories.php")
        .then(res => res.json())
        .then(data => {
            console.log(data);
        });
    }
</script>
<?php include "footer.php" ?>