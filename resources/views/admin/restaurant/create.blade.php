@extends('layouts.app')

@section('title', 'Add Restaurant')

@section('content')
    <section data-bs-theme="dark">
        <div class="container my-5">
            <form enctype="multipart/form-data" action="{{ route('admin.restaurants.store') }}" method="POST" >
                @csrf
                <div class="text-center w-100">
                    <div class="text-center mt-5">
                        <img src="{{ asset('storage/' . 'restaurantadd.png') }}" alt="" class="img-fluid" style="width: 10%">
                    </div>
                    <img src="{{ asset('storage/' . 'addrestaurant.png') }}" alt="" class="img-fluid" style="width: 60%">
                </div>
                <div class="row g-2">
                    <div class="col-6">
                        {{-- restaurant name input  --}}
                        <div class="card p-3 mb-2">
                            <div class="input-group">
                                <span for="name" class="input-group-text">Name</span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" value={{ old('name', $restaurant->name) }}>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{--  piva input  --}}
                        <div class="card p-3 mb-2">
                            <div class="input-group">
                                <span for="piva" class="input-group-text">PIVA</span>
                                <input type="number" class="form-control @error('piva') is-invalid @enderror" name="piva"
                                    id="piva" value={{ old('piva', $restaurant->piva) }}>
                                    @error('piva')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- owner input  --}}
                        <div class="card p-3 mb-2">
                            <div class="input-group">
                                <span for="owner" class="input-group-text">Owner</span>
                                <input type="text" class="form-control @error('user->name') is-invalid @enderror"
                                    name="owner" id="owner" value={{ old('user->name', $user->name) }}>
                                    @error('user->name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- image input  --}}
                        <div class="card p-3">
                            <div class="input-group">
                                <span for="image" class="input-group-text">Image</span>
                                <input type="file" class="form-control @error ('image') is-invalid @enderror" name="image"
                                    id="image" >
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    {{-- address input  --}}
                    <div class="col-6">
                        <div class="card p-3">
                            <div class="input-group mb-4">
                                <span for="address_street" class="input-group-text">Street Address</span>
                                <input type="text" class="form-control @error('address_street') is-invalid @enderror" name="address_street" id="address_street" value={{ old('address_street') }} >
                                @error('address_street')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                            <div class="input-group mb-4">
                                <span for="address_civic" class="input-group-text">Civic</span>
                                <input type="text" class="form-control @error('address_civic') is-invalid @enderror" name="address_civic" id="address_civic" value={{ old('address_civic') }}>
                            @error('address_civic')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                            <div class="input-group mb-4">
                                <span for="address_postal_code" class="input-group-text">Zip Code</span>
                                <input type="text" class="form-control @error('address_postal_code') is-invalid @enderror" name="address_postal_code" id="address_postal_code" value={{ old('address_postal_code') }}>
                            @error('address_postal_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                            <div class="input-group mb-3">
                                <span for="address_city" class="input-group-text">City</span>
                                <input type="text" class="form-control @error('address_city') is-invalid @enderror" name="address_city" id="address_city" value={{ old('address_city') }}>
                            @error('address_city')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                            <div class="input-group">
                                <span for="address_country" class="input-group-text">Country</span>
                                <input type="text" class="form-control @error('address_country') is-invalid @enderror" name="address_country" id="address_country" value={{ old('address_country') }}>
                            @error('address_country')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>

                        </div>
                    </div>
                    {{-- description input  --}}
                    <div class="col-6">
                        <div class="card p-3">

                            <div class="form-floating mb-2">
                                <textarea class="form-control @error('description') is-invalid @enderror" type="text-area"
                                placeholder="Create a description" name="description" id="description" style="height: 276px">{{ old('description', $restaurant->description) }}</textarea>
                                <label class="form-label" for="floatingTextarea2">Description</label>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                {{-- types input --}}
                <div class="col-6">
                    <div class="card p-3 h-100">
                        <label for="">Types:</label>
                        <div class="d-flex flex-row justify-content-between flex-wrap">
                            @foreach($types as $type)
                                <div class="col-6 form-check @error('types') is-invalid @enderror">
                                    <input type="checkbox" id="types-{{$type->id}}"  value="{{ $type->id }}" name="types[]" class="form-check-input @error('types') is-invalid @enderror"
                                    {{ in_array($type->id, old('types', $restaurant->types->pluck('id')->toArray() ?? [])) ? 'checked' : '' }}>
                                    <label  for="types-{{$type->id}}" class="form-check-label  @error('types') is-invalid @enderror">{{$type->name}}</label>
                                </div>
                            @endforeach
                            @error("types")
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
