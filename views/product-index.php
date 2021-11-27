<?php

// core configuration
include_once "../config/core.php";

// set page title
$page_title = "Product Index";

// include login checker
$require_login = true;
include_once "../login_checker.php";

// include classes
include_once '../config/database.php';
include_once '../models/product.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$product = new Product($db);

if($_POST) {
    include_once "../config/FileManager.php";
    $product->id = (int)$_POST["id"];
    if(!$product->setProduct()) die(json_encode(["response_html" => '<label class="alert alert-danger width-100-percent" role="alert"> No product found. </label>']));
    $file = new FileManager();
    if(file_exists($_FILES['feature_image']['tmp_name']) && is_uploaded_file($_FILES['feature_image']['tmp_name'])) {
        $old_image = $product->feature_image;
        $product->feature_image = $file->uploadImageAndGetPath('feature_image', Statics::getProductFeatureImageFullPath());
        if($product->feature_image) $file->deleteFile($old_image);
    }
    if(!$product->feature_image) die(json_encode(["response_html" => '<label class="alert alert-danger width-100-percent" role="alert"> An error occurred while uploading the file </label>']));

    $product->product_title = $_POST['product_title'];
    $product->price = $_POST['product_price'];

    if(file_exists($_FILES['secondary_image']['tmp_name']) && is_uploaded_file($_FILES['secondary_image']['tmp_name'])) {
        $old_image = $product->secondary_image;
        $product->secondary_image = $file->uploadImageAndGetPath('secondary_image', Statics::getProductSecondaryImagePath());
        if(!$product->secondary_image) die(json_encode(["response_html" => '<label class="alert alert-danger width-100-percent" role="alert"> An error occurred while uploading the secondary image file </label>']));
        $file->deleteFile($old_image);
    }

    if($product->update()) {
        die(json_encode(["response_html" => '<label class="alert alert-success width-100-percent" role="alert"> Success ! Product updated.</label>',
            "code" => 200,
            "updated_row" => $product->updatedTableRow()]));
    }
    else die(json_encode(["response_html" => '<label class="alert alert-danger width-100-percent" role="alert"> Something went wrong. Try again.'.  $product->getErrors(). '</label>']));
}

else {
// include page header HTML
include_once 'layout/layout_head.php';

echo "<div class='col-md-12'>";

// read all users from the database
$stmt = $product->readAllBySeller($from_record_num, $records_per_page);

// count retrieved users
$num = $stmt->rowCount();

// to identify page for paging
$page_url="product-index.php?";

// include products table HTML template
include_once "template/_read_products.php";

echo "</div>";

// include page footer HTML
include_once "layout/layout_foot.php";
?>

<script>
    $( document ).ready(function() {
        $('#productTable').on('click', '.productEditButton', function (e) {
            e.preventDefault();
            let productId = $(this).data('product-id');
            let productTitle = $(this).data('product-title');
            let productPrice = $(this).data('product-price');
            let featureImage = $(this).data('product-feature-image');
            let secondaryImage = $(this).data('product-secondary-image');

            $('#product_id').val(productId);
            $('#product_title').val(productTitle);
            $('#product_price').val(productPrice);
            $("#feature_image_display").attr("src", featureImage);
            $("#secondary_image_display").attr("src", secondaryImage);
            $('#editProductModal').modal('show');
        });

        $("form#product_update").submit(function (e) {
            e.preventDefault();
            let id = $('#product_id').val();
            let formData = new FormData(this);
            $.ajax({
                url: window.location.pathname,
                method: 'POST',
                data: formData,
                success: function (response) {
                    console.log(response);
                    response = (JSON.parse(response));
                    $('#post_message_box').html(response.response_html);
                    $(":input").val('');
                    $('#editProductModal').modal('hide');
                    if (typeof response.code !== 'undefined' && response.code === 200)
                        $('#'+id).replaceWith(response.updated_row);
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });
</script>

<?php
}