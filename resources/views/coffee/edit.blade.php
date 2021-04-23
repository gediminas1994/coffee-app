@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <a href="{{ route('coffee.index') }}" class="btn btn-secondary float-right">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-9">
            <form enctype="multipart/form-data" action="{{ route('coffee.update', $coffee) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Coffee title</label>
                    <input type="text" name="title" class="form-control" id="title" value="{{ $coffee->title }}">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" class="form-control" id="price" step="0.01" value="{{ $coffee->price }}">
                </div>
                <div class="form-group">
                    <label for="file">Image</label>
                    <input type="file" name="image" class="form-control-file" id="file">
                </div>
                <button class="btn btn-primary" type="submit">Confirm changes</button>
            </form>
        </div>
        <div class="col-3">
            <h3>Current image</h3>
            <img class="card-img-top img-thumbnail" src="{{ asset('storage/' . $coffee->image) }}" alt="Card image cap">
        </div>
    </div>
@endsection
