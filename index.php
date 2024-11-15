<?php
require_once 'ProductManager.php';

$productManager = new ProductManager();

$product = new Product("Macbook", 3000, "Apple computer");
$productManager->addProduct($product);

$product = $productManager->readProduct(1);
echo $product->name . "<br/>";

$product = new Product("iPhone", 1000, "Apple phone");
$productManager->updateProduct(1, $product);

$products = $productManager->readAllProducts();
foreach ($proudcts as $product){
    echo $product["name"] . "<br/>" . $product["price"] . "<br/>" . $product["description"] . "<br/>";
}

$productManager->deleteProduct(1);
?>