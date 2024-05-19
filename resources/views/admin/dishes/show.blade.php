@extends('layouts.app')

@section('title', 'Dish Details')

@section('content')
    <section id='dish-show'>
        <div class="container my-5">
            <div class="page-controls d-flex justify-content-between">

                @if (Auth::user()->id == $dish->restaurant->user->id)
                <a href="{{ route('admin.dashboard') }}" class="back-button d-flex justify-content-center align-items-center"><i class="fa-solid fa-arrow-rotate-left"></i> Go
                    Back</a>
                    @else
                    <a href="{{ url()->previous() }}" class="back-button d-flex justify-content-center align-items-center"><i class="fa-solid fa-arrow-rotate-left"></i> Go Back</a>
                    @endif
                    @if (Auth::user()->id == $dish->restaurant->user->id)
                        <div class="dropstart">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-gear"></i>
                            </button>
                            <ul class="dropdown-menu" id="dropdown">
                                <li><a class="dropdown-item bg-warning text-white" href="{{route('admin.dishes.edit', $dish)}}"><i class="fa-solid fa-pencil"></i></a></li>
                                <li><button class="dropdown-item bg-danger text-white" data-bs-toggle="modal" data-bs-target="#delete-dish-{{ $dish->id }}"><i class="fa-solid fa-trash"></i></button></li>
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="dish-wrapper mt-3">
                    <div class="row g-2 bg-white">
                        <div class="col-12 col-md-6 mt-0 px-0">
                            <div class="img-wrapper">
                                <img src="{{ $dish->getImage() }}" alt="dish image" class="img-fluid">
                                <h1 class="text-capitalize"> {{ $dish->name }} ({{ $dish->restaurant->name }})</h1>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-0 px-0">
                            <div class="dish-details  px-2 py-5">
                                <div class="row">
                                    <div class="col-6">
                                        <p class="text-info fw-medium ">Price: </p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <p class="text-info fw-medium h3">${{ $dish->price }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <p class="text-info fw-medium mb-0">Ingredients list: </p>
                                    </div>
                                    <div class="col-12 ">
                                        <p class="ingredients-list px-3">{{ $dish->ingredients_list }}</p>
                                    </div>
                                </div>
                                @if ($dish->description)
                                <div class="row">
                                    <div class="col-12">
                                        <p class="text-info fw-medium mb-0">Description: </p>
                                    </div>
                                    <div class="col-12 ">
                                        <p class="description px-3">{{ $dish->description }}</p>
                                    </div>
                                </div>
                                @endif
                                @if (Auth::user()->id == $dish->restaurant->user->id)
                                <li class="list-group-item d-flex align-items-center ">
                                    <span class="text-info fw-medium ">Visible: </span>
                                    <form action="{{ route('admin.dishes.update-visible', $dish) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <label class="switch ">
                                            <input type="checkbox" id="visible" @checked($dish->visible)
                                                name="visible">
                                            <span class="slider"></span>
                                        </label>
                                    </form>
                                </li>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+hu1J6a6DRsvVf8C/eNq+1D8dsDzh" crossorigin="anonymous"></script>

        <script>
            const checkbox = document.getElementById('visible');
            checkbox.addEventListener('change', () => {
                const form = checkbox.closest('form');
                form.submit();
            });


            
        </script>
    @endsection
