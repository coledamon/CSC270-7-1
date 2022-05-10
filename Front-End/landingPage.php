<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Front-End/reset.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Media Library</title>
</head>
<header>
    <?php include 'header.php' ?>

</header>

<body>
    <div class="category-container">
        <p id="category"></p>
    </div>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<script>

    const getCategories = () => {
        fetch("../back-end/category/getCategories.php")
            .then(res => res.json())
            .then(data => {
                Console.log(data)
            });
    }
    console.log(getCategories());
    
</script>