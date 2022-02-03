<?php
session_start();

if (isset($_SESSION['login'])) {
    header('location: layouts/dashboard/index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'layouts/components/head.php'; ?>
    <?php include 'layouts/components/pages-css.php'; ?>
</head>

<body>
    <?php include 'layouts/components/navbar.php'; ?>
    <?php require 'layouts/controllerPages.php'; ?>
    <?php include 'layouts/components/footer.php'; ?>
    <?php include 'layouts/components/pages-js.php'; ?>
</body>

</html>