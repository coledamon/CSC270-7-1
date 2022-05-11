<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

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
</body>
</html>