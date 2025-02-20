public class PetShop {
    // Deklarasi variabel instance private
    private int id;         // Menyimpan ID produk
    private String name;    // Menyimpan nama produk
    private String category;// Menyimpan kategori produk
    private int price;      // Menyimpan harga produk
    
    // Constructor default
    public PetShop() {
        // Inisialisasi nilai default
        this.id = -1;
        this.name = "";
        this.category = "";
        this.price = 0;
    }
    
    // Constructor dengan parameter
    public PetShop(int id, String name, String category, int price) {
        // Inisialisasi nilai sesuai parameter
        this.id = id;
        this.name = name;
        this.category = category;
        this.price = price;
    }
    
    // Method untuk mengatur semua data sekaligus
    public void setData(int newId, String newName, String newCategory, int newPrice) {
        this.id = newId;
        this.name = newName;
        this.category = newCategory;
        this.price = newPrice;
    }
    
    // Method getter untuk mengambil nilai id
    public int getId() {
        return this.id;
    }
    
    // Method getter untuk mengambil nilai name
    public String getName() {
        return this.name;
    }
    
    // Method getter untuk mengambil nilai category
    public String getCategory() {
        return this.category;
    }
    
    // Method getter untuk mengambil nilai price
    public int getPrice() {
        return this.price;
    }
}