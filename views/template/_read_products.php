<a data-toggle="modal" data-id="ISBN564541" title="Add this item" class="open-AddBookDialog btn btn-primary" href="#addBookDialog">test</a>

<div class="modal hide" id="addBookDialog">
    <div class="modal-header">
        <button class="close" data-dismiss="modal">×</button>
        <h3>Modal header</h3>
    </div>
    <div class="modal-body">
        <p>some content</p>
        <input type="text" name="bookId" id="bookId" value=""/>
    </div>
</div>

<?php
// display the table if the number of users retrieved was greater than zero
if($num>0){

    echo "<table id ='productTable' class='table table-hover table-responsive table-bordered'>";

    // table headers
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

        // display user details
        echo "<tr>";
        echo "<td>{$seller_name}</td>";
        echo "<td>{$product_title}</td>";
        echo "<td><img class='content-center' src='". "/" . Statics::PROJECT_NAME . "/" . $feature_image ."' width='150px'/></td>";
        echo "<td>{$price}</td>";
        echo "<td>{$created_at}</td>";
        echo "<td>
                    <a data-toggle='modal'
                       data-target-product-title = '$product_title'
                       data-target-product-price = '$price'
                       class='btn btn-info infoU productEditButton'>
                       <span class='glyphicon glyphicon-file'></span>Edit</a>

              </td>";

        echo "</tr>";
    }

    echo "</table>";

    $page_url="product-index.php?";
    $total_rows = $product->countAll();

    // actual paging buttons
    include_once '_paging.php';

    include_once '_update_product_modal.php';
}

// tell the user there are no selfies
else{
    echo "<div class='alert alert-danger'>
        <strong>No products found.</strong>
    </div>";
}

?>

<script>

</script>


