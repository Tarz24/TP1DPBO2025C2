#include <iostream>
#include <string>

using namespace std;

class PetShop {
    private:
    int id;
    string name;
    string category;
    int price;
    
    public:
    PetShop() {
        this->id = -1;
        this->name = "";
        this->category = "";
        this->price = 0;
    }

    PetShop(int id, string name, string category, int price) {
        this->id = id;
        this->name = name;
        this->category = category;
        this->price = price;
    }

    void setData(int newId, string newName, string newCategory, int newPrice) {
        this->id = newId;
        this->name = newName;
        this->category = newCategory;
        this->price = newPrice;
    }
    
    int getId() {
        return this->id;
    }
    
    string getName() {
        return this->name;
    }
    
    string getCategory() {
        return this->category;
    }
    
    int getPrice() {
        return this->price;
    }

    ~PetShop() {
    }

};