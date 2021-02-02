@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit "{{$items->name}}" category</div>

                    <div class="card-body">
                        <form method="GET" action="/admin/item/{{$items->id}}/update">
                            @csrf
                            <input type="hidden" name='id' value='{{ $items->id }}'>
                            <div class="form-group">
                                <label for="address">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder={{$items->name}}>
                                <small id="namelHelp" class="form-text text-muted">Please enter a new item name!</small>

                                <input type="text" class="form-control" id="description" name="description"
                                       placeholder={{$items->description}}>
                                <small id="descHelp" class="form-text text-muted">Please enter a new item description!</small>

                                <input type="number" class="form-control" id="price" name="price" step=".01"
                                       placeholder={{$items->price}}>
                                <small id="priceHelp" class="form-text text-muted">Please enter a new item price!</small>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
