<?php

include_once "../config/core.php";

$page_title = "Product Add";

$require_login = true;
include_once "../login_checker.php";

include_once '../config/database.php';
include_once '../models/product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

if($_POST){
    include_once "../config/FileManager.php";

    $file = new FileManager();
    if($_FILES['feature_image'])
        $product->feature_image = $file->uploadImageAndGetPath('feature_image', Statics::getProductFeatureImageFullPath());
    if(!$product->feature_image) die('<label class="alert alert-danger width-100-percent" role="alert"> An error occurred while uploading the file </label>');

    $product->product_title = $_POST['product_title'];
    $product->price = $_POST['price'];
    $product->seller_id = $_SESSION["user_id"];
    if(file_exists($_FILES['secondary_image']['tmp_name']) && is_uploaded_file($_FILES['secondary_image']['tmp_name'])) {
        $product->secondary_image = $file->uploadImageAndGetPath('secondary_image', Statics::getProductSecondaryImagePath());
        if(!$product->secondary_image) die('<label class="alert alert-danger width-100-percent" role="alert"> An error occurred while uploading the secondary image file </label>');
    } else $product->secondary_image = null;

    if($product->create())
        die('<label class="alert alert-success width-100-percent" role="alert"> Success ! Product added.</label>');
    else die('<label class="alert alert-danger width-100-percent" role="alert"> Something went wrong. Try again.'.  $product->getErrors(). '</label>');
}

else {

include_once 'layout/layout_head.php';
?>
<span>
    <label id="post_message_box" class="width-100-percent"></label>
<span>
<form id="product_add" method="post" enctype="multipart/form-data" style="margin-top: 20px" class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Product Title:</label>
        <div class="col-sm-10">
            <input type="text" required class="form-control" id="product_title" placeholder="Enter Product Title" name="product_title">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Product Price:</label>
        <div class="col-sm-10">
            <input type="number" required class="form-control" id="price" placeholder="Enter Product Price" name="price">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Wholesale Price:</label>
        <div class="col-sm-10">
            <input type="number" readonly class="form-control" id="wholesale_price">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Feature Image:</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="feature_image" placeholder="Feature Image" name="feature_image">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Secondary Image:</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="secondary_image" placeholder="Secondary Image" name="secondary_image">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Add Product</button>
        </div>
    </div>
</form>

<?php

include_once "layout/layout_foot.php";
?>
<script>
    $( document ).ready(function() {
        $("form#product_add").submit(function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: window.location.pathname,
                method: 'POST',
                data: formData,
                success: function (response) {
                    console.log(response);
                    $('#post_message_box').html(response);
                    $(":input").val('');
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function (error) {
                    console.log(error);
                }
            });
        });

        $("form#product_add").on('keyup', '#price', function (){
            let wholesale_price = (!isNaN(this.value)) ? (this.value - (this.value * 10/100)) : 0;
            $("input#wholesale_price").val(wholesale_price);

        })
    });

</script>

<?php } ?>
