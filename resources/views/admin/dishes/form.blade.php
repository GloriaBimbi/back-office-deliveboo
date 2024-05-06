@extends('layouts.app')

@section('title', (empty($dish->id) ? 'Add New' : 'Edit') . ' dish')

@section('content')

    <section>
        <div class="container">
            <h1>{{ (empty($dish->id) ? 'Add New' : 'Edit') . ' dish' }}</h1>
            <div class="text-center">
                <a href="{{ route('admin.dishes.index') }}" class="btn btn-primary mb-3">Return to the list</a>
            </div>

            <form action="{{ empty($dish->id) ? route('admin.dishes.store') : route('admin.dishes.update', $dish) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (!empty($dish->id))
                    @method('PATCH')
                @endif
                <div class="row g-2">
                    <div class="col-4">
                        <label class="form-label" for="title">Name</label>
                        <input @class(['form-control', 'is-invalid' => $errors->has('name')]) value="{{ old('name', $dish->name) }}" type="text"
                            name="name" id="name" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-4">
                        <label for="image" class="form-label">Image</label>
                        <input @class(['form-control', 'is-invalid' => $errors->has('image')]) type="file" id="image" name="image">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-6">
                        <label class="form-label" for="ingredients_list">Ingredients List</label>
                        <textarea @class([
                            'form-control',
                            'is-invalid' => $errors->has('ingredients_list'),
                        ]) name="ingredients_list" rows="5" id="ingredients_list">{{ old('ingredients_list') ?? $dish->description }}</textarea>
                        @error('ingredients_list')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-6">
                        <label class="form-label" for="description">Description</label>
                        <textarea @class(['form-control', 'is-invalid' => $errors->has('description')]) name="description" rows="5" id="description">{{ old('description') ?? $dish->description }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">$</span>
                            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('price')]) placeholder="price" aria-label="Price"
                                aria-describedby="basic-addon1" id="price" name="price"
                                value="{{ old('price', $dish->price) }}">
                        </div>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <button class="btn btn-success mt-3">{{ (empty($dish->id) ? 'Save' : 'Edit') . ' dish' }}</button>
            </form>
        </div>
    </section>

@endsection
