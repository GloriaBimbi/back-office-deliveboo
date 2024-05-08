@extends('layouts.app')
@section('content')
<div class="container">
  <div class="jumbotron p-5 mb-4 rounded-3" >
    <div class="mb-3 homecard">
        <div class="row g-3 g-mb-0 d-flex align-items-center">
          <div class="col-12 col-md-6">
            <div class="img-wrapper">
              <img src="{{asset('storage/'.'homeimg.png')}}" alt="" class="img-fluid">
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="card-body">
              <h1 class="card-title text-center mt-5 hometitle">Deliveboo Restaurant Director</h1>
              <p class="card-text text-center mt-5 homephara">Un gestionale per la registrazione di nuovi ristoranti su un sito di delivery è un software che consente ai ristoranti di inserire e gestire le loro informazioni di base, il menù, gli ordini online, le promozioni, le analisi delle prestazioni e i pagamenti, tutto attraverso una piattaforma centralizzata. Questo sistema aiuta i ristoratori a ottimizzare la loro presenza online e a gestire le operazioni di consegna in modo efficiente.</p>
            </div>
            <div class="d-flex justify-content-center flex-column gap-2 mt-5">
              @guest
                <a href="{{ route('login') }}" class="login-btn">Accedi</a>
                <a href="{{ route('register') }}" class="register-btn">Registrati</a>
                @else
                <a href="{{ route('admin.dashboard') }}" class="dashboard-btn">Dashboard</a>
                <a href="{{ route('admin.restaurants.index') }}" class="list-btn">Lista dei ristoranti</a>

              @endguest
            </div>
            </div>
          </div>
        </div>
    </div>  
  </div>
</div>

@endsection