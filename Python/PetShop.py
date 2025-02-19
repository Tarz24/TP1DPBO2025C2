# Class definition for PetShop
class PetShop:
    def __init__(self):
        # Initialize default values
        self.id = -1
        self.name = ""
        self.category = ""
        self.price = 0
    
    def set_data(self, id, name, category, price):
        # Set data for the product
        self.id = id
        self.name = name
        self.category = category
        self.price = price
    
    def get_id(self):
        return self.id
    
    def get_name(self):
        return self.name
    
    def get_category(self):
        return self.category
    
    def get_price(self):
        return self.price

# Main program
def main():
    Menu = 0
    Count = 0
    ID = 0
    Price = 0
    Name = ""
    Category = ""
    
    Data = [PetShop() for _ in range(100)]  # Array untuk menyimpan data produk (maksimal 100)
    ItemCount = 0  # Menghitung jumlah item yang tersimpan
    found = False  # Flag untuk pencarian produk
    
    while True:
        # Menampilkan menu utama
        print("\n=== MENU PETSHOP ===")
        print("1. Menampilkan Data")
        print("2. Menambahkan Data")
        print("3. Mengubah Data")
        print("4. Menghapus Data")
        print("5. Mencari Data")
        print("6. Keluar")
        Menu = int(input("Pilih Menu : "))
        
        # Cek apakah user memilih untuk keluar
        if Menu == 6:
            print("\nTerima Kasih Telah Menggunakan Program Pet Shop")
            break
        
        # Switch case untuk menangani pilihan menu
        if Menu == 1:  # Menampilkan semua data
            print("\n=== DAFTAR PRODUK PETSHOP ===")
            if ItemCount == 0:
                print("Belum ada data produk.")
                continue
            
            # Loop untuk menampilkan semua produk
            for i in range(ItemCount):
                print(f"ID: {Data[i].get_id()}")
                print(f"Nama Produk: {Data[i].get_name()}")
                print(f"Kategori: {Data[i].get_category()}")
                print(f"Harga: Rp{Data[i].get_price()}")
                print("------------------------")
        
        elif Menu == 2:  # Menambah data baru
            # Cek apakah array sudah penuh
            if ItemCount >= 100:
                print("Penyimpanan penuh!")
                continue
            
            # Input data produk baru
            print("\nMasukkan Data Produk Baru")
            ID = int(input("ID: "))
            Name = input("Nama Produk: ")
            Category = input("Kategori Produk: ")
            Price = int(input("Harga Produk: Rp"))
            
            # Menyimpan data ke array
            Data[ItemCount].set_data(ID, Name, Category, Price)
            ItemCount += 1  # Menambah counter item
            
            print("Data berhasil ditambahkan!")
        
        elif Menu == 3:  # Mengubah data
            ID = int(input("\nMasukkan ID produk yang akan diubah: "))
            
            # Mencari produk berdasarkan ID
            for i in range(ItemCount):
                if Data[i].get_id() == ID:
                    Name = input("Nama Produk Baru: ")
                    Category = input("Kategori Produk Baru: ")
                    Price = int(input("Harga Produk Baru: Rp"))
                    
                    # Update data produk
                    Data[i].set_data(ID, Name, Category, Price)
                    print("Data berhasil diubah!")
                    break
                # Jika sampai akhir array tidak ditemukan
                if i == ItemCount - 1:
                    print("ID tidak ditemukan!")
        
        elif Menu == 4:  # Menghapus data
            ID = int(input("\nMasukkan ID produk yang akan dihapus: "))
            
            # Mencari produk berdasarkan ID
            for i in range(ItemCount):
                if Data[i].get_id() == ID:
                    # Menggeser semua data setelah index yang dihapus
                    for j in range(i, ItemCount - 1):
                        Data[j] = Data[j + 1]
                    ItemCount -= 1  # Mengurangi counter item
                    print("Data berhasil dihapus!")
                    break
                # Jika sampai akhir array tidak ditemukan
                if i == ItemCount - 1:
                    print("ID tidak ditemukan!")
        
        elif Menu == 5:  # Mencari data
            Name = input("\nMasukkan nama produk yang dicari: ")
            
            found = False  # Reset flag pencarian
            
            # Mencari produk berdasarkan nama
            for i in range(ItemCount):
                if Data[i].get_name() == Name:
                    if not found:
                        print("\nProduk ditemukan:")
                        found = True
                    # Menampilkan data produk yang ditemukan
                    print(f"ID: {Data[i].get_id()}")
                    print(f"Nama Produk: {Data[i].get_name()}")
                    print(f"Kategori: {Data[i].get_category()}")
                    print(f"Harga: Rp{Data[i].get_price()}")
                    print("------------------------")
            if not found:
                print("Produk tidak ditemukan!")
        
        else:  # Jika pilihan menu tidak valid
            print("\nMenu yang Anda pilih salah.")

if __name__ == "__main__":
    main()