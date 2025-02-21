<?php

class PetShop {
    // Properti private untuk menyimpan informasi produk
    private $id;         // Menyimpan ID produk
    private $name;       // Menyimpan nama produk
    private $category;   // Menyimpan kategori produk
    private $price;      // Menyimpan harga produk
    private $image;      // Menyimpan path gambar produk
    
    // Constructor untuk inisialisasi nilai default
    public function __construct() {
        $this->id = -1;          // Set ID default ke -1
        $this->name = "";        // Set nama default ke string kosong
        $this->category = "";    // Set kategori default ke string kosong
        $this->price = 0;        // Set harga default ke 0
        $this->image = "";       // Set image path default ke string kosong
    }
    
    // Method untuk mengatur semua data produk sekaligus
    public function setData($id, $name, $category, $price, $image = "") {
        $this->id = $id;                 // Set ID produk
        $this->name = $name;             // Set nama produk
        $this->category = $category;     // Set kategori produk
        $this->price = $price;           // Set harga produk
        $this->image = $image;           // Set path gambar produk
    }
    
    // Getter methods untuk mengakses data private
    public function getId() {
        return $this->id;        // Mengembalikan ID produk
    }
    
    public function getName() {
        return $this->name;      // Mengembalikan nama produk
    }
    
    public function getCategory() {
        return $this->category;  // Mengembalikan kategori produk
    }
    
    public function getPrice() {
        return $this->price;     // Mengembalikan harga produk
    }

    public function getImage() { 
        return $this->image;     // Mengembalikan path gambar produk
    }
}

// Cek dan mulai session jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inisialisasi array data di session jika belum ada
if (!isset($_SESSION['petshop_data'])) {
    $_SESSION['petshop_data'] = array();     // Array untuk menyimpan objek PetShop
    $_SESSION['item_count'] = 0;             // Counter jumlah item
}

// Membuat direktori uploads jika belum ada
$uploadDir = 'uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);           // Membuat folder dengan permission penuh
}

?>