@extends('layouts.app')

@section('content')

    @if (empty($restaurant))
        <a href="{{ route('admin.restaurants.create') }}" class="btn btn-secondary w-100">Create a restaurant</a>
        {{-- ristorante dell'utente  --}}
    @elseif(!empty($restaurant))
        <section data-bs-theme="dark" id="restaurant-show" class="mb-3">
            <div class="container-fluid ">

                <div class="img-wrapper">
                    {{-- torna alla home  --}}
                    <a href="{{ route('home') }}" class="back-button from-dashboard"><i
                            class="fa-solid fa-arrow-rotate-left"></i> Back to Home</a>
                    <img src="{{ $restaurant->getImage() }}" alt="restaurant-image">
                    <div class="card restaurant-details">
                        <div class="restaurant-detail-wrapper">

                            <h1>{{ $restaurant->name }}</h1>
                            <p>By <strong>{{ $restaurant->user->name }}</strong></p>
                            <div class="row">
                                <div class="col-6">
                                    <p>Località - <strong>{{ $restaurant->address }}</strong></p>
                                </div>
                                <div class="col-6 text-end">
                                    <p>P.iva - <strong>{{ $restaurant->piva }}</strong></p>
                                </div>
                            </div>
                            <hr>
                            <cite class="h3 ">
                                '{{ $restaurant->description }}'
                            </cite>
                            <hr>
                            <h3>Type</h3>
                            <div class="row row-cols-4">
                                @foreach ($restaurant->types as $type)
                                    <div class="col">
                                        <div class="card h-100">
                                            <img src="{{ $type->getImage() }}" class="card-img-top" alt="...">
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
            <div class="container-fluid">
                @if (session()->has('errors'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('errors')->first('user_id') }}</strong>
                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
            </div>
        </section>

        {{-- piatti del ristorante  --}}
        <section>
            <div class="container-fluid" id="restaurant-dishes">
                <div class="row row-cols-4 h-100 g-2 my-3">

                    {{-- colonna per aggiungere piatti  --}}
                    @if (Auth::user()->id == $restaurant->user->id)
                        <div class="col">
                            <a class="card add-dish-card" href="{{ route('admin.dishes.create') }}">
                                <h2 class="">+</h2>
                                <p>Add a dish</p>
                            </a>
                        </div>
                    @endif
                    @if (!empty($restaurant->dishes))
                        @foreach ($restaurant->dishes as $dish)
                            <div class="col">
                                <div class="card">
                                    <a href="{{ route('admin.dishes.show', $dish) }}">

                                        <img src="{{ $dish->getImage() }}" @class([$dish->visible ? '' : 'non-visible', 'card-img-top']) alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $dish->name }}</h5>
                                            <p class="card-text">${{ $dish->price }}</p>
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
