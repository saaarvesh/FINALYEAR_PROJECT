package com.example.dineatmytime.network;

import com.example.dineatmytime.model.Login;
import com.example.dineatmytime.model.Restaurant;
import com.example.dineatmytime.model.User;
import com.google.gson.annotations.Expose;
import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;
import java.util.List;

public class ServerResponse {


    @SerializedName("error")
    @Expose
    private Boolean error;

    @SerializedName("message")
    @Expose
    private String message;

    @SerializedName("user")
    @Expose
    private User user;

    @SerializedName("restaurants")
    @Expose
    private List<Restaurant> restaurantList;

    @SerializedName("login")
    @Expose
    private List<Login> login = null;


    public Boolean getError() {
        return error;
    }

    public void setError(Boolean error) {
        this.error = error;
    }

    public String getMessage() {
        return message;
    }

    public void setMessage(String message) {
        this.message = message;
    }


    public User getUser() {
        return user;
    }

    public void setUser(User user) {
        this.user = user;
    }


    public List<Restaurant> getRestaurantList() {
        return restaurantList;
    }

    public void setRestaurantList(List<Restaurant> restaurantList) {
        this.restaurantList = restaurantList;
    }

    public List<Login> getLogin() {
        return login;
    }

    public void setLogin(List<Login> login) {
        this.login = login;
    }
}
