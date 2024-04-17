@extends('layouts.master')

@section('title')
    {{ __('products_create.create_product') }}
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/createProductStyles.css') }}">
@endsection

@section('content')
    <div class="product-form-container">
        <h2>{{ __('products_create.create_product') }}</h2>

        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="description">{{ __('products_create.description') }}</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="quantity">{{ __('products_create.quantity') }}</label>
                <input type="number" class="form-control" id="quantity" name="quantity">
            </div>
            <div class="form-group">
                <label for="price">{{ __('products_create.price') }}</label>
                <input type="number" class="form-control" id="price" name="price" value="25">
            </div>
            <div class="form-group">
                <label for="is_promoted">{{ __('products_create.is_promoted') }}</label>
                <select class="form-control" id="is_promoted" name="is_promoted">
                    <option value="1">{{ __('products_create.yes') }}</option>
                    <option value="0">{{ __('products_create.no') }}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tags">{{ __('products_create.tags') }}</label>
                <select multiple class="form-control" id="tags" name="tags[]">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image1">{{ __('products_create.upload_image') }} 1</label>
                <input type="file" class="form-control-file" id="image1" name="image1">
            </div>
            <div class="form-group">
                <label for="image2">{{ __('products_create.upload_image') }} 2</label>
                <input type="file" class="form-control-file" id="image2" name="image2">
            </div>
            <div class="form-group">
                <label for="image3">{{ __('products_create.upload_image') }} 3</label>
                <input type="file" class="form-control-file" id="image3" name="image3">
            </div>
            <button type="submit" class="btn btn-primary">{{ __('products_create.submit') }}</button>
        </form>
    </div>
@endsection
