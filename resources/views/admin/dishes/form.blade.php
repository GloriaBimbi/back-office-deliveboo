@extends('layouts.app')

@section('title', (empty($dish->id) ? 'Add New' : 'Edit') . ' dish')

@section('content')

    <section>
        <div class="container py-5">

            <div class="text-center w-100 mb-4">
                <div class="text-center">
                    <img src="{{ asset('storage/' . 'plate.png') }}" alt="page-logo-dish-form" class="img-fluid"
                        style="width: 10%">
                </div>
                <img src="{{ asset('storage/' . 'add-dishes.png') }}" alt="page-title-dish-form" class="img-fluid"
                    style="width: 60%">
            </div>

            <form action="{{ empty($dish->id) ? route('admin.dishes.store') : route('admin.dishes.update', $dish) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (!empty($dish->id))
                    <a href="{{ route('admin.dishes.show', $dish) }}" class="back-button"><i
                            class="fa-solid fa-arrow-rotate-left"></i>Return to dish</a>
                @else
                    <a href="{{ route('admin.dashboard') }}" class="back-button"><i
                            class="fa-solid fa-arrow-rotate-left"></i>Return to dashboard</a>
                @endif
                @if (!empty($dish->id))
                    @method('PATCH')
                @endif
                <div class="row g-2 d-flex">
                    {{-- name description ingredients input  --}}
                    <div class="col-6 d-flex flex-column gap-2">
                        <div class="card bg-dish p-2  ">

                            <label class="form-label text-white" for="title">Name*</label>
                            <input required @class(['form-control', 'is-invalid' => $errors->has('name')]) value="{{ old('name', $dish->name) }}"
                                type="text" name="name" id="name" pattern="^[\p{L}\d\s-]+$"
                                title=":deve contenere caratteri di tipo testo o numerici" />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- description and ingredients input   --}}
                        <div class="card bg-dish p-2 ">
                            {{-- description input   --}}

                            <label class="form-label text-white " for="description">Description*</label>
                            <textarea required @class([
                                'form-control',
                                'mb-2',
                                'is-invalid' => $errors->has('description'),
                            ]) name="description" rows="5" id="description"
                                placeholder="Write here your description...">{{ old('description') ?? $dish->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            {{-- ingredient list input  --}}
                            <label class="form-label text-white" for="ingredients_list">Ingredients List*</label>
                            <textarea required @class([
                                'form-control',
                                'is-invalid' => $errors->has('ingredients_list'),
                            ]) name="ingredients_list" rows="5" id="ingredients_list"
                                placeholder="Write here your ingredients...">{{ old('ingredients_list') ?? $dish->description }}</textarea>
                            @error('ingredients_list')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- image input and preview  --}}
                    <div class="col-6 ">
                        <div class="card h-100 bg-dish p-2">

                            {{-- image input --}}
                            <div class="col">
                                <label for="image" class="form-label text-white">Image*</label>
                                <input @if (empty($dish->image)) required @endif @class(['form-control', 'is-invalid' => $errors->has('image')])
                                    type="file" id="image" name="image">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- preview image in create form --}}
                            @if (empty($dish->image))
                                <div class="preview-image-container col mt-3">
                                    <img alt="" id="image-preview" class="img-fluid mt-3"
                                        src="{{ asset('storage/' . $dish->image) }}">
                                </div>
                            @else
                                {{-- preview image in edit form --}}
                                <div class="preview-image-container col mt-3">
                                    <img alt="" class="img-fluid mt-3"
                                        src="{{ asset('storage/' . $dish->image) }}">
                                </div>
                            @endif
                        </div>
                    </div>
                    {{-- price input   --}}
                    <div class="col-6">
                        <div class="card bg-dish p-2">
                            <label class="form-label text-white" for="price">Price*</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">$</span>
                                <input required type="text" @class(['form-control', 'is-invalid' => $errors->has('price')]) placeholder="price"
                                    aria-label="Price" aria-describedby="basic-addon1" id="price" name="price"
                                    value="{{ old('price', $dish->price) }}" pattern="^\d+(\.\d{1,2})?$"
                                    title="il formato deve essere maggiore di 0.">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-dish p-2 d-flex flex-column h-100">

                            <div class="btn-container d-flex gap-2">
                                <button
                                    class="btn btn-success">{{ (empty($dish->id) ? 'Save' : 'Edit') . ' dish' }}</button>
                                <a href="{{ route('admin.dishes.index') }}" class="btn btn-warning">Return to the list</a>
                            </div>
                            <p class="mt-auto mb-0 text-white">*those fields are required</p>
                        </div>
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
    <style>
        form {
            position: relative;
        }

        .back-button {
            position: absolute;
            top: -3.5rem;
        }
    </style>
@endsection

@section('js')
    {{-- function to show image preview in create form --}}
    <script>
        document.getElementById('image').addEventListener('change', function() {
            var file = this.files[0];
            var img = document.getElementById('image-preview');
            img.style.display = 'block';

            var reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    </script>
@endsection
