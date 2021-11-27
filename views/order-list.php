<?php

// core configuration
include_once "../config/core.php";

// set page title
$page_title = "Order List";

// include login checker
$require_login = true;
$must_be_seller = true;
include_once "../login_checker.php";

// include classes
include_once '../config/database.php';
include_once '../models/order.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$order = new order($db);

include_once 'layout/layout_head.php';

echo "<div class='col-md-12'>";

$stmt = $order->readAllBySeller($from_record_num, $records_per_page);

$num = $stmt->rowCount();

$page_url="order-list.php?";

// include products table HTML template
include_once "template/_read_orders.php";

echo "</div>";

// include page footer HTML
include_once "layout/layout_foot.php";