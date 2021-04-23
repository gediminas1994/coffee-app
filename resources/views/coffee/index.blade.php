@extends('layouts.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row form-group">
        <div class="col-12">
            <a href="{{ route('coffee.create') }}" class="btn btn-primary btn-block">Add coffee</a>
        </div>
    </div>

    <div class="row form-group">
        @foreach($coffees as $coffee)
            <div class="col-3">
                <div class="card">
                    <img class="card-img-top img-thumbnail" src="{{ asset($coffee->image) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $coffee->title }}</h5>
                        <p class="card-text">{{ $coffee->price }}</p>
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('coffee.edit', $coffee) }}" class="btn btn-primary">Edit</a>
                            </div>
                            <div class="col">
                                <form action="{{ route('coffee.delete', $coffee) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row form-group justify-content-center">
        <div class="col-3">
            <div class="">
                {{ $coffees->links() }}
            </div>
        </div>
    </div>
@endsection
