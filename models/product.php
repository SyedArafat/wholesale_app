<?php

class product
{
    private $conn;
    private $table_name = "products";
    private $user_table = "users";
    private $errors;

    public $id;
    public $seller_id;
    public $product_title;
    public $price;
    public $feature_image;
    public $secondary_image;
    public $updated_at;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function readAll($from_record_num, $records_per_page)
    {
        $query = $this->getAllProductsQuery();
        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $_SESSION["user_id"], PDO::PARAM_INT);
        $stmt->bindParam(2, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);


        $stmt->execute();

        return $stmt;
    }

    public function countAll()
    {
        $query = "SELECT id FROM " . $this->table_name . " WHERE seller_id = ". $_SESSION["user_id"];
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    private function getAllProductsQuery(): string
    {
        return "SELECT $this->table_name.id, $this->user_table.name as seller_name, product_title, price, feature_image,
            secondary_image, $this->table_name.created_at, $this->table_name.updated_at
            FROM " . $this->table_name . " LEFT JOIN $this->user_table ON $this->table_name.seller_id = $this->user_table.id 
            WHERE $this->table_name.seller_id = ? ORDER BY $this->table_name.id DESC LIMIT ?, ?";
    }

    public function create(): bool
    {
        $query = $this->makeInsertQuery();
        $stmt = $this->conn->prepare($query);
        $this->prepareData();
        $stmt = $this->bindData($stmt);

        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
    }

    private function makeInsertQuery(): string
    {
        return "INSERT INTO
                " . $this->table_name . "
            SET
                seller_id = :seller_id,
                product_title = :product_title,
                price = :price,
                feature_image = :feature_image,
                secondary_image = :secondary_image,
                updated_at = :updated_at,
                created_at = :created_at";
    }

    private function prepareData()
    {
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
        $this->product_title = htmlspecialchars(strip_tags($this->product_title));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->feature_image = htmlspecialchars(strip_tags($this->feature_image));
        $this->secondary_image = htmlspecialchars(strip_tags($this->secondary_image));
        $this->seller_id = htmlspecialchars(strip_tags($this->seller_id));
    }

    private function bindData($stmt)
    {
        $stmt->bindParam(':seller_id', $this->seller_id);
        $stmt->bindParam(':product_title', $this->product_title);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':feature_image', $this->feature_image);
        $stmt->bindParam(':secondary_image', $this->secondary_image);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);

        return $stmt;
    }

    public function showError($stmt)
    {
        $this->errors = $stmt->errorInfo();
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setProduct(): bool
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare( $query );
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $num = $stmt->rowCount();

        if($num>0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->feature_image = $row['feature_image'];
            $this->secondary_image = $row['secondary_image'];
            $this->created_at = $row['created_at'];

            return true;
        }

        return false;
    }

    public function update()
    {
        $query = $this->getUpdateQuery();
        $stmt = $this->conn->prepare($query);
        $this->prepareData();
        $stmt->bindParam(':product_title', $this->product_title);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':feature_image', $this->feature_image);
        $stmt->bindParam(':secondary_image', $this->secondary_image);
        $stmt->bindParam(':updated_at', $this->updated_at);
        $stmt->bindParam(':id', $this->id);
        if($stmt->execute()){
            return true;
        }else{
            $this->showError($stmt);
            return false;
        }
    }

    private function getUpdateQuery(): string
    {
        return "UPDATE $this->table_name 
            SET
                product_title = :product_title,
                price = :price,
                feature_image = :feature_image,
                secondary_image = :secondary_image,
                updated_at = :updated_at
            WHERE id = :id;";
    }
}