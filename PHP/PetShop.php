<?php

class PetShop {
    private $id;
    private $name;
    private $category;
    private $price;
    
    public function __construct() {
        $this->id = -1;
        $this->name = "";
        $this->category = "";
        $this->price = 0;
    }
    
    public function setData($id, $name, $category, $price) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getCategory() {
        return $this->category;
    }
    
    public function getPrice() {
        return $this->price;
    }
}

// Initialize session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize data array in session if not exists
if (!isset($_SESSION['petshop_data'])) {
    $_SESSION['petshop_data'] = array();
    $_SESSION['item_count'] = 0;
}

?>