<?php
// core configuration
include_once "config/core.php";

// set page title
$page_title="Home";

// include login checker
$require_login=true;
include_once "login_checker.php";

// include classes
include_once 'config/database.php';
include_once 'models/product.php';

// include page header HTML
include_once 'views/layout/layout_head.php';


echo "<div class='col-md-12'>";

$action = $_GET['action'] ?? "";

if($action=='login_success'){
    echo "<div class='alert alert-info'>";
    echo "<strong>Hi " . $_SESSION['name'] . ", welcome back!</strong>";
    echo "</div>";
}

else if($action=='already_logged_in'){
    echo "<div class='alert alert-info'>";
    echo "<strong>You are already logged in.</strong>";
    echo "</div>";
}

else if($action=='login_as_seller'){
    echo "<div class='alert alert-danger'>";
    echo "<strong>You do not have required access to see the page.</strong>";
    echo "</div>";
}

echo "<div class='alert alert-info'>";
echo "Buy your desired products.";
echo "</div>";

echo "</div>";

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$product = new Product($db);

echo "<div class='col-md-12'>";

// read all users from the database
$stmt = $product->readAll($from_record_num, $records_per_page);

// count retrieved users
$num = $stmt->rowCount();

// to identify page for paging
$page_url="product-index.php?";

// include products table HTML template
include_once "views/template/_home_products.php";

echo "</div>";

include_once 'views/template/_purchase_confirm_modal.php';

// footer HTML and JavaScript codes
include 'views/layout/layout_foot.php';

?>

<script>
    $(document).ready(function (){
        $('#allProductTable').on('click', '.productBuyButton', function (e) {
            e.preventDefault();
            let productId = $(this).data('product-id');
            let productTitle = $(this).data('product-title');
            let productPrice = $(this).data('product-price');
            let wholesalePrice = productPrice - (productPrice * 10/100);
            $("#productPrice").text(productPrice);
            $("#productTitle").text(productTitle);
            $("#wholesalePrice").text(wholesalePrice);
            $("#product_id").val(productId);
            $("#confirmPurchaseModal").modal('show');
        });
        $("form#product_purchase").submit(function (e) {
            e.preventDefault();
            let url = $('#product_purchase').attr('action');
            let formData = new FormData(this);
            $.ajax({
                url: url,
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
            $("#confirmPurchaseModal").modal('hide');
        });
    });
</script>
