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
        // $products = $stmt->fetchAll();
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
        VALUES ($product->getSku(), $product->getName(), $product->getAttribute(), $product->getAttributeValue(), $product->getProductType(), $product->getPrice())";
        // $stmt = $this->connect()->prepare($sql);
        // $stmt->bindParam(":sku", $product->getSku());
        // $stmt->bindParam(":name", $product->getName());
        // $stmt->bindParam(":attribute", $product->getAttribute());
        // $stmt->bindParam(":attribute_value", $product->getAttributeValue());
        // $stmt->bindParam(":product_type", $product->getProductType());
        // $stmt->bindParam(":price", $product->getPrice());
        // if ($stmt->execute()) {
        //     $response = ["status" => 1, "message" => "Record created successfully"];
        // } else {
        //     $response = ["status" => 0, "message" => "Failded to create record"];
        // }

        //echo json_encode($response);
        if($this->connect()->query($sql)){
            echo "Record created successfully";
        }else {
            echo "Error: ";
        }
    }

    /**
     * Deletes a product from the database
     */
    public function deleteProduct()
    {
        $product_values = json_decode(file_get_contents("php://input"));
        $class_name = strtolower($product_values->product_type);
        $product = new $class_name($product_values->sku, $product_values->name, $product_values->price, $product_values->attribute_value, $product_values->product_type);
        $sql = "DELETE FROM products WHERE sku=$product->getSku()";
        // $stmt = $this->connect()->prepare($sql);
        // $stmt->bindParam(":sku", $product->getSku());
        // if ($stmt->execute()) {
        //     $response = ["status" => 1, "message" => "Record deleted successfully"];
        // } else {
        //     $response = ["status" => 0, "message" => "Failed to delete record"];
        // }
        // echo json_encode($response);
        if($this->connect()->query($sql)){
            echo "Record created successfully";
        }else {
            echo "Error: ";
        }
    }
}
