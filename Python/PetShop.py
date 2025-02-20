class PetShop:
    # Deklarasi variabel private
    __id = -1          # Menyimpan ID produk
    __name = ""        # Menyimpan nama produk
    __category = ""    # Menyimpan kategori produk
    __price = 0        # Menyimpan harga produk

    # Constructor dengan parameter default
    def __init__(self, id = -1, name = "", category = "", price = 0):
        # Menginisialisasi atribut dengan nilai parameter
        self.__id = id
        self.__name = name
        self.__category = category
        self.__price = price
    
    # Method untuk mengatur data produk
    def set_data(self, id, name, category, price):
        self.__id = id
        self.__name = name
        self.__category = category
        self.__price = price
    
    # Getter untuk mendapatkan ID produk
    def get_id(self):
        return self.__id
    
    # Getter untuk mendapatkan nama produk
    def get_name(self):
        return self.__name
    
    # Getter untuk mendapatkan kategori produk
    def get_category(self):
        return self.__category
    
    # Getter untuk mendapatkan harga produk
    def get_price(self):
        return self.__price