@extends('layouts.master')

@section('title')
    Create Product
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/createProductStyles.css') }}">
@endsection

@section('content')
    <div class="product-form-container">
        <h2>Create a new product</h2>

        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="25">
            </div>
            <div class="form-group">
                <label for="is_promoted">Is Promoted</label>
                <select class="form-control" id="is_promoted" name="is_promoted">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <select multiple class="form-control" id="tags" name="tags[]">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image1">Upload Image 1</label>
                <input type="file" class="form-control-file" id="image1" name="image1">
            </div>
            <div class="form-group">
                <label for="image2">Upload Image 2</label>
                <input type="file" class="form-control-file" id="image2" name="image2">
            </div>
            <div class="form-group">
                <label for="image3">Upload Image 3</label>
                <input type="file" class="form-control-file" id="image3" name="image3">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
