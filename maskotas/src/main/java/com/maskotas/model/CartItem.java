package com.maskotas.model;

import java.io.Serializable;
import java.math.BigDecimal;

public class CartItem implements Serializable {

    private String id;
    private String name;
    private int quantity;
    private BigDecimal price;
    private String image;

    public String getId() { return id; }
    public void setId(String id) { this.id = id; }

    public String getName() { return name; }
    public void setName(String name) { this.name = name; }

    public int getQuantity() { return quantity; }
    public void setQuantity(int quantity) { this.quantity = quantity; }

    public BigDecimal getPrice() { return price; }
    public void setPrice(BigDecimal price) { this.price = price; }

    public String getImage() { return image; }
    public void setImage(String image) { this.image = image; }
}
