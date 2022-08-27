<?php
/**
 * Instantiates Furniture object
 */
class Furniture extends Product
{
    public function __construct($sku, $name, $price, $attribute_value, $product_type)
    {
        parent::__construct($sku, $name, $price, "Dimension", $attribute_value, $product_type);
    }
}
