<?php

class order
{
    private $conn;
    private $table_name = "orders";
    private $product_table = "products";
    private $user_table = "users";
    private $errors;

    public $id;
    public $buyer_id;
    public $product_id;
    public $price;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
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
                buyer_id = :buyer_id,
                product_id = :product_id,
                price = :price,
                created_at = :created_at";
    }

    private function prepareData()
    {
        $this->price = $_SESSION['user_type'] === Statics::USER_TYPE_SELLER ? ($this->price - ($this->price * 10/100)) : $this->price;
        $this->created_at = date('Y-m-d H:i:s');
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->buyer_id = $_SESSION['user_id'];
    }

    private function bindData($stmt)
    {
        $stmt->bindParam(':buyer_id', $this->buyer_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':created_at', $this->created_at);

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

    public function checkPurchaseLimit() : bool
    {
        $query = "SELECT id FROM " . $this->table_name ." WHERE buyer_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare( $query );

        $stmt->bindParam(1, $_SESSION["user_id"], PDO::PARAM_INT);
        $stmt->bindParam(2, $this->product_id, PDO::PARAM_INT);
        $stmt->execute();
        return Statics::PRODUCT_PURCHASE_LIMIT > $stmt->rowCount();

    }

    public function readAllBySeller($from_record_num, $records_per_page)
    {
        $query = $this->getProductsBySellerQuery();
        $stmt = $this->conn->prepare( $query );

//        $stmt->bindParam(1, $_SESSION["user_id"], PDO::PARAM_INT);
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt;
    }

    public function countAll()
    {
        $query = "SELECT id FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    private function getProductsBySellerQuery(): string
    {
        return "SELECT $this->table_name.id, $this->table_name.buyer_id, $this->table_name.price, 
            $this->product_table.product_title, $this->user_table.name AS buyer_name, 
            $this->table_name.created_at FROM `$this->table_name` 
            JOIN $this->product_table ON $this->table_name.product_id = $this->product_table.id 
            JOIN $this->user_table ON $this->table_name.buyer_id = $this->user_table.id 
            ORDER BY $this->table_name.id DESC LIMIT ?, ?";
    }
}