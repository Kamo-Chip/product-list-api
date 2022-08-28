<?php

include "includes/autoloader.inc.php";
include "DbConnect.php";
/**
 * Handles database queries
 */

class DbManager extends DbConnect
{
    /**
     * Fetches all the products in database
     */
    public function getProducts()
    {
        $sql = "SELECT * FROM products";
        $stmt = mysqli_query($this->connect(), $sql);
        $products = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        echo json_encode($products);
    }

    /**
     * Inserts a product into the database
     */
    public function addProduct()
    {
        $product_values = json_decode(file_get_contents("php://input"));
        $class_name = strtolower($product_values->productType);
        $product = new $class_name($product_values->sku, $product_values->name, $product_values->price, $product_values->attributeValue, $product_values->productType);
        $sql = "INSERT INTO products(sku, name, attribute, attribute_value, product_type, price) 
        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param("sssssd", $sku, $name, $attribute, $attribute_value, $product_type, $price);
        $sku = $product->getSku();
        $name= $product->getName();
        $attribute = $product->getAttribute();
        $attribute_value = $product->getAttributeValue();
        $product_type = $product->getProductType();
        $price = $product->getPrice();
        
        if ($stmt->execute()) {
            $response = ["status" => 1, "message" => "Record created successfully"];
        } else {
            $response = ["status" => 0, "message" => "Failded to create record"];
        }

        echo json_encode($response);
    }

    /**
     * Deletes a product from the database
     */
    public function deleteProduct()
    {
        $product_values = json_decode(file_get_contents("php://input"));
        $class_name = strtolower($product_values->product_type);
        $product = new $class_name($product_values->sku, $product_values->name, $product_values->price, $product_values->attribute_value, $product_values->product_type);
        $sql = "DELETE FROM products WHERE sku=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param("s", $sku);
        $sku = $product->getSku();
        if ($stmt->execute()) {
            $response = ["status" => 1, "message" => "Record deleted successfully"];
        } else {
            $response = ["status" => 0, "message" => "Failed to delete record"];
            echo $this->connect()->error;
        }
        echo json_encode($response);
    }
}
