@extends('layouts.app')

@section('title','Restaurant Details')

@section('content')
<section>
    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <h2 class="fs-4 text-secondary my-4 text-capitalize">
                    {{ $restaurant->name }}
                </h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col"><img src="{{$restaurant->image}}" alt="restaurant image"></div>
                    <div class="col">
                        <p>{{$restaurant->description}}</p>
                        <p>{{$restaurant->address}}</p>
                        <p>{{$restaurant->piva}}</p>
                        <p>{{$restaurant->user->name}}</p>
                        <ul>
                            @foreach($restaurant->types as $type)
                            <li>{{$type->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <a class="btn btn-primary" href="{{route('admin.restaurants.index')}}">
                            {{ __('Go Back to List') }}
                        </a>
                    </div>
                    <div class="col">
                        <a class="btn btn-primary" href="{{route('admin.restaurants.edit', $restaurant->id)}}">
                            {{ __('Edit') }}
                        </a>
                    </div>
                    <div class="col">
                        
                        
                            <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-restaurant-{{ $restaurant->id }}">
                               <i class="fa-solid fa-trash-can"></i>
                            </button>
                        
                    </div>
            
            </div>
        </div>
    </div>
</section>



@endsection


@section('delete_modal')
<div class="modal fade" id="delete-restaurant-{{ $restaurant->id }}" tabindex="-1" aria-labelledby="delete-restaurant-{{ $restaurant->id }}-label"
    aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="delete-restaurant-{{ $restaurant->id }}-label">Confirm delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-start">
        Are you sure? {{ $restaurant->name }}?
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
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection