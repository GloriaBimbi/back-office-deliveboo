@extends('layouts.app')

@section('title', 'Restaurant Details')

@section('content')
    <section>
        <div class="container my-5">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-success-emphasis my-4 text-capitalize card-title">
                        {{ $restaurant->name }}
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <div class="col-6 ">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><span class="text-info fw-medium">Address: </span>
                                    {{ $restaurant->address }}</li>
                                <li class="list-group-item"><span class="text-info fw-medium">P.IVA: </span>
                                    {{ $restaurant->piva }}</li>
                                <li class="list-group-item"><span class="text-info fw-medium">Owner: </span>
                                    {{ $restaurant->user->name }}</li>
                            </ul>
                            <ul class="list-group list-group-flush mt-5">
                                <p class="fw-medium text-info fw-medium m-0 list-group-item">Types:</p>
                                @foreach ($restaurant->types as $type)
                                    <li class="list-group-item">{{ $type->name }}</li>
                                @endforeach
                            </ul>
                            <div class="card mt-5">
                                <p class="text-info fw-medium card-title text-center pt-3 fs-5">Restaurant Description:</p>
                                <p class="card-text text-center pb-4">{{ $restaurant->description }}</p>
                            </div>
                        </div>
                        <div class="col-6 img_col ">
                            <div class="img-wrapper">

                                <img src="{{ $restaurant->getImage() }}" alt="restaurant image" class="img-restaurant">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-warning" href="{{ route('admin.restaurants.index') }}">
                                {{ __('Go Back to List') }}
                            </a>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#delete-restaurant-{{ $restaurant->id }}">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </section>

@endsection

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
        <style lang="scss" scoped>
            .img_col {
                height: 100%;
            }

            .img_wrapper {
                height: 100%;
            }

            .img-restaurant {
                width: 100%;
                object-fit: cover;
                object-position: center;
            }
        </style>
    @endsection
