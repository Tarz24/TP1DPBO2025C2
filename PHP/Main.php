<?php
require_once 'petshop.php';

// Initialize or get session data

$output = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $menu = isset($_POST['menu']) ? intval($_POST['menu']) : 0;
    
    switch ($menu) {
        case 1: // Menampilkan Data
            $output .= "\n=== DAFTAR PRODUK PETSHOP ===\n";
            if ($_SESSION['item_count'] == 0) {
                $output .= "Belum ada data produk.\n";
            } else {
                for ($i = 0; $i < $_SESSION['item_count']; $i++) {
                    $item = unserialize($_SESSION['petshop_data'][$i]);
                    $output .= "ID: " . $item->getId() . "\n";
                    $output .= "Nama Produk: " . $item->getName() . "\n";
                    $output .= "Kategori: " . $item->getCategory() . "\n";
                    $output .= "Harga: Rp" . $item->getPrice() . "\n";
                    $output .= "------------------------\n";
                }
            }
            break;
            
        case 2: // Menambah Data
            if ($_SESSION['item_count'] >= 100) {
                $output .= "Penyimpanan penuh!\n";
            } else if (isset($_POST['add_confirm'])) {
                $id = intval($_POST['id']);
                $name = $_POST['name'];
                $category = $_POST['category'];
                $price = intval($_POST['price']);
                
                $newItem = new PetShop();
                $newItem->setData($id, $name, $category, $price);
                $_SESSION['petshop_data'][$_SESSION['item_count']] = serialize($newItem);
                $_SESSION['item_count']++;
                
                $output .= "Data berhasil ditambahkan!\n";
            }
            break;
            
        case 3: // Mengubah Data
            if (isset($_POST['update_confirm'])) {
                $id = intval($_POST['id']);
                $found = false;
                
                for ($i = 0; $i < $_SESSION['item_count']; $i++) {
                    $item = unserialize($_SESSION['petshop_data'][$i]);
                    if ($item->getId() == $id) {
                        $item->setData($id, $_POST['name'], $_POST['category'], intval($_POST['price']));
                        $_SESSION['petshop_data'][$i] = serialize($item);
                        $output .= "Data berhasil diubah!\n";
                        $found = true;
                        break;
                    }
                }
                
                if (!$found) {
                    $output .= "ID tidak ditemukan!\n";
                }
            }
            break;
            
        case 4: // Menghapus Data
            if (isset($_POST['id'])) {
                $id = intval($_POST['id']);
                $found = false;
                
                for ($i = 0; $i < $_SESSION['item_count']; $i++) {
                    $item = unserialize($_SESSION['petshop_data'][$i]);
                    if ($item->getId() == $id) {
                        for ($j = $i; $j < $_SESSION['item_count'] - 1; $j++) {
                            $_SESSION['petshop_data'][$j] = $_SESSION['petshop_data'][$j + 1];
                        }
                        $_SESSION['item_count']--;
                        $output .= "Data berhasil dihapus!\n";
                        $found = true;
                        break;
                    }
                }
                
                if (!$found) {
                    $output .= "ID tidak ditemukan!\n";
                }
            }
            break;
            
        case 5: // Mencari Data
            if (isset($_POST['name'])) {
                $name = $_POST['name'];
                $found = false;
                
                for ($i = 0; $i < $_SESSION['item_count']; $i++) {
                    $item = unserialize($_SESSION['petshop_data'][$i]);
                    if ($item->getName() == $name) {
                        if (!$found) {
                            $output .= "\nProduk ditemukan:\n";
                            $found = true;
                        }
                        $output .= "ID: " . $item->getId() . "\n";
                        $output .= "Nama Produk: " . $item->getName() . "\n";
                        $output .= "Kategori: " . $item->getCategory() . "\n";
                        $output .= "Harga: Rp" . $item->getPrice() . "\n";
                        $output .= "------------------------\n";
                    }
                }
                
                if (!$found) {
                    $output .= "Produk tidak ditemukan!\n";
                }
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
        body {
            font-family: monospace;
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }
        pre {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
        }
        .menu {
            margin-bottom: 20px;
        }
        .form {
            margin-top: 20px;
        }
        input[type="text"], input[type="number"] {
            width: 200px;
            padding: 5px;
            margin: 5px 0;
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

    <!-- Output Area -->
    <?php if (!empty($output)): ?>
    <pre><?php echo $output; ?></pre>
    <?php endif; ?>

    <!-- Menu Selection Form -->
    <div class="form">
        <form method="post" action="">
            <label>Pilih Menu (1-6): </label>
            <input type="number" name="menu" min="1" max="6" required>
            <input type="submit" value="Pilih">
        </form>
    </div>

    <!-- Conditional Forms based on Menu Selection -->
    <?php if (isset($_POST['menu'])): ?>
        <?php switch ($_POST['menu']): 
            case 2: // Form Tambah Data ?>
                <div class="form">
                    <h3>Tambah Data Baru</h3>
                    <form method="post" action="">
                        <input type="hidden" name="menu" value="2">
                        <input type="hidden" name="add_confirm" value="1">
                        <p>ID: <input type="number" name="id" required></p>
                        <p>Nama: <input type="text" name="name" required></p>
                        <p>Kategori: <input type="text" name="category" required></p>
                        <p>Harga: <input type="number" name="price" required></p>
                        <input type="submit" value="Tambah Data">
                    </form>
                </div>
                <?php break; ?>

            <?php case 3: // Form Update Data ?>
                <div class="form">
                    <h3>Update Data</h3>
                    <form method="post" action="">
                        <input type="hidden" name="menu" value="3">
                        <input type="hidden" name="update_confirm" value="1">
                        <p>ID: <input type="number" name="id" required></p>
                        <p>Nama Baru: <input type="text" name="name" required></p>
                        <p>Kategori Baru: <input type="text" name="category" required></p>
                        <p>Harga Baru: <input type="number" name="price" required></p>
                        <input type="submit" value="Update Data">
                    </form>
                </div>
                <?php break; ?>

            <?php case 4: // Form Hapus Data ?>
                <div class="form">
                    <h3>Hapus Data</h3>
                    <form method="post" action="">
                        <input type="hidden" name="menu" value="4">
                        <p>ID: <input type="number" name="id" required></p>
                        <input type="submit" value="Hapus Data">
                    </form>
                </div>
                <?php break; ?>

            <?php case 5: // Form Cari Data ?>
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