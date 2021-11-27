<?php

if($_POST) {
    include_once "../config/core.php";
    $require_login = true;
    include_once "../login_checker.php";

    include_once '../config/database.php';
    include_once '../models/order.php';
    include_once '../models/product.php';

    $database = new Database();
    $db = $database->getConnection();

    $order = new order($db);
    $product = new product($db);
    $product->id = $_POST["product_id"];

    if(!$product->setProduct()) die('<label class="alert alert-danger width-100-percent" role="alert"> No product found. </label>');

    if($product->isOwnSeller()) die('<label class="alert alert-danger width-100-percent" role="alert"> You can not buy your own product. </label>');

    $order->product_id = $product->id;
    $order->price = $product->price;

    if(!$order->checkPurchaseLimit()) die('<label class="alert alert-danger width-100-percent" role="alert"> Product purchase limit maxed out. </label>');

    if($order->create()) {
        if($_SESSION["user_type"] === Statics::USER_TYPE_SELLER) {
            $product->seller_id = $_SESSION["user_id"];
            $product->create();
        }
        die('<label class="alert alert-success width-100-percent" role="alert"> Success ! Product purchased.</label>');
    }
    else die('<label class="alert alert-danger width-100-percent" role="alert"> Something went wrong. Try again.'.  $order->getErrors(). '</label>');

}