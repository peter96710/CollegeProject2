@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit "{{$categories->name}}" category</div>

                    <div class="card-body">
                        <form method="GET" action="/admin/category/{{$categories->id}}/update">
                            @csrf
                            <input type="hidden" name='id' value='{{ $categories->id }}'>
                            <div class="form-group">
                                <label for="address">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder={{$categories->name}}>
                                <small id="emailHelp" class="form-text text-muted">Please enter a new category name!</small>
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
