@extends('layouts.app')

@section('title', 'Restaurants')

@section('content')
    <div class="container mt-4">
        <a href="{{ route('home') }}" class="back-button"><i class="fa-solid fa-arrow-rotate-left"></i> Torna alla Home</a>
    </div>
    <section>
        <div class="container my-5">
            <div class="text-center">
                <div class="text-center">
                    <img src="{{ asset('storage/' . 'restaurant.png') }}" alt="page-logo-restaurant-index" class="img-fluid"
                        style="width: 10%">
                </div>
                <img src="{{ asset('storage/' . 'Restaurantlist.png') }}" alt="page-title-restaurant-index"
                    class="img-fluid" style="width: 60%">
            </div>
            <table class="table table-hover bg-card">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Owner</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($restaurants as $restaurant)
                        <tr>
                            <td>{{ $restaurant->id }}</td>
                            <td>{{ $restaurant->name }}</td>
                            <td>{{ $restaurant->address }}</td>
                            <td>{{ $restaurant->user->name }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('admin.restaurants.show', $restaurant) }}"><i
                                        class="fa-solid fa-eye"></i></a>

                                {{-- <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete-restaurant-{{ $restaurant->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col w-100 text-end">
                    <div class="w-100"> {{ $restaurants->links() }}</div>
                </div>
            </div>

        </div>
    </section>

@endsection

{{-- # modale per cancellazione: da rivedere il comportamento  --}}
@section('delete_modal')
    @foreach ($restaurants as $restaurant)
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Go Back</button>
                        <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST" class="">
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
        <style>
            .bg-card{
                background-color: #003559;
            }
        </style>
@endsection
