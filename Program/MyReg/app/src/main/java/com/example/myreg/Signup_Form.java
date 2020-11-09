package com.example.myreg;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

public class Signup_Form extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_signup__form);
        getSupportActionBar().setTitle("Customer SignUp !!");
    }

    public void btn_homePage(View view) {
        startActivity(new Intent(getApplicationContext(),HomePage.class));
    }
}