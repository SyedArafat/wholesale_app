<?php

class Statics
{
    const VALID_IMAGE_EXTENSIONS = ['jpeg', 'jpg', 'png', 'gif'];

    const PROJECT_NAME = "wholesale_app";

    const USER_TYPE_SELLER = "Seller";

    const USER_TYPE_CUSTOMER = "Customer";

    const PRODUCT_PURCHASE_LIMIT = 5;

    public static function getProductFeatureImageFullPath(): string
    {
        return "/resource/storage/products/feature_image/";
    }

    public static function getProductSecondaryImagePath(): string
    {
        return "/resource/storage/products/secondary_image/";
    }

}