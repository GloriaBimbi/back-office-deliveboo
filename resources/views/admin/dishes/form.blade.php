@extends('layouts.app')

@section('title', (empty($dish->id) ? 'Add New' : 'Edit') . ' dish')

@section('content')

    <section>
        <div class="container">
            <div class="text-center w-100">
                <div class="text-center mt-5">
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
                    @method('PATCH')
                @endif
                <div class="row">
                    <div class="col-6">
                        {{-- name input  --}}
                        <div class="col">
                            <label class="form-label" for="title">Name*</label>
                            <input required @class(['form-control', 'is-invalid' => $errors->has('name')]) value="{{ old('name', $dish->name) }}"
                                type="text" name="name" id="name" pattern="[A-Za-zÀ-ÿ\s]+"
                                title=":deve contenere solo caratteri di tipo testo" />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ingredient list input  --}}
                        <div class="col">
                            <label class="form-label" for="ingredients_list">Ingredients List*</label>
                            <textarea @class([
                                'form-control',
                                'is-invalid' => $errors->has('ingredients_list'),
                            ]) name="ingredients_list" rows="5" id="ingredients_list"
                                placeholder="Write here your ingredients...">{{ old('ingredients_list') ?? $dish->description }}</textarea>
                            @error('ingredients_list')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- description input   --}}

                        <div class="col">
                            <label class="form-label" for="description">Description*</label>
                            <textarea @class(['form-control', 'is-invalid' => $errors->has('description')]) name="description" rows="5" id="description"
                                placeholder="Write here your description...">{{ old('description') ?? $dish->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- price input   --}}
                        <div class="col">
                            <label class="form-label" for="price">Price*</label>
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
                        {{-- image input --}}
                        <div class="col">
                            <label for="image" class="form-label">Image*</label>
                            <input @if (empty($dish->image)) required @endif @class(['form-control', 'is-invalid' => $errors->has('image')])
                                type="file" id="image" name="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- preview image --}}
                        @if (!empty($dish->image))
                            <div class="preview-image-container col">
                                <img alt="" class="img-fluid mt-3" src="{{ asset('storage/' . $dish->image) }}">
                            </div>
                        @endif

                    </div>

                </div>

                <div class="d-flex align-items-center gap-2 py-3">
                    <button class="btn btn-success">{{ (empty($dish->id) ? 'Save' : 'Edit') . ' dish' }}</button>
                    <a href="{{ route('admin.dishes.index') }}" class="btn btn-warning">Return to the list</a>
                </div>
            </form>

        </div>
    </section>

@endsection

@section('js')

@endsection
