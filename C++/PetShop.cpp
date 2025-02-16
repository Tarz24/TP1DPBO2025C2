#include <iostream>
#include <string>

using namespace std;

// Mendefinisikan class PetShop
class PetShop {
    // Bagian private: menyimpan data yang hanya bisa diakses di dalam class
    private:
    int id;            // Menyimpan ID produk
    string name;       // Menyimpan nama produk
    string category;   // Menyimpan kategori produk
    int price;         // Menyimpan harga produk
    
    // Bagian public: menyimpan method yang bisa diakses dari luar class
    public:
    // Constructor default: membuat objek dengan nilai awal
    PetShop() {
        this->id = -1;         // Set ID default ke -1
        this->name = "";       // Set nama default ke string kosong
        this->category = "";   // Set kategori default ke string kosong
        this->price = 0;       // Set harga default ke 0
    }

    // Constructor dengan parameter: membuat objek dengan nilai yang ditentukan
    PetShop(int id, string name, string category, int price) {
        this->id = id;               // Set ID sesuai parameter
        this->name = name;           // Set nama sesuai parameter
        this->category = category;   // Set kategori sesuai parameter
        this->price = price;         // Set harga sesuai parameter
    }

    // Method untuk mengubah data produk
    void setData(int newId, string newName, string newCategory, int newPrice) {
        this->id = newId;               // Update ID
        this->name = newName;           // Update nama
        this->category = newCategory;   // Update kategori
        this->price = newPrice;         // Update harga
    }
    
    // Getter untuk mendapatkan ID produk
    int getId() {
        return this->id;
    }
    
    // Getter untuk mendapatkan nama produk
    string getName() {
        return this->name;
    }
    
    // Getter untuk mendapatkan kategori produk
    string getCategory() {
        return this->category;
    }
    
    // Getter untuk mendapatkan harga produk
    int getPrice() {
        return this->price;
    }

    // Destructor: dipanggil saat objek dihapus
    ~PetShop() {
    }
};