@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col">
            <a href="{{ route('coffee.index') }}" class="btn btn-secondary float-right">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col">
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
        </div>
    </div>

    <div class="row">
        <div class="col">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

@endsection
