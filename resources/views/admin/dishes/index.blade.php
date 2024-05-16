@extends('layouts.app')

@section('title', 'Dishes')

@section('content')
    <section>
        <div class="container mt-4">
            <a href="{{ route('home') }}" class="back-button"><i class="fa-solid fa-arrow-rotate-left"></i> Torna alla Home</a>
        </div>
        <div class="container my-5">
            <div class="text-center w-100">
                <div class="text-center">
                    <img src="{{ asset('storage/' . 'chef-animate.svg') }}" alt="page-logo-dish-index" class="img-fluid"
                        style="width: 30%">
                </div>
                <img src="{{ asset('storage/' . 'Dishes.png') }}" alt="page-title-dish-index" class="img-fluid"
                    style="width: 60%">
            </div>
            <div class="card-container">
                <div class="row g-3">
                    @foreach ($dishes as $dish)
                        <div class="col-4">
                            <div class="card h-100 dish-card">
                                <div class="card-top">
                                    <img src="{{ $dish->getImage() }}" class="card-img-top" alt="dish image" />
                                    <div class="restaurant-dish-name">
                                        {{ $dish->restaurant->name }}
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h2>{{ $dish->name }}</h2>
                                    <p class="card-price">${{ $dish->price }}</p>
                                    <a href="{{ route('admin.dishes.show', $dish) }}" class="btn btn-success"><i
                                            class="fa-solid fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- paginate --}}
        <div class="container">
            <div class="col ">
                <div>
                    {{ $dishes->links() }}
                </div>
            </div>
        </div>
    </section>

@endsection

{{-- # modale per cancellazione: da rivedere il comportamento  --}}
@section('delete_modal')
    @foreach ($dishes as $dish)
        <div class="modal fade" id="delete-dish-{{ $dish->id }}" tabindex="-1"
            aria-labelledby="delete-dish-{{ $dish->id }}-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="delete-dish-{{ $dish->id }}-label">Confirm delete</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        Are you sure you want to delete '{{ $dish->name }}'?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Go Back</button>
                        <form action="{{ route('admin.dishes.destroy', $dish) }}" method="POST" class="">
                            @method('DELETE')
                            @csrf

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
