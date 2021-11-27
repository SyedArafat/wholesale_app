<span>
    <label id="post_message_box" class="width-100-percent"> </label>
<span>

<?php

if($num>0){

    echo "<table id ='allProductTable' class='table table-hover table-responsive table-bordered'>";

    echo "<tr>";
    echo "<th>Seller Name</th>";
    echo "<th>Product Title</th>";
    echo "<th>Product Image</th>";
    echo "<th>Price</th>";
    echo "<th>Created At</th>";
    echo "<th>Action</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $feature_image = '/' . Statics::PROJECT_NAME . '/' . $feature_image;
        if(isset($secondary_image)) $secondary_image = '/' . Statics::PROJECT_NAME . '/' . $secondary_image;
        else $secondary_image = "NoImage";

        // display product details
        echo "<tr id='$id'>";
        echo "<td>{$seller_name}</td>";
        echo "<td>{$product_title}</td>";
        echo "<td><img class='content-center' src='". $feature_image ."' width='150px'/></td>";
        echo "<td>{$price}</td>";
        echo "<td>{$created_at}</td>";
        echo "<td>
                    <a data-toggle='modal'
                       data-product-id    = '$id'
                       data-product-title = '$product_title'
                       data-product-price = '$price'
                       data-product-feature-image = '$feature_image'
                       data-product-secondary-image = '$secondary_image'
                       class='btn btn-success infoU productBuyButton'>
                       <span class='glyphicon glyphicon-shopping-cart'></span>&nbsp; Buy</a>

              </td>";

        echo "</tr>";
    }

    echo "</table>";

    $page_url="index.php?";
    $total_rows = $product->countAll();

    // actual paging buttons
    include_once '_paging.php';
}

else{
    echo "<div class='alert alert-danger'>
        <strong>No products found.</strong>
    </div>";
}

?>

<script>

</script>



