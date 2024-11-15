<?php

require_once 'database.php';
require_once 'product.php';

class ProductManager{
    private $conn;

    public function __construct(){
        # Create connection
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function addProduct($product){
        # Prepare query
        $query = "INSERT INTO products (name, price, description) VALUES(:name, :price, :description)";
        $stmt = $this->conn->prepare($query); # prevent SQL injection + allows binding later

        # Assign plcaholder values
        $stmt->BindParam(":name", $product->name);
        $stmt->BindParam(":price", $product->price);
        $stmt->BindParam(":description", $product->description);

        # Check if execution went right
        if ($stmt->execute()){
            echo("Product added successfully");
        }else{
            echo("Error: " . $stmt->errorInfo()[2]);
        }
    }

    public function readProduct($id){
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->BindParam(":id", $id);

        if ($stmt->execute()){
            # fetch row and return it
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Product($product["name"], $product["price"], $product["description"]);
        }
    }

    public function readAllProducts(){
        $query = "SELECT * FROM products";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute()){
            # fetch all rows and return them
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } else{
            echo("Error: " . $stmt->errorInfo()[2]);
        }

        return null;
    }

    public function updateProduct($id, Product $product){
        $query = "UPDATE products SET name = :name, price = :price, description = :dsecription WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->BindParam(":name", $product->name);
        $stmt->BindParam(":price", $product->price);
        $stmt->BindParam(":description", $product->description);
        $stmt->BindParam(":id", $id);

        if ($stmt->execute()){
            echo("Product updated successfully");
        }else{
            echo("Error: " . $stmt->errorInfo()[2]);
        }
    }

    public function deleteProduct($id){
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->BindParam(":id", $id);

        if ($stmt->execute()){
            echo("Product deleted successfully");
        }else{
            echo("Error: " . $stmt->errorInfo()[2]);
        }
    }
}

?>