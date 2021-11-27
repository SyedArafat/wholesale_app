<?php

if($num>0){

    echo "<table id ='productTable' class='table table-hover table-responsive table-bordered'>";

    echo "<tr>";
    echo "<th>Buyer Name</th>";
    echo "<th>Product Title</th>";
    echo "<th>Price</th>";
    echo "<th>Created At</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        echo "<tr>";
        echo "<td>{$buyer_name}</td>";
        echo "<td>{$product_title}</td>";
        echo "<td>{$price}</td>";
        echo "<td>{$created_at}</td>";

        echo "</tr>";
    }

    echo "</table>";

    $page_url="order-list.php?";
    $total_rows = $order->countAll();

    // actual paging buttons
    include_once '_paging.php';
}

else{
    echo "<div class='alert alert-danger'>
        <strong>No Orders found.</strong>
    </div>";
}

?>

<script>

</script>


