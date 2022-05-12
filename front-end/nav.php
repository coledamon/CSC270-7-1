<nav class="navbar navbar-dark bg-dark justify-content-between">
  <a class="navbar-brand" href="./">Media Library</a>
  <a class="btn btn-<?php echo (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) ? "danger" : "success"; ?> my-2 my-sm-0" href="<?php echo (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) ? "/front-end/logOut.php\">Log out" : "/front-end/adminLogin.php\">Login"; ?></a>
</nav>