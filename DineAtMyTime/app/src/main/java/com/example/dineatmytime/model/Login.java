package com.example.dineatmytime.model;

import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

public class Login {

    @SerializedName("cust_name")
    @Expose
    private String name;
    @SerializedName("cust_email")
    @Expose
    private String email;
    @SerializedName("cust_contact")
    @Expose
    private String contact;
    @SerializedName("cust_address")
    @Expose
    private String address;
    @SerializedName("created")
    @Expose
    private String created;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getContact() {
        return contact;
    }

    public void setContact(String contact) {
        this.contact = contact;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getCreated() {
        return created;
    }

    public void setCreated(String created) {
        this.created = created;
    }

}
