from PetShop import PetShop 

# Inisialisasi variabel-variabel yang akan digunakan
Menu = 0      # Variabel untuk menyimpan pilihan menu
Total = 0     # Variabel untuk perhitungan total (tidak digunakan dalam kode ini)
Count = 0     # Variabel untuk perhitungan (tidak digunakan dalam kode ini)
ID = 0        # Variabel untuk menyimpan ID produk
Name = ""     # Variabel untuk menyimpan nama produk
Category = "" # Variabel untuk menyimpan kategori produk
Price = 0     # Variabel untuk menyimpan harga produk

# Membuat array untuk menyimpan objek PetShop dengan kapasitas maksimal 100 data
Data = [PetShop() for _ in range(100)]  
ItemCount = 0  # Menghitung jumlah item yang tersimpan dalam array
found = False  # Flag untuk menandai apakah data ditemukan dalam pencarian

# Loop utama program
while True:
    # Menampilkan menu utama
    print ("\n=== MENU PETSHOP ===")
    print ("1. Menampilkan Data")
    print ("2. Menambahkan Data")
    print ("3. Mengubahkan Data")
    print ("4. Menghapus Data")
    print ("5. Mencari Data")
    print ("6. Keluar")
    Menu = int(input("Pilih Menu : "))  # Meminta input pilihan menu dari pengguna
    
    if Menu == 6:  # Jika memilih menu 6, keluar dari program
        print ("\nTerima Kasih Telah Menggunakan Program Pet Shop")
        break

    elif Menu == 1:  # Menu untuk menampilkan semua data
        print ("\n=== DAFTAR PRODUK PETSHOP ===")
        if ItemCount == 0:  # Cek apakah ada data yang tersimpan
            print ("Belum ada data produk")

        # Loop untuk menampilkan semua data yang tersimpan
        for i in range (0, ItemCount):
            print(f"ID : {Data[i].get_id()}")
            print(f"Nama Produk : {Data[i].get_name()}")
            print(f"Kategori : {Data[i].get_category()}")
            print(f"Harga : Rp{Data[i].get_price()}")
            print ("------------------------")

    elif Menu == 2:  # Menu untuk menambah data baru
        if ItemCount >= 100:  # Cek apakah array sudah penuh
            print ("Penyimpanan penuh!")

        # Meminta input data produk baru
        print ("\nMasukkan Data Produk Baru")
        ID = input ("ID : ")
        Name = input ("Nama Produk : ")
        Category = input ("Kategori Produk : ")
        Price = input ("Harga Produk : Rp")

        # Membuat objek baru dan menambahkannya ke array
        Data[ItemCount] = PetShop(ID, Name, Category, Price)
        ItemCount += 1  # Menambah hitungan item
        print ("Data berhasil ditambahkan")
    
    elif Menu == 3:  # Menu untuk mengubah data
        print ("\nMasukkan ID produk yang akan diubah: ")
        ID = input()
        found = False

        # Mencari data berdasarkan ID
        for i in range(0, ItemCount):
            if Data[i].get_id() == ID:
                found = True
                # Meminta input data baru
                Name = input("Nama Produk Baru: ")
                Category = input("Kategori Produk Baru: ")
                Price = input("Harga Produk Baru: Rp")
                
                # Mengubah data
                Data[i].set_data(ID, Name, Category, Price)
                print("Data berhasil diubah!")
                break
                
        if not found:
            print("ID produk tidak ditemukan!")
    
    elif Menu == 4:  # Menu untuk menghapus data
        print ("\nMasukkan ID produk yang akan dihapus: ")
        ID = input()
        found = False

        # Mencari dan menghapus data
        for i in range(0, ItemCount):
            if Data[i].get_id() == ID:
                found = True
                # Menggeser semua data setelah data yang dihapus
                for j in range(i, ItemCount - 1):
                    Data[j] = Data[j + 1]
                ItemCount -= 1  # Mengurangi hitungan item
                print("Data berhasil dihapus!")
                break
                
        if not found:
            print("ID produk tidak ditemukan!")

    elif Menu == 5:  # Menu untuk mencari data
        print ("\nMasukkan nama produk yang dicari: ")
        Name = input()
        found = False
        
        # Mencari data berdasarkan nama
        for i in range(0, ItemCount):
            if Data[i].get_name() == Name:
                # Menampilkan data yang ditemukan
                print("\nProduk ditemukan:")
                print(f"ID : {Data[i].get_id()}\n")
                print(f"Nama Produk : {Data[i].get_name()}")
                print(f"Kategori : {Data[i].get_category()}")
                print(f"Harga : Rp{Data[i].get_price()}")
                print ("------------------------")
                found = True
                break
                
        if not found:
            print("Produk tidak ditemukan!")
            
    else:  # Jika input menu tidak valid
        print ("\nMenu yang Anda pilih salah.")
        break