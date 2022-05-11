<?php include "header.php" ?>
    <title>Document</title>
</head>
<body>
    <?php include "nav.php" ?>

<div>
    <label for=""></label>
</div>
    
    <script>
        const getUserByUsername = (username) => {
            fetch(`../back-end/user/getUserByUsername.php?username=${username}`)
            .then(res => res.json())
            .then(data => {
                console.log(data);
            });
        }

        //if this turns into a register/login instead of just login
        const createUser = () => {
            fetch("../back-end/user/createUser.php", {
                body: new URLSearchParams(new FormData(document.getElementById("createUserForm"))).toString(),
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