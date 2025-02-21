<?php
require_once 'petshop.php';

// Variable untuk menyimpan output yang akan ditampilkan
$output = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai menu yang dipilih
    $menu = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
    
    switch ($menu) {
        case 1: // Menampilkan Data
            $output .= "<div class='product-list'>";
            $output .= "<h2>=== DAFTAR PRODUK PETSHOP ===</h2>";
            // Cek apakah ada data produk
            if ($_SESSION['item_count'] == 0) {
                $output .= "<p>Belum ada data produk.</p>";
            } else {
                // Loop untuk menampilkan setiap produk
                for ($i = 0; $i < $_SESSION['item_count']; $i++) {
                    $item = unserialize($_SESSION['petshop_data'][$i]);
                    // Membuat container untuk setiap produk
                    $output .= "<div class='product-item'>";
                    // Menampilkan informasi produk
                    $output .= "<div class='product-info'>";
                    $output .= "<p><strong>ID:</strong> " . $item->getId() . "</p>";
                    $output .= "<p><strong>Nama Produk:</strong> " . $item->getName() . "</p>";
                    $output .= "<p><strong>Kategori:</strong> " . $item->getCategory() . "</p>";
                    $output .= "<p><strong>Harga:</strong> Rp" . $item->getPrice() . "</p>";
                    $output .= "</div>";
                    
                    // Menampilkan gambar jika ada
                    if ($item->getImage() && file_exists($item->getImage())) {
                        $output .= "<div class='product-image'>";
                        $output .= "<img src='" . $item->getImage() . "' alt='Gambar " . $item->getName() . "'>";
                        $output .= "</div>";
                    }
                    $output .= "<hr>";
                    $output .= "</div>";
                }
            }
            $output .= "</div>";
            break;
            
        case 2: // Menambah Data
            // Cek apakah penyimpanan sudah penuh
            if ($_SESSION['item_count'] >= 100) {
                $output .= "Penyimpanan penuh!\n";
            } else if (isset($_POST['add_confirm'])) {
                // Mengambil data dari form
                $id = intval($_POST['id']);
                $name = $_POST['name'];
                $category = $_POST['category'];
                $price = intval($_POST['price']);
                
                // Handle upload gambar
                $image_path = "";
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $target_dir = "uploads/";
                    // Mendapatkan ekstensi file
                    $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                    // Membuat nama file baru berdasarkan ID
                    $image_path = $target_dir . $id . "." . $file_extension;
                    
                    // Memindahkan file yang diupload
                    move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);
                }
                
                // Membuat objek PetShop baru
                $newItem = new PetShop();
                $newItem->setData($id, $name, $category, $price, $image_path);
                // Menyimpan ke session
                $_SESSION['petshop_data'][$_SESSION['item_count']] = serialize($newItem);
                $_SESSION['item_count']++;
                
                $output .= "Data berhasil ditambahkan!\n";
            }
            break;
            
        case 3: // Mengubah Data
            // Cek apakah form update sudah disubmit
            if (isset($_POST['update_confirm'])) {
                // Mengambil ID yang akan diupdate
                $id = intval($_POST['id']);
                $found = false;
                
                // Mencari produk dengan ID yang sesuai
                for ($i = 0; $i < $_SESSION['item_count']; $i++) {
                    $item = unserialize($_SESSION['petshop_data'][$i]);
                    if ($item->getId() == $id) {
                        // Simpan path gambar yang lama
                        $image_path = $item->getImage(); 
                        
                        // Cek apakah ada upload gambar baru
                        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                            // Hapus gambar lama jika ada
                            if ($image_path && file_exists($image_path)) {
                                unlink($image_path);
                            }
                            
                            // Proses upload gambar baru
                            $target_dir = "uploads/";
                            $file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                            $image_path = $target_dir . $id . "." . $file_extension;
                            
                            // Pindahkan file yang diupload
                            move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);
                        }
                        
                        // Update data produk
                        $item->setData($id, $_POST['name'], $_POST['category'], intval($_POST['price']), $image_path);
                        $_SESSION['petshop_data'][$i] = serialize($item);
                        $output .= "Data berhasil diubah!\n";
                        $found = true;
                        break;
                    }
                }
                
                // Tampilkan pesan jika ID tidak ditemukan
                if (!$found) {
                    $output .= "ID tidak ditemukan!\n";
                }
            }
            break;
            
        case 4: // Menghapus Data
            // Cek apakah ID yang akan dihapus sudah disubmit
            if (isset($_POST['id'])) {
                $id = intval($_POST['id']);
                $found = false;
                
                // Mencari produk dengan ID yang sesuai
                for ($i = 0; $i < $_SESSION['item_count']; $i++) {
                    $item = unserialize($_SESSION['petshop_data'][$i]);
                    if ($item->getId() == $id) {
                        // Geser semua data setelah index yang dihapus
                        for ($j = $i; $j < $_SESSION['item_count'] - 1; $j++) {
                            $_SESSION['petshop_data'][$j] = $_SESSION['petshop_data'][$j + 1];
                        }
                        $_SESSION['item_count']--;
                        $output .= "Data berhasil dihapus!\n";
                        $found = true;
                        break;
                    }
                }
                
                // Tampilkan pesan jika ID tidak ditemukan
                if (!$found) {
                    $output .= "ID tidak ditemukan!\n";
                }
            }
            break;
            
        case 5: // Mencari Data
            // Cek apakah nama produk yang dicari sudah disubmit
            if (isset($_POST['name'])) {
                $name = $_POST['name'];
                $found = false;
                // Membuat container untuk hasil pencarian
                $output .= "<div class='search-results'>\n";
                
                // Mencari produk dengan nama yang sesuai
                for ($i = 0; $i < $_SESSION['item_count']; $i++) {
                    $item = unserialize($_SESSION['petshop_data'][$i]);
                    if ($item->getName() == $name) {
                        // Header untuk hasil pertama yang ditemukan
                        if (!$found) {
                            $output .= "<h3>Produk ditemukan:</h3>\n";
                            $found = true;
                        }
                        // Menampilkan informasi produk yang ditemukan
                        $output .= "<div class='product-item'>\n";
                        $output .= "ID: " . $item->getId() . "\n";
                        $output .= "Nama Produk: " . $item->getName() . "\n";
                        $output .= "Kategori: " . $item->getCategory() . "\n";
                        $output .= "Harga: Rp" . $item->getPrice() . "\n";
                        
                        // Menampilkan gambar jika ada
                        if ($item->getImage() && file_exists($item->getImage())) {
                            $output .= "<div class='product-image'>\n";
                            $output .= "<img src='" . $item->getImage() . "' alt='Product Image' style='max-width: 200px;'>\n";
                            $output .= "</div>\n";
                        }
                        
                        $output .= "------------------------\n";
                        $output .= "</div>\n";
                    }
                }
                
                // Tampilkan pesan jika produk tidak ditemukan
                if (!$found) {
                    $output .= "Produk tidak ditemukan!\n";
                }
                
                $output .= "</div>";
            }
            break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PetShop Management System</title>
    <style>
        .product-list {
            margin: 20px 0;
        }
        .product-item {
            padding: 15px;
            margin-bottom: 20px;
            background: #f9f9f9;
            border-radius: 5px;
        }
        .product-info {
            margin-bottom: 10px;
        }
        .product-image {
            margin: 10px 0;
        }
        .product-image img {
            max-width: 200px;
            height: auto;
            border: 1px solid #ddd;
            padding: 3px;
            background: white;
        }
        hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <h1>PetShop Management System</h1>
    
    <div class="menu">
        <pre>
=== MENU PETSHOP ===
1. Menampilkan Data
2. Menambahkan Data
3. Mengubah Data
4. Menghapus Data
5. Mencari Data
6. Keluar
        </pre>
    </div>

    <?php if (!empty($output)): ?>
        <pre><?php echo $output; ?></pre>
    <?php endif; ?>

    <div class="form">
        <form method="post" action="">
            <label>Pilih Menu (1-6): </label>
            <input type="number" name="menu" min="1" max="6" required>
            <input type="submit" value="Pilih">
        </form>
    </div>

    <?php if (isset($_POST['menu'])): ?>
        <?php switch ($_POST['menu']): 
            case 2: // Form untuk menambah data ?>
                <div class="form">
                    <h3>Tambah Data Baru</h3>
                    <form method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="menu" value="2">
                        <input type="hidden" name="add_confirm" value="1">
                        <p>ID: <input type="number" name="id" required></p>
                        <p>Nama: <input type="text" name="name" required></p>
                        <p>Kategori: <input type="text" name="category" required></p>
                        <p>Harga: <input type="number" name="price" required></p>
                        <p>Gambar: <input type="file" name="image" accept="image/*"></p>
                        <input type="submit" value="Tambah Data">
                    </form>
                </div>
                <?php break; ?>

            <?php case 3: // Form untuk update data ?>
                <div class="form">
                    <h3>Update Data</h3>
                    <form method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="menu" value="3">
                        <input type="hidden" name="update_confirm" value="1">
                        <p>ID: <input type="number" name="id" required></p>
                        <p>Nama Baru: <input type="text" name="name" required></p>
                        <p>Kategori Baru: <input type="text" name="category" required></p>
                        <p>Harga Baru: <input type="number" name="price" required></p>
                        <p>Gambar Baru: <input type="file" name="image" accept="image/*"></p>
                        <p><small>*Biarkan kosong jika tidak ingin mengubah gambar</small></p>
                        <input type="submit" value="Update Data">
                    </form>
                </div>
                <?php break; ?>

            <?php case 4: // Form untuk hapus data ?>
                <div class="form">
                    <h3>Hapus Data</h3>
                    <form method="post" action="">
                        <input type="hidden" name="menu" value="4">
                        <p>ID: <input type="number" name="id" required></p>
                        <input type="submit" value="Hapus Data">
                    </form>
                </div>
                <?php break; ?>

            <?php case 5: // Form untuk mencari data ?>
                <div class="form">
                    <h3>Cari Data</h3>
                    <form method="post" action="">
                        <input type="hidden" name="menu" value="5">
                        <p>Nama Produk: <input type="text" name="name" required></p>
                        <input type="submit" value="Cari Data">
                    </form>
                </div>
                <?php break; ?>
        <?php endswitch; ?>
    <?php endif; ?>

</body>
</html>