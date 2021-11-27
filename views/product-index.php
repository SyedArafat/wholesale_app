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

// include page header HTML
include_once 'layout/layout_head.php';

echo "<div class='col-md-12'>";

// read all users from the database
$stmt = $product->readAll($from_record_num, $records_per_page);

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
    $("#editProductModal").on("show.bs.modal", function (e) {
        let product_title = $(e.relatedTarget).data('product-title');
        console.log(product_title);

    });
    $('#productTable').on('click', '.productEditButton', function (e){
        e.preventDefault();
        let productTitle = $(this).data('product-title');
        console.log(productTitle);
        $('#editProductModal').modal('show');
    });

    $(document).on("click", ".open-AddBookDialog", function () {
        var myBookId = $(this).data('id');
        console.log(myBookId);
        // $(".modal-body #bookId").val( myBookId );
        // As pointed out in comments,
        // it is unnecessary to have to manually call the modal.
        // $('#addBookDialog').modal('show');
    });
</script>
