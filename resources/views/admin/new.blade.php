@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('New Category') }}</div>
                    <div class="card-body">

                        <form method="GET" action="/admin/category/store">
                            @csrf
                            {{--                                    <input type="hidden" name='orderid' value='{{ $order->id }}'>--}}
                            <div class="form-group">
                                <label for="address">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Category name">
                                <small id="emailHelp" class="form-text text-muted">Please enter a new category name!</small>
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
