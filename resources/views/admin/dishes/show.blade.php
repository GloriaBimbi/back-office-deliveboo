@extends('layouts.app')

@section('title', 'Dish Details')

@section('content')
    <section>
        <div class="container my-5">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-success-emphasis my-4 text-capitalize card-title">
                        {{ $dish->name }} ({{ $dish->restaurant->name }})
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><span class="text-info fw-medium">Slug: </span>
                                    {{ $dish->slug }}</li>
                                <li class="list-group-item"><span class="text-info fw-medium">Price: </span>
                                    ${{ $dish->price }}</li>
                                <li class="list-group-item"><span class="text-info fw-medium">Ingredients List: </span>
                                    {{ $dish->ingredients_list }}</li>
                            </ul>
                            <div class="card mt-5">
                                <p class="text-info fw-medium card-title text-center pt-3 fs-5">Dish Description:</p>
                                <p class="card-text text-center pb-4">{{ $dish->description }}</p>
                            </div>
                        </div>
                        <div class="col-6"><img src="{{ $dish->getImage() }}" alt="dish image" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-warning" href="{{ route('admin.dishes.index') }}">
                                {{ __('Go Back to List') }}
                            </a>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#delete-dish-{{ $dish->id }}">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </section>

@endsection

@section('delete_modal')
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
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Go Back</button>

                    <form action="{{ route('admin.dishes.destroy', $dish) }}" method="POST" class="">
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
