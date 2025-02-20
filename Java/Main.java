import java.util.LinkedList;
import java.util.Scanner;

public class Main {
    // Method utama yang akan dijalankan saat program dimulai
    public static void main(String[] args) {
        // Membuat objek Scanner untuk membaca input
        Scanner scanner = new Scanner(System.in);
        
        // Mendeklarasikan variabel-variabel yang akan digunakan
        int menu;          // Untuk menyimpan pilihan menu
        int id, price;     // Untuk menyimpan ID dan harga produk
        String name, category;  // Untuk menyimpan nama dan kategori produk
        
        // Membuat LinkedList untuk menyimpan objek PetShop
        LinkedList<PetShop> data = new LinkedList<>();
        boolean found;      // Flag untuk mencari data
        
        // Loop utama program
        while (true) {
            // Menampilkan menu pilihan
            System.out.println("\n=== MENU PETSHOP ===");
            System.out.println("1. Menampilkan Data");
            System.out.println("2. Menambahkan Data");
            System.out.println("3. Mengubah Data");
            System.out.println("4. Menghapus Data");
            System.out.println("5. Mencari Data");
            System.out.println("6. Keluar");
            System.out.print("Pilih Menu : ");
            
            // Try-catch untuk menangani error input menu
            try {
                menu = scanner.nextInt();  // Membaca pilihan menu
            } catch (Exception e) {
                // Menampilkan pesan error jika input bukan angka
                System.out.println("\nError: Masukan harus berupa angka!");
                scanner.nextLine();  // Membersihkan buffer input
                continue;  // Kembali ke awal loop
            }
            
            // Cek apakah user ingin keluar dari program
            if (menu == 6) {
                System.out.println("\nTerima Kasih Telah Menggunakan Program Pet Shop");
                break;  // Keluar dari loop utama
            }
            
            // Switch case untuk menangani pilihan menu
            switch (menu) {
                case 1: // Menampilkan semua data
                    System.out.println("\n=== DAFTAR PRODUK PETSHOP ===");
                    // Cek apakah ada data yang tersimpan
                    if (data.isEmpty()) {
                        System.out.println("Belum ada data produk.");
                        break;
                    }
                    
                    // Loop untuk menampilkan semua data
                    for (PetShop item : data) {
                        System.out.println("ID: " + item.getId());
                        System.out.println("Nama Produk: " + item.getName());
                        System.out.println("Kategori: " + item.getCategory());
                        System.out.println("Harga: Rp" + item.getPrice());
                        System.out.println("------------------------");
                    }
                    break;
                    
                case 2: // Menambah data baru
                    // Input data baru
                    System.out.println("\nMasukkan Data Produk Baru");
                    System.out.print("ID: ");
                    id = scanner.nextInt();
                    scanner.nextLine();  // Membersihkan newline
                    System.out.print("Nama Produk: ");
                    name = scanner.nextLine();
                    System.out.print("Kategori Produk: ");
                    category = scanner.nextLine();
                    System.out.print("Harga Produk: Rp");
                    price = scanner.nextInt();
                    
                    // Membuat objek baru dan menyimpan data
                    data.add(new PetShop(id, name, category, price));
                    System.out.println("Data berhasil ditambahkan!");
                    break;
                    
                case 3: // Mengubah data
                    System.out.print("\nMasukkan ID produk yang akan diubah: ");
                    id = scanner.nextInt();
                    found = false;
                    
                    // Loop untuk mencari ID yang akan diubah
                    for (PetShop item : data) {
                        if (item.getId() == id) {
                            scanner.nextLine();  // Membersihkan newline
                            System.out.print("Nama Produk Baru: ");
                            name = scanner.nextLine();
                            System.out.print("Kategori Produk Baru: ");
                            category = scanner.nextLine();
                            System.out.print("Harga Produk Baru: Rp");
                            price = scanner.nextInt();
                            
                            // Update data
                            item.setData(id, name, category, price);
                            System.out.println("Data berhasil diubah!");
                            found = true;
                            break;
                        }
                    }
                    
                    if (!found) {
                        System.out.println("ID tidak ditemukan!");
                    }
                    break;
                    
                case 4: // Menghapus data
                    System.out.print("\nMasukkan ID produk yang akan dihapus: ");
                    id = scanner.nextInt();
                    found = false;
                    
                    // Loop untuk mencari dan menghapus data
                    for (PetShop item : data) {
                        if (item.getId() == id) {
                            data.remove(item);
                            System.out.println("Data berhasil dihapus!");
                            found = true;
                            break;
                        }
                    }
                    
                    if (!found) {
                        System.out.println("ID tidak ditemukan!");
                    }
                    break;
                    
                case 5: // Mencari data
                    System.out.print("\nMasukkan nama produk yang dicari: ");
                    scanner.nextLine();  // Membersihkan newline
                    name = scanner.nextLine();
                    found = false;
                    
                    // Loop untuk mencari produk berdasarkan nama
                    for (PetShop item : data) {
                        if (item.getName().equals(name)) {
                            if (!found) {
                                System.out.println("\nProduk ditemukan:");
                                found = true;
                            }
                            // Menampilkan data yang ditemukan
                            System.out.println("ID: " + item.getId());
                            System.out.println("Nama Produk: " + item.getName());
                            System.out.println("Kategori: " + item.getCategory());
                            System.out.println("Harga: Rp" + item.getPrice());
                            System.out.println("------------------------");
                        }
                    }
                    
                    if (!found) {
                        System.out.println("Produk tidak ditemukan!");
                    }
                    break;
                    
                default:
                    // Pesan untuk pilihan menu yang tidak valid
                    System.out.println("\nMenu yang Anda pilih salah.");
                    break;
            }
        }
        
        // Menutup scanner untuk membersihkan resources
        scanner.close();
    }
}