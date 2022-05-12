<?php include "header.php" ?>
    <title>Document</title>
</head>
<body>
    <?php include "nav.php" ?>

<div class="container">
        <div class="row mt-3 justify-content-center">
            <div class="card col-8">
                <ul class="nav nav-tabs pt-2">
                    <li class="nav-item">
                        <a class="nav-link" href="./adminLogin.php">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="./adminRegister.php">Register</a>
                    </li>
                </ul>
                <div class="p-3">
                    <div class="row text-center justify-content-center">
                        <h3>Register</h3>
                    </div>
                    <div class="row justify-content-center" >
                        <form method="post" id="createUserForm" action="./front-end" onsubmit="createUser(); return false;" class="col-8">
                            <div class="form-group">
                                <label for="username" class="form-control-label">Username: </label>
                                <input type="text" class="form-control" placeholder="Username" id="username" name="username"/>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-control-label">Password: </label>
                                <input type="password" class="form-control" placeholder="Password" id="password" name="password"/>
                                <span class="text-danger mb-1" id="errorTxt"></span>
                                <span class="text-success mb-1" id="succTxt"></span>
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
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
                if (data.error) {
                    document.getElementById("errorTxt").innerHTML = data.error;
                    document.getElementById("succTxt").innerHTML = "";
                    return false;
                }
                else {
                    document.getElementById("errorTxt").innerHTML = "";
                    document.getElementById("succTxt").innerHTML = "Successfully Logged In";
                    console.log(data);
                    window.location.replace("/front-end/");
                }
            });
        }
    </script>
<?php include "footer.php" ?>