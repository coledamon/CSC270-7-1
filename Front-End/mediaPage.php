<?php include 'header.php'; 
    $name = $_GET['name'];
?>
    <title>Document</title>
</head>

<header>
    <?php include 'nav.php' ?>
</header>

<body>
    

<script>
    const getMediaById = () => {
            fetch(`../back-end/media/getMediaById.php?id=<?php echo $_GET["id"];?>`)
        .then(res => res.json())
        .then(data => {
            console.log(data);
        });
    }

    getMediaById();

    const updateMedia = () => {
        fetch("../back-end/media/updateMedia.php", {
            body: new URLSearchParams(new FormData(document.getElementById("updateMediaForm"))).toString(),
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
</script>
<?php include "footer.php" ?>