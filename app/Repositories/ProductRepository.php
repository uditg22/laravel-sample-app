<?php

namespace App\Repositories;


use Carbon\Carbon;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use File;

class ProductRepository
{

    const PRODUCTS_FILE_PATH = "/app/products";
    const JSON_FILE_EXT = ".json";
    const TIMEZONE_IST = 'Asia/Kolkata';

    /**
     *
     * Return the list of all the products
     *
     * @return array
     *
     */
    public function indexAll()
    {
        return $this->getProducts();
    }

    public function store($productName, $productQuantity, $productPricePerItem)
    {
        $products = $this->getProducts();
        $newProduct = array(
            'id' => count($products)+1,
            'name' => $productName,
            'quantity' => $productQuantity,
            'item_price' => $productPricePerItem,
            'creation_date' => Carbon::now(self::TIMEZONE_IST)->toDateTimeString()
        );
        array_push($products, $newProduct);
        $this->saveAllProducts($products);
    }

    public function getProductById($productId)
    {
        $products = $this->getProducts();
        foreach($products as $product) {
            if($product['id'] == $productId) {
                return $product;
            }
        }
        abort(404);
    }

    public function update($productId, $productName, $productQuantity, $productPricePerItem)
    {
        $products = $this->getProducts();
        foreach($products as &$product) {
            if($product['id'] == $productId) {
                $product['name'] = $productName;
                $product['quantity'] = $productQuantity;
                $product['item_price'] = $productPricePerItem;
            }
        }
        $this->saveAllProducts($products);
    }

    protected function getProducts()
    {
        return $this->getProductsFromJSON();
    }

    protected function getProductsFromJSON()
    {
        $productsJSON = File::get($this->getProductsFilePath());
        $products = json_decode($productsJSON, true);
        return $products;
    }

    protected function saveAllProducts($products)
    {
        $this->saveAllProductsToJson($products);
    }

    protected function saveAllProductsToJson($products)
    {
        File::put($this->getProductsFilePath(), json_encode($products), true);
    }

    protected function getProductsFilePath()
    {
        return storage_path().self::PRODUCTS_FILE_PATH.self::JSON_FILE_EXT;
    }
}