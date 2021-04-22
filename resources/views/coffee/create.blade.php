@extends('layouts.app')

@section('content')
    <form enctype="multipart/form-data" action="{{ route('coffee.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Coffee title</label>
            <input type="text" name="title" class="form-control" id="title">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" id="price" step="0.01">
        </div>
        <div class="form-group">
            <label for="file">Image</label>
            <input type="file" name="image" class="form-control-file" id="file">
        </div>
        <button class="btn btn-primary" type="submit">Add</button>
    </form>
@endsection
