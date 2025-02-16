#include <iostream>
#include "PetShop.cpp"

using namespace std;

// Fungsi utama program
int main() {
    // Deklarasi variabel yang dibutuhkan
    int Menu, Total;           // Variabel untuk pilihan menu dan total
    int Count = 0;            // Counter (tidak digunakan dalam kode)
    int ID, Price;            // Variabel untuk ID dan harga produk
    string Name, Category;     // Variabel untuk nama dan kategori produk

    PetShop Data[100];        // Array untuk menyimpan data produk (maksimal 100)
    int ItemCount = 0;        // Menghitung jumlah item yang tersimpan
    bool found = false;       // Flag untuk pencarian produk

    // Loop utama program
    while (true) {
        // Menampilkan menu utama
        cout << "\n=== MENU PETSHOP ===" << endl;
        cout << "1. Menampilkan Data" << endl;
        cout << "2. Menambahkan Data" << endl;
        cout << "3. Mengubah Data" << endl;
        cout << "4. Menghapus Data" << endl;
        cout << "5. Mencari Data" << endl;
        cout << "6. Keluar" << endl;
        cout << "Pilih Menu : "; cin >> Menu;
        
        // Cek apakah user memilih untuk keluar
        if (Menu == 6) {
            cout << "\nTerima Kasih Telah Menggunakan Program Pet Shop" << endl;
            break;
        }

        // Switch case untuk menangani pilihan menu
        switch (Menu) {
            case 1: // Menampilkan semua data
                cout << "\n=== DAFTAR PRODUK PETSHOP ===" << endl;
                if (ItemCount == 0) {
                    cout << "Belum ada data produk." << endl;
                    break;
                }

                // Loop untuk menampilkan semua produk
                for (int i = 0; i < ItemCount; i++) {
                    cout << "ID: " << Data[i].getId() << endl;
                    cout << "Nama Produk: " << Data[i].getName() << endl;
                    cout << "Kategori: " << Data[i].getCategory() << endl;
                    cout << "Harga: Rp" << Data[i].getPrice() << endl;
                    cout << "------------------------" << endl;
                }
                break;

            case 2: // Menambah data baru
                // Cek apakah array sudah penuh
                if (ItemCount >= 100) {
                    cout << "Penyimpanan penuh!" << endl;
                    break;
                }

                // Input data produk baru
                cout << "\nMasukkan Data Produk Baru" << endl;
                cout << "ID: ";
                cin >> ID;
                cin.ignore();              // Membersihkan buffer input
                cout << "Nama Produk: ";
                getline(cin, Name);        // Membaca nama produk (bisa mengandung spasi)
                cout << "Kategori Produk: ";
                getline(cin, Category);    // Membaca kategori produk (bisa mengandung spasi)
                cout << "Harga Produk: Rp";
                cin >> Price;
                
                // Menyimpan data ke array
                Data[ItemCount].setData(ID, Name, Category, Price);
                ItemCount++;               // Menambah counter item

                cout << "Data berhasil ditambahkan!" << endl;
                break;

            case 3: // Mengubah data
                cout << "\nMasukkan ID produk yang akan diubah: ";
                cin >> ID;
                
                // Mencari produk berdasarkan ID
                for (int i = 0; i < ItemCount; i++) {
                    if (Data[i].getId() == ID) {
                        cin.ignore();
                        cout << "Nama Produk Baru: ";
                        getline(cin, Name);
                        cout << "Kategori Produk Baru: ";
                        getline(cin, Category);
                        cout << "Harga Produk Baru: Rp";
                        cin >> Price;
                        
                        // Update data produk
                        Data[i].setData(ID, Name, Category, Price);
                        cout << "Data berhasil diubah!" << endl;
                        break;
                    }
                    // Jika sampai akhir array tidak ditemukan
                    if (i == ItemCount - 1) {
                        cout << "ID tidak ditemukan!" << endl;
                    }
                }
                break;

            case 4: // Menghapus data
                cout << "\nMasukkan ID produk yang akan dihapus: ";
                cin >> ID;
                
                // Mencari produk berdasarkan ID
                for (int i = 0; i < ItemCount; i++) {
                    if (Data[i].getId() == ID) {
                        // Menggeser semua data setelah index yang dihapus
                        for (int j = i; j < ItemCount - 1; j++) {
                            Data[j] = Data[j + 1];
                        }
                        ItemCount--;       // Mengurangi counter item
                        cout << "Data berhasil dihapus!" << endl;
                        break;
                    }
                    // Jika sampai akhir array tidak ditemukan
                    if (i == ItemCount - 1) {
                        cout << "ID tidak ditemukan!" << endl;
                    }
                }
                break;

            case 5: // Mencari data
                cout << "\nMasukkan nama produk yang dicari: ";
                cin.ignore();
                getline(cin, Name);
                
                found = false;     // Reset flag pencarian
                
                // Mencari produk berdasarkan nama
                for (int i = 0; i < ItemCount; i++) {
                    if (Data[i].getName() == Name) {
                        if (!found) {
                            cout << "\nProduk ditemukan:" << endl;
                            found = true;
                        }
                        // Menampilkan data produk yang ditemukan
                        cout << "ID: " << Data[i].getId() << endl;
                        cout << "Nama Produk: " << Data[i].getName() << endl;
                        cout << "Kategori: " << Data[i].getCategory() << endl;
                        cout << "Harga: Rp" << Data[i].getPrice() << endl;
                        cout << "------------------------" << endl;
                    }
                }
                if (!found) {
                    cout << "Produk tidak ditemukan!" << endl;
                }
                break;

            default: // Jika pilihan menu tidak valid
                cout << "\nMenu yang Anda pilih salah." << endl;
            break;
        }
    }

    return 0; // Mengakhiri program
}