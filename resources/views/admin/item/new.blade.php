@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('New Category') }}</div>
                    <div class="card-body">
                        @foreach ($errors->all() as $error)

                            <div class="alert alert-warning"> {{ $error }}</div>

                        @endforeach

                        <form method="GET" action="/admin/item/store">
                            @csrf
                            <div class="form-group">
                                <label for="name">Item's name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Item's name">
                                <small id="nameHelp" class="form-text text-muted">Please enter a new item name!</small>

                                <label for="description">Item's description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                       placeholder="Description">
                                <small id="descHelp" class="form-text text-muted">Please enter the new item's description!</small>

                                <label for="desc">Item's price</label>
                                <input type="number" class="form-control" id="price" name="price" step=".01"
                                       placeholder="Price">
                                <small id="priceHelp" class="form-text text-muted">What is the price of the item?</small>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Create') }}
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
