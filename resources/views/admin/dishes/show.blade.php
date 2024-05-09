@extends('layouts.app')

@section('title', 'Dish Details')

@section('content')
    <section>
        <div class="container my-5">
            @if (Auth::user()->id == $dish->restaurant->user->id)
            <a href="{{ route('admin.dashboard') }}" class="back-button"><i class="fa-solid fa-arrow-rotate-left"></i> Go Back</a>
            @else
            <a href="{{ url()->previous() }}" class="back-button"><i class="fa-solid fa-arrow-rotate-left"></i> Go Back</a>
            @endif
                <div class="card mt-4">
                <div class="card-header">
                    <h2 class="text-success-emphasis my-4 text-capitalize card-title">
                        {{ $dish->name }} ({{ $dish->restaurant->name }})
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><span class="text-info fw-medium">Price: </span>
                                    ${{ $dish->price }}</li>
                                <li class="list-group-item"><span class="text-info fw-medium">Ingredients list: </span>
                                    {{ $dish->ingredients_list }}</li>
                                @if (Auth::user()->id == $dish->restaurant->user->id)
                                    <li class="list-group-item d-flex align-items-center ">
                                        <span class="text-info fw-medium">Visible: </span>
                                        <form action="{{ route('admin.dishes.update-visible', $dish) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <label class="switch">
                                                <input type="checkbox" id="visible" @checked($dish->visible)
                                                    name="visible">
                                                <span class="slider"></span>
                                            </label>
                                        </form>
                                    </li>
                                @endif
                            </ul>
                            @if ($dish->description)
                                <div class="card mt-5">
                                    <p class="text-info fw-medium card-title text-center pt-3 fs-5">Dish description:</p>
                                    <p class="card-text text-center pb-4">{{ $dish->description }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-6"><img src="{{ $dish->getImage() }}" alt="dish image" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row d-flex align-items-center">
                        <div class="col">

                            @if (Auth::user()->id == $dish->restaurant->user->id)
                            <a class="btn btn-dark" href="{{ route('admin.dishes.edit', $dish) }}">
                                {{ __('Edit dish') }}


                            </a>
                        </div>

                            <div class="col text-end">


                                <a class="text-danger text-decoration-underline" data-bs-toggle="modal"
                                    data-bs-target="#delete-dish-{{ $dish->id }}">Delete Dish</a>


                            </div>
                        @endif
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

        <style>
            /* The switch - the box around the slider */
            .switch {
                font-size: 17px;
                position: relative;
                display: inline-block;
                width: 3.5em;
                height: 2em;
            }

            /* Hide default HTML checkbox */
            .switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }

            /* The slider */
            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #fff;
                border: 1px solid #adb5bd;
                transition: .4s;
                border-radius: 30px;
                transform: scale(0.7);
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 1.4em;
                width: 1.4em;
                border-radius: 20px;
                left: 0.27em;
                bottom: 0.25em;
                background-color: #adb5bd;
                transition: .4s;
            }

            input:checked+.slider {
                background-color: #007bff;
                border: 1px solid #007bff;
            }

            input:focus+.slider {
                box-shadow: 0 0 1px #007bff;
            }

            input:checked+.slider:before {
                transform: translateX(1.4em);
                background-color: #fff;
            }
        </style>
    @endsection

    @section('js')
        <script>
            const checkbox = document.getElementById('visible');
            checkbox.addEventListener('change', () => {
                const form = checkbox.closest('form');
                form.submit();
            });
        </script>
    @endsection
