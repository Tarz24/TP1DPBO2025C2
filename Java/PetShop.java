public class PetShop {
    // Private instance variables
    private int id;
    private String name;
    private String category;
    private int price;
    
    // Default constructor
    public PetShop() {
        this.id = -1;
        this.name = "";
        this.category = "";
        this.price = 0;
    }
    
    // Parameterized constructor
    public PetShop(int id, String name, String category, int price) {
        this.id = id;
        this.name = name;
        this.category = category;
        this.price = price;
    }
    
    // Method to set all data at once
    public void setData(int newId, String newName, String newCategory, int newPrice) {
        this.id = newId;
        this.name = newName;
        this.category = newCategory;
        this.price = newPrice;
    }
    
    // Getter methods
    public int getId() {
        return this.id;
    }
    
    public String getName() {
        return this.name;
    }
    
    public String getCategory() {
        return this.category;
    }
    
    public int getPrice() {
        return this.price;
    }
}