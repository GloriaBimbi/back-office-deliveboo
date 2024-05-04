@extends('layouts.app')

@section('title','Add Restaurant')

@section('content')
<section>
    <div class="container my-5">
        <form action="{{route('admin.restaurants.store')}}" method="POST">
            @csrf
            <h1 class="mb-4">Add your Restaurant</h1>
            <div class="row g-2">
                <div class="col-6">
                    <div class="card p-3 mb-2">
                        <div class="input-group">
                            <span for="name" class="input-group-text">Name</span>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                    </div>
                    <div class="card p-3 mb-2">
                        
                        <div class="input-group">
                            <span for="piva" class="input-group-text">PIVA</span>
                            <input type="number" class="form-control" name="piva" id="piva">
                        </div>
                    </div>
                    <div class="card p-3 mb-2">
                    <div class="input-group">
                        <span for="owner" class="input-group-text">Owner</span>
                        <input type="text" class="form-control" name="owner" id="owner">
                        </div>
                    </div>
                    <div class="card p-3">                   
                        <div class="input-group">
                            <span for="image" class="input-group-text">Image</span>
                            <input type="url" class="form-control" name="image" id="image">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card p-3">
                        <div class="input-group mb-4">
                            <span for="address_street" class="input-group-text">Street Address</span>
                            <input type="text" class="form-control" name="address_street" id="address_street">
                        </div>
                        <div class="input-group mb-4">
                            <span for="address_civic" class="input-group-text">Civic</span>
                            <input type="text" class="form-control" name="address_civic" id="address_civic">
                        </div>
                        <div class="input-group mb-4">
                            <span for="address_postal_code" class="input-group-text">Zip Code</span>
                            <input type="text" class="form-control" name="address_postal_code" id="address_postal_code">
                        </div>
                        <div class="input-group mb-3">
                            <span for="address_city" class="input-group-text">City</span>
                            <input type="text" class="form-control" name="address_city" id="address_city">
                        </div>
                        <div class="input-group">
                            <span for="address_country" class="input-group-text">Country</span>
                            <input type="text" class="form-control" name="address_country" id="address_country">
                        </div>
                        
                    </div>
                </div>
                <div class="form-floating mb-2">
                    <textarea class="form-control" type="text-area" placeholder="Create a description" name="description" id="description" style="height: 100px"></textarea>
                    <label for="floatingTextarea2">Description</label>
                  </div>

                <div class="card p-2">
                    <label for="">Type</label>
                    <div class="d-flex flex-row justify-content-between flex-wrap">
                        @foreach($types as $type)
                        <div class="col-6 form-check">
                            <input type="checkbox" id="type-{{$type->id}}" value="{{$type->id}}" name="types[]" >
                            <label for="type-{{$type->id}}" class="form-check-label">{{$type->name}}</label>
                        </div>
                        @endforeach
                        {{-- @error("types")
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror --}}
                    </div>
                </div>

                <div class="col-6">
                    <button class="btn btn-primary w-100" type="submit">Submit</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-warning w-100" type="reset">Reset</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection