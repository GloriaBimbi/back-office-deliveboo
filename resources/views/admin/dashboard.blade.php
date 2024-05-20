@extends('layouts.app')

@section('content')

    @if (empty($restaurant))
    <div class="container-fluid mt-2">
        @if (session()->has('errors'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('errors')->first('user_id') }}</strong>
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                </button>
            </div>
        @endif
    </div>
        <div class="d-flex justify-content-center mt-5">
            <div class="card roundeder col-6 bg-card-create">
                <div class="text-center">
                <img src="{{asset('storage/' . 'coffee-shop-animate.svg')}}" alt="" style="width: 50%">
            </div>
                <div class="card-body text-center">
                    <a href="{{ route('admin.restaurants.create') }}" class="btn btn-secondary m-4 fw-medium p-3 w-50">Create a restaurant</a>
                </div>
            </div>
        </div>


        {{-- user's restaurant  --}}
    @elseif(!empty($restaurant))
        <section data-bs-theme="dark" id="restaurant-show" class="mb-3">
            <div class="container-fluid ">

                <div class="img-wrapper">
                    {{-- go back to homepage  --}}
                    <a href="{{ route('home') }}" class="back-button from-dashboard"><i
                            class="fa-solid fa-arrow-rotate-left"></i> Back to Home</a>
                    <img src="{{ $restaurant->getImage() }}" alt="restaurant-image">
                    <div class="card restaurant-details">
                        <div class="restaurant-detail-wrapper">
                            {{-- restaurant details --}}
                            <h1>{{ $restaurant->name }}</h1>
                            <p>By <strong>{{ $restaurant->user->name }}</strong></p>
                            <div class="row row-cols-1 row-cols-lg-2 ">
                                <div class="col">
                                    <p>Località - <strong>{{ $restaurant->address }}</strong></p>
                                </div>
                                <div class="col text-end">
                                    <p>P.iva - <strong>{{ $restaurant->piva }}</strong></p>
                                </div>
                            </div>
                            <hr>
                            <cite class="h3 ">
                                '{{ $restaurant->description }}'
                            </cite>
                            <hr>
                            <h3>Type</h3>
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2">
                                @foreach ($restaurant->types as $type)
                                    <div class="col">
                                        <div class="card type-card h-100">
                                            <div class="img-wrapper">
                                                <img src="{{ $type->getImage() }}" class="card-img-top img-fluid h-100" alt="...">
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title text-capitalize">{{ $type->name }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-2">
                @if (session()->has('errors'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('errors')->first('user_id') }}</strong>
                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
            </div>
        </section>

        @if(Auth::user()->id == $restaurant->user->id)
        <section id="dashboard-controls">
            <div class="container-fluid gap-2">
                <div class="control-wrapper">
                    <h5>Your dishes</h5>
                    <div class="bottom-dashboard-controls">
                        <i class="fa-solid fa-plate-wheat fa-xl"></i>
                        <strong>{{count($restaurant->dishes)}}</strong>
                    </div>
                </div>
                <a href="{{route('admin.orders.index')}}" class="control-wrapper">
                    <h5>Orders received</h5>
                    <div class="bottom-dashboard-controls">
                        <i class="fa-solid fa-receipt fa-xl"></i>
                        <strong>{{count($orders)}}</strong>
                    </div>
                    
                </a>
                {{-- <div class="control-wrapper">
                    <h5>Total revenue</h5>
                    <div class="bottom-dashboard-controls">
                        <i class="fa-solid fa-dollar-sign fa-xl"></i>
                        <strong>100</strong>
                        {{-- <strong>{{sum($orders->total_price)}}</strong> --}}
                    {{-- </div>
                </div> --}} 
                {{-- <div class="control-wrapper">
                    <h5>Best seller</h5>
                    <div class="bottom-dashboard-controls">
                        <i class="fa-regular fa-circle-up fa-xl"></i>
                        <strong>Nome piatto</strong>
                    </div>
                </div> --}}
            </div>
        </section>
        @endif

        {{-- restaurant's dishes --}}
        <section>
            <div class="container-fluid " id="restaurant-dishes">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 h-100 g-2 my-3">

                    {{-- add dishes --}}
                    @if (Auth::user()->id == $restaurant->user->id)
                        <div class="col">
                            <a class="card add-dish-card" href="{{ route('admin.dishes.create') }}">
                                <h2 class="">+</h2>
                                <p>Add a dish</p>
                            </a>
                        </div>
                    @endif
                    {{-- dishes cards --}}
                    @if (!empty($restaurant->dishes))
                        @foreach ($restaurant->dishes as $dish)
                            <div class="col">
                                <div class="card bg-card-dish">
                                    <a href="{{ route('admin.dishes.show', $dish) }}">

                                        <img src="{{ $dish->getImage() }}" @class([$dish->visible ? '' : 'non-visible', 'card-img-top']) alt="...">
                                        <div class="card-body">
                                            <div class="info">
                                                <h5 class="card-title">{{ $dish->name }}</h5>
                                                <p class="card-text">${{ $dish->price }}</p>
                                            </div>
                                            @if($dish->visible == false)
                                                <div class="not-available fw-medium fs-4 text-warning">Not Available</div>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    @endif

@endsection

@if (!empty($restaurant))
    @section('delete_modal')
        <div class="modal fade" id="delete-restaurant-{{ $restaurant->id }}" tabindex="-1"
            aria-labelledby="delete-restaurant-{{ $restaurant->id }}-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="delete-restaurant-{{ $restaurant->id }}-label">Confirm delete</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        Are you sure you want to delete '{{ $restaurant->name }}'?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Go Back</button>

                        <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST" class="">
                            @method('DELETE')
                            @csrf

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endsection

        @section('css')
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
                integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />
        @endsection
@endif
