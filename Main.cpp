#include <iostream>
#include "PetShop.cpp"

using namespace std;

int main() {
    int Menu, Total;
    int Count = 0;
    int ID, Price;
    string Name, Category;

    PetShop Data[100];
    int ItemCount = 0;
    bool found = false;

    while (true) {
        cout << "\n=== MENU PETSHOP ===" << endl;
        cout << "1. Menampilkan Data" << endl;
        cout << "2. Menambahkan Data" << endl;
        cout << "3. Mengubah Data" << endl;
        cout << "4. Menghapus Data" << endl;
        cout << "5. Mencari Data" << endl;
        cout << "6. Keluar" << endl;
        cout << "Pilih Menu : "; cin >> Menu;
        
        if (Menu == 6) {
            cout << "\nTerima Kasih Telah Menggunakan Program Pet Shop" << endl;
            break;
        }

        switch (Menu) {
            case 1:
                cout << "\n=== DAFTAR PRODUK PETSHOP ===" << endl;
                if (ItemCount == 0) {
                    cout << "Belum ada data produk." << endl;
                    break;
                }

                for (int i = 0; i < ItemCount; i++) {
                    cout << "ID: " << Data[i].getId() << endl;
                    cout << "Nama Produk: " << Data[i].getName() << endl;
                    cout << "Kategori: " << Data[i].getCategory() << endl;
                    cout << "Harga: Rp" << Data[i].getPrice() << endl;
                    cout << "------------------------" << endl;
                }
                break;

            case 2:
                if (ItemCount >= 100) {
                    cout << "Penyimpanan penuh!" << endl;
                    break;
                }

                cout << "\nMasukkan Data Produk Baru" << endl;
                cout << "ID: ";
                cin >> ID;
                cin.ignore();
                cout << "Nama Produk: ";
                getline(cin, Name);
                cout << "Kategori Produk: ";
                getline(cin, Category);
                cout << "Harga Produk: Rp";
                cin >> Price;
                
                Data[ItemCount].setData(ID, Name, Category, Price);
                ItemCount++;

                cout << "Data berhasil ditambahkan!" << endl;
                break;

            case 3:
                cout << "\nMasukkan ID produk yang akan diubah: ";
                cin >> ID;
                
                for (int i = 0; i < ItemCount; i++) {
                    if (Data[i].getId() == ID) {
                        cin.ignore();
                        cout << "Nama Produk Baru: ";
                        getline(cin, Name);
                        cout << "Kategori Produk Baru: ";
                        getline(cin, Category);
                        cout << "Harga Produk Baru: Rp";
                        cin >> Price;
                        
                        Data[i].setData(ID, Name, Category, Price);
                        cout << "Data berhasil diubah!" << endl;
                        break;
                    }
                    if (i == ItemCount - 1) {
                        cout << "ID tidak ditemukan!" << endl;
                    }
                }
                break;

            case 4:
                cout << "\nMasukkan ID produk yang akan dihapus: ";
                cin >> ID;
                
                for (int i = 0; i < ItemCount; i++) {
                    if (Data[i].getId() == ID) {
                        // Geser data setelahnya maju
                        for (int j = i; j < ItemCount - 1; j++) {
                            Data[j] = Data[j + 1];
                        }
                        ItemCount--;
                        cout << "Data berhasil dihapus!" << endl;
                        break;
                    }
                    if (i == ItemCount - 1) {
                        cout << "ID tidak ditemukan!" << endl;
                    }
                }
                break;

            case 5:
                cout << "\nMasukkan nama produk yang dicari: ";
                cin.ignore();
                getline(cin, Name);
                
                
                for (int i = 0; i < ItemCount; i++) {
                    if (Data[i].getName() == Name) {
                        if (!found) {
                            cout << "\nProduk ditemukan:" << endl;
                            found = true;
                        }
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

            default:
                cout << "\nMenu yang Anda pilih salah." << endl;
            break;
        }
    }

    return 0;
}