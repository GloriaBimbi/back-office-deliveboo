@extends('layouts.app')

@section('title', 'Dishes')

@section('content')
<div class="container mt-4">
    <a href="{{route('home')}}" class="back-button"><i class="fa-solid fa-arrow-rotate-left"></i> Torna alla Home</a>
</div>
    <section>
        <div class="container my-5">
            <div class="text-center w-100">
                <div class="text-center">
                    <img src="{{ asset('storage/' . 'main-dish.png') }}" alt="page-logo-dish-index" class="img-fluid"
                        style="width: 10%">
                </div>
                <img src="{{ asset('storage/' . 'Dishes.png') }}" alt="page-title-dish-index" class="img-fluid"
                    style="width: 60%">
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Restaurant</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dishes as $dish)
                        <tr>
                            <td>{{ $dish->id }}</td>
                            <td>{{ $dish->name }}</td>
                            <td>{{ $dish->restaurant->name }}</td>
                            <td>${{ $dish->price }}</td>
                            <td>{{ $dish->getAbstract() }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('admin.dishes.show', $dish) }}"><i
                                        class="fa-solid fa-eye"></i></a>
{{-- 
                                <a class="btn btn-warning" href="{{ route('admin.dishes.edit', $dish) }}"><i
                                        class="fa-solid fa-pencil"></i></a> --}}

                                {{-- <button type="submit" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#delete-dish-{{ $dish->id }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                {{-- <div class="col">
                    <a href="{{ route('admin.dishes.create') }}" class="btn btn-success"><i class="fa-solid fa-plus"></i>
                        Add
                        dish </a>
                </div> --}}
                <div class="col ">
                    <div >
                        {{ $dishes->links() }}
                    </div>
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
