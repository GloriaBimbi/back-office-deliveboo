@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="jumbotron p-5 mb-4 rounded-3">
            <div class="mb-3 homecard">
                <div class="row g-3 g-mb-0 d-flex align-items-center">
                    <div class="col-12 col-md-6">
                        <div class="img-wrapper">
                            <img src="{{ asset('storage/' . 'homeimg.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card-body">
                            <h1 class="card-title text-center mt-5 hometitle">Deliveboo Restaurant Director</h1>
                            <p class="card-text text-center mt-5 homephara">A management software for registering new
                                restaurants on a delivery site is software that allows restaurants to enter and manage their
                                basic information, menu, online orders, promotions, performance analytics, and payments, all
                                through a centralized platform. This system helps restaurateurs optimize their online
                                presence and manage their delivery operations efficiently.</p>
                        </div>
                        <div class="d-flex justify-content-center flex-column gap-2 mt-5">
                            @guest
                                <a href="{{ route('login') }}" class="login-btn">Sign in</a>
                                <a href="{{ route('register') }}" class="register-btn">Register</a>
                            @else
                                <a href="{{ route('admin.dashboard') }}" class="dashboard-btn">Dashboard</a>
                                <a href="{{ route('admin.restaurants.index') }}" class="list-btn">List of restaurants</a>

                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
