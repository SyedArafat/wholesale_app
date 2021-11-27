<?php

class User
{
    private $conn;
    private $table_name = "users";

    public $id;
    public $name;
    public $email;
    public $contact_number;
    public $address;
    public $password;
    public $created_at;
    public $updated_at;
    public $user_type;

    public function __construct($db = null)
    {
        $this->conn = $db;
    }

    function emailExists(): bool
    {
        $query = "SELECT id, name, user_type, password
            FROM " . $this->table_name . "
            WHERE email = ?
            LIMIT 0,1";

        $stmt = $this->conn->prepare( $query );
        $this->email=htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(1, $this->email);
        $stmt->execute();
        $num = $stmt->rowCount();

        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){

            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // assign values to object properties
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->password = $row['password'];
            $this->user_type = $row['user_type'];

            // return true because email exists in the database
            return true;
        }

        // return false if email does not exist in the database
        return false;
    }

    public function logout()
    {
        session_destroy();
    }

    // create new user record
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

    public function showError($stmt){
        echo "<pre>";
        print_r($stmt->errorInfo());
        echo "</pre>";
    }

    private function prepareData()
    {
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->contact_number=htmlspecialchars(strip_tags($this->contact_number));
        $this->address=htmlspecialchars(strip_tags($this->address));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->user_type=htmlspecialchars(strip_tags($this->user_type));
    }

    private function makeInsertQuery(): string
    {
        return "INSERT INTO
                " . $this->table_name . "
            SET
                name = :name,
                email = :email,
                contact_number = :contact_number,
                address = :address,
                password = :password,
                user_type = :user_type,
                updated_at = :updated_at,
                created_at = :created_at";
    }

    private function bindData($stmt)
    {
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':contact_number', $this->contact_number);
        $stmt->bindParam(':address', $this->address);

        // hash the password before saving to database
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);

        $stmt->bindParam(':user_type', $this->user_type);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);

        return $stmt;
    }
}