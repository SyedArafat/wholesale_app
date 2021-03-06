<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- set the page title, for seo purposes too -->
    <title><?php echo isset($page_title) ? strip_tags($page_title) : "Store Front"; ?></title>

    <!-- Bootstrap CSS -->
<!--    <link href="--><?php //echo $home_url . "resource/css/bootstrap.min.css" ?><!--" rel="stylesheet" media="screen" />-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" media="screen" />

    <!-- admin custom CSS -->
    <link href="<?php echo $home_url . "resource/css/customer.css" ?>" rel="stylesheet" />

</head>
<body>

<!-- include the navigation bar -->
<?php include_once 'navigation.php'; ?>

<!-- container -->
<div class="container">

    <?php
    // if given page title is 'Login', do not display the title
    if($page_title!="Login"){
    ?>
    <div class='col-md-12'>
        <div class="page-header col-md-10" <?php if($page_title === "Product Index") { ?> style="margin: 0px" <?php } ?>>
            <h1><?php echo $page_title ?? ""; ?></h1>
        </div>
        <?php if($page_title === "Product Index") { ?>
        <div  style="margin-top: 25px" class="col-md-2">
            <a href="<?php echo $home_url . "views/product-add.php" ?>"><button type="button" class="btn btn-primary">Add New</button></a>
        </div>

        <?php } ?>
    </div>
<?php
}
?>