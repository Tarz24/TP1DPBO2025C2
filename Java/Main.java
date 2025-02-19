import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        // Initialize scanner for input
        Scanner scanner = new Scanner(System.in);
        
        // Declare variables
        int menu;
        int id, price;
        String name, category;
        
        // Array to store PetShop objects
        PetShop[] data = new PetShop[100];
        int itemCount = 0;
        boolean found;
        
        // Main program loop
        while (true) {
            // Display menu
            System.out.println("\n=== MENU PETSHOP ===");
            System.out.println("1. Menampilkan Data");
            System.out.println("2. Menambahkan Data");
            System.out.println("3. Mengubah Data");
            System.out.println("4. Menghapus Data");
            System.out.println("5. Mencari Data");
            System.out.println("6. Keluar");
            System.out.print("Pilih Menu : ");
            menu = scanner.nextInt();
            
            // Check if user wants to exit
            if (menu == 6) {
                System.out.println("\nTerima Kasih Telah Menggunakan Program Pet Shop");
                break;
            }
            
            // Handle menu selection
            switch (menu) {
                case 1: // Display all data
                    System.out.println("\n=== DAFTAR PRODUK PETSHOP ===");
                    if (itemCount == 0) {
                        System.out.println("Belum ada data produk.");
                        break;
                    }
                    
                    for (int i = 0; i < itemCount; i++) {
                        System.out.println("ID: " + data[i].getId());
                        System.out.println("Nama Produk: " + data[i].getName());
                        System.out.println("Kategori: " + data[i].getCategory());
                        System.out.println("Harga: Rp" + data[i].getPrice());
                        System.out.println("------------------------");
                    }
                    break;
                    
                case 2: // Add new data
                    if (itemCount >= 100) {
                        System.out.println("Penyimpanan penuh!");
                        break;
                    }
                    
                    System.out.println("\nMasukkan Data Produk Baru");
                    System.out.print("ID: ");
                    id = scanner.nextInt();
                    scanner.nextLine(); // Consume newline
                    System.out.print("Nama Produk: ");
                    name = scanner.nextLine();
                    System.out.print("Kategori Produk: ");
                    category = scanner.nextLine();
                    System.out.print("Harga Produk: Rp");
                    price = scanner.nextInt();
                    
                    data[itemCount] = new PetShop();
                    data[itemCount].setData(id, name, category, price);
                    itemCount++;
                    
                    System.out.println("Data berhasil ditambahkan!");
                    break;
                    
                case 3: // Update data
                    System.out.print("\nMasukkan ID produk yang akan diubah: ");
                    id = scanner.nextInt();
                    
                    for (int i = 0; i < itemCount; i++) {
                        if (data[i].getId() == id) {
                            scanner.nextLine(); // Consume newline
                            System.out.print("Nama Produk Baru: ");
                            name = scanner.nextLine();
                            System.out.print("Kategori Produk Baru: ");
                            category = scanner.nextLine();
                            System.out.print("Harga Produk Baru: Rp");
                            price = scanner.nextInt();
                            
                            data[i].setData(id, name, category, price);
                            System.out.println("Data berhasil diubah!");
                            break;
                        }
                        if (i == itemCount - 1) {
                            System.out.println("ID tidak ditemukan!");
                        }
                    }
                    break;
                    
                case 4: // Delete data
                    System.out.print("\nMasukkan ID produk yang akan dihapus: ");
                    id = scanner.nextInt();
                    
                    for (int i = 0; i < itemCount; i++) {
                        if (data[i].getId() == id) {
                            // Shift remaining elements
                            for (int j = i; j < itemCount - 1; j++) {
                                data[j] = data[j + 1];
                            }
                            itemCount--;
                            System.out.println("Data berhasil dihapus!");
                            break;
                        }
                        if (i == itemCount - 1) {
                            System.out.println("ID tidak ditemukan!");
                        }
                    }
                    break;
                    
                case 5: // Search data
                    System.out.print("\nMasukkan nama produk yang dicari: ");
                    scanner.nextLine(); // Consume newline
                    name = scanner.nextLine();
                    
                    found = false;
                    
                    for (int i = 0; i < itemCount; i++) {
                        if (data[i].getName().equals(name)) {
                            if (!found) {
                                System.out.println("\nProduk ditemukan:");
                                found = true;
                            }
                            System.out.println("ID: " + data[i].getId());
                            System.out.println("Nama Produk: " + data[i].getName());
                            System.out.println("Kategori: " + data[i].getCategory());
                            System.out.println("Harga: Rp" + data[i].getPrice());
                            System.out.println("------------------------");
                        }
                    }
                    if (!found) {
                        System.out.println("Produk tidak ditemukan!");
                    }
                    break;
                    
                default:
                    System.out.println("\nMenu yang Anda pilih salah.");
                    break;
            }
        }
        
        scanner.close();
    }
}