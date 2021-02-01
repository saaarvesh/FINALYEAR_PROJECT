package com.example.dineatmytime;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.view.WindowManager;
import android.widget.Toast;

import com.example.dineatmytime.databinding.ActivityLoginBinding;
import com.example.dineatmytime.network.Api;
import com.example.dineatmytime.network.AppConfig;
import com.example.dineatmytime.network.ServerResponse;
import com.example.dineatmytime.ui.dashboard.DashboardActivity;
import com.example.dineatmytime.utils.Config;

import androidx.appcompat.app.AppCompatActivity;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;

public class Login extends AppCompatActivity {

    private ActivityLoginBinding binding;
    private Context context = this;

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        //getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.activity_login);

        binding = ActivityLoginBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        init();
        clickListener();

    }



    /*---------------------------------------- Init ----------------------------------------------------------------*/

    private void init() {


    }

    /*---------------------------------------- Click Listeners ----------------------------------------------------------------*/


    public void clickListener() {

        binding.btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String Email = binding.edtEmail.getText().toString();
                String Password = binding.edtPassword.getText().toString();
                if (TextUtils.isEmpty(Email) || TextUtils.isEmpty(Password)) {
                    binding.edtEmail.setError("All fields are required !!");
                    binding.edtPassword.setError("All fields are required!!");
                    return;
                }
                Log.v("Login ", "It Works");

                doLogin(Email, Password);

            }
        });


        binding.registerbtn.setOnClickListener(v -> {
            Intent obj = new Intent(Login.this, Register.class);
            Login.this.startActivity(obj);

        });
    }



    /*---------------------------------------- Do Login ----------------------------------------------------------------*/


    private void doLogin(String email, String password) {
        Retrofit retrofit = AppConfig.getRetrofit();
        Api service = retrofit.create(Api.class);

        Call<ServerResponse> call = service.login(email, password);
        call.enqueue(new Callback<ServerResponse>() {
            @Override
            public void onResponse(Call<ServerResponse> call, Response<ServerResponse> response) {

                if (response.body() != null) {

                    ServerResponse serverResponse = response.body();

                    if (!serverResponse.getError()) {
//                        Config.showToast(context, serverResponse.getLogin().get(0).getName());
                        Intent obj = new Intent(Login.this, DashboardActivity.class);
                        startActivity(obj);


//                        Toast.makeText(Login.this,"Login Successful", Toast.LENGTH_LONG).show();
//                        //LoginResponse loginResponse = response.body();
//
//                        new Handler().postDelayed(new Runnable() {
//                            @Override
//                            public void run() {
//
//                                startActivity(new Intent(Login.this,DashboardActivity.class).putExtra("data",serverResponse.getMessage()));
//                            }
//                        },700);

                    } else {
                        Toast.makeText(Login.this,"Login unSuccessful", Toast.LENGTH_LONG).show();
                        Config.showToast(context, serverResponse.getMessage());

                    }
                }
            }

            @Override
            public void onFailure(Call<ServerResponse> call, Throwable t) {
                Config.showToast(context, t.getMessage());
            }
        });

    }
}