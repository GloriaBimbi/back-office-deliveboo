@extends('layouts.app')
@section('content')

<div class="jumbotron p-5 mb-4 rounded-3" >
    <div class="mb-3 homecard">
        <div class="row g-0">
          <div class="col-md-6">
            <img src="{{asset('storage/'.'homeimg.png')}}" alt="" style="width: 70%" class="m-5">
          </div>
          <div class="col-md-4">
            <div class="card-body">
              <h1 class="card-title text-center mt-5 hometitle">Deliveboo Restaurant Director</h1>
              <p class="card-text text-center mt-5 homephara">Un gestionale per la registrazione di nuovi ristoranti su un sito di delivery è un software che consente ai ristoranti di inserire e gestire le loro informazioni di base, il menù, gli ordini online, le promozioni, le analisi delle prestazioni e i pagamenti, tutto attraverso una piattaforma centralizzata. Questo sistema aiuta i ristoratori a ottimizzare la loro presenza online e a gestire le operazioni di consegna in modo efficiente.</p>
            </div>
            <div class="d-flex justify-content-center gap-5 mt-5">
            <button class="btn btn-primary">Lista Ristoranti</button>
            <button class="btn btn-primary">Registrati</button>
            <button class="btn btn-primary">Login</button>
        </div>
            </div>
          </div>
        </div>
      </div>  
</div>
@endsection